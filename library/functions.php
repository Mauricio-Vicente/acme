
<?php
/*
 * CUSTOM FUNCTIONS
 */
//Checks for valid email address
function checkEmail($clientEmail) {
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}
// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($clientPassword) {
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])[[:print:]]{8,}$/';
    return preg_match($pattern, $clientPassword);
}

// Build a navigation bar
function buildNav($categories) {
// Build a navigation bar using the $categories array
    $navList = '<button onclick="toggleNavMenu()">&#9776;</button> <ul class="hide mainmenu" id="primaryNav">';
    $navList .= "<li><a href='/acme/' title='View the Acme home page'>Home</a></li>";
//Builds the Drop Down List
    foreach ($categories as $category) {
        $navList .= "<li>    <a href='/acme/products/?action=category&categoryName="
                . urlencode($category['categoryName']) .
                "' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}

function buildCatList($categories) {
    //create a catList
    $catList = '<select name="categoryId">';
    $catList .= " <option>Select a category</option>";
    foreach ($categories as $category) {
        $categoryChoosed = (isset($categoryId) && $categoryId === $category['categoryId']) ? 'selected' : '';
        $catList .= '<option value="' . $category['categoryId'] . '" ' . $categoryChoosed . '>' . $category['categoryName'] . '</option>';
    }
    $catList .= '</select>';
    
    return $catList;
}

//Displays a list of products within an unordered list
function buildProductsDisplay($products) {
    $pd = '<ul id="prod-display">';
    foreach ($products as $product) {
        $pd .= '<li>';
        $pd .= "<a href='/acme/products/?action=prod-details&name=" . urlencode($product['invName']) . " ' title = 'View $product[invName]'> <img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'></a>";
        $pd .= "<a href='/acme/products/?action=prod-details&name=" . urlencode($product['invName']) . " ' title = 'View $product[invName]'> <h2>$product[invName]</h2></a>";
        $pd .= "<span>$$product[invPrice]</span>";
        $pd .= '</li>';
    }
    $pd .= '</ul>';
    return $pd;
}
//Displays the product details individually
function buildProductsDetails($productInfo) {
    $pd = '<h1>'.$productInfo['invName'].'</h1>'; 
    $pd .= '<section id="prod-details">';
    $pd .= '<div>';
    $pd .= '<img src=\''.$productInfo['invImage']."' alt='Image of ".$productInfo['invName']." on Acme.com'>";
    $pd .= "<ul>";
    $pd .= "<li>Available Stock: $productInfo[invStock]</li>";
    $pd .= "<li>Weight: $productInfo[invWeight]</li>";
    $pd .= "<li>Location: $productInfo[invLocation]</li>";
    $pd .= "<li>Vendor: $productInfo[invVendor]</li>";
    $pd .= "<li>Style: $productInfo[invStyle]</li>";
    $pd .= "</ul>";
    $pd .= "<p>$productInfo[invDescription]</p><br>";
    $pd .= "<p class='result2'>See Product Reviews Below</p>";
    $pd .= "<span>$$productInfo[invPrice]</span>";
    $pd .= '</div>';
    $pd .= '</section>';
    return $pd;
}

/************************/
/**Functions for Review**/
/***********************/

function buildReviewDisplay($productInfo) {
    $screenFirstName = $_SESSION['clientData']['clientFirstname'];
    $clientLastname = $_SESSION['clientData']['clientLastname'];
    $displayName = $screenFirstName[0] . $clientLastname;
    $rd = '<form  method="post" action="/acme/reviews/index.php">';
    $rd .= '<fieldset>';
    $rd .= '<legend>Enter a Review:</legend>';
    $rd .= '<img class="user" src="../images/site/user.png" alt ="Image of site user">  ';
    $rd .= strtolower($displayName);
    $rd .= '<label>Product Review</label><textarea  name="reviewText" id="reviewText" required></textarea>';
    $rd .= '<input type="hidden" name="action" value="addReview">';
    $rd .= '<input type="hidden" name="invName" value="';
    $rd .= $productInfo['invName'];
    $rd .= '">';
    $rd .= '<input type="hidden" name="clientId" value="';
    $rd .= $_SESSION['clientData']['clientId'];
    $rd .= '">';
    $rd .= '<input type="submit" value="Add Review" class="reviewBtn"></fieldset>';
    $rd .= '</form>';
    return $rd;
}
//Build Review display for individual products
function buildAllReviews($reviews) {
    $ar = '<ul>';
    foreach ($reviews as $review) {
        $screenFirstName = $review['clientFirstname'];
        $screenLastName = $review['clientLastname'];
        $displayName = $screenFirstName[0] . $screenLastName;
        $madeDate = $review['reviewDate'];
        $stringDate = strtotime($madeDate);
        $displayDate = date('F d, Y', ($stringDate));
        $ar .= '<li class="review">';
    $ar .= '<img class="user" src="../images/site/star.png" alt ="Star Image">  ';
        $ar .= strtolower($displayName).'<br>';    
        $ar .= $displayDate.'<hr>';
        $ar .= "<br><span class='text'>$review[reviewText]</span></li>";
    }
    $ar .= '</ul>';
    return $ar;
}

/* * ********************************
 *  Functions for working with images
 * ********************************* */
// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}
// Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
        $id .= '<li>';
        $id .= "<img src='$image[imgPath]' title='$image[invName] image on Acme.com' alt='$image[invName] image on Acme.com'>";
        $id .= "<p><a href='/acme/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
        $id .= '</li>';
    }
    $id .= '</ul>';
    return $id;
}
// Build the products select list
function buildProductsSelect($products) {
    $prodList = '<select name="invId" id="invId"  class="drop-down">';
    $prodList .= "<option>Choose a Product</option>";
    foreach ($products as $product) {
        $prodList .= "<option value='$product[invId]'>$product[invName]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
}
// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
// Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
// Gets the actual file name
        $filename = $_FILES[$name]['name'];
        if (empty($filename)) {
            return;
        }
// Get the file from the temp folder on the server
        $source = $_FILES[$name]['tmp_name'];
// Sets the new path - images folder in this directory
        $target = $image_dir_path . '/' . $filename;
// Moves the file to the target folder
        move_uploaded_file($source, $target);
// Send file for further processing
        processImage($image_dir_path, $filename);
// Sets the path for the image for Database storage
        $filepath = $image_dir . '/' . $filename;
// Returns the path where the file is stored
        return $filepath;
    }
}
// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
// Set up the variables
    $dir = $dir . '/';
// Set up the image path
    $image_path = $dir . $filename;
// Set up the thumbnail image path
    $image_path_tn = $dir . makeThumbnailName($filename);
// Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);
// Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}
// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
// Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];
// Set up the function names
    switch ($image_type) {
        case IMAGETYPE_JPEG:
            $image_from_file = 'imagecreatefromjpeg';
            $image_to_file = 'imagejpeg';
            break;
        case IMAGETYPE_GIF:
            $image_from_file = 'imagecreatefromgif';
            $image_to_file = 'imagegif';
            break;
        case IMAGETYPE_PNG:
            $image_from_file = 'imagecreatefrompng';
            $image_to_file = 'imagepng';
            break;
        default:
            return;
    } // ends the resizeImage function
// Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);
// Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;
// If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {
// Calculate height and width for the new image
        $ratio = max($width_ratio, $height_ratio);
        $new_height = round($old_height / $ratio);
        $new_width = round($old_width / $ratio);
// Create the new image
        $new_image = imagecreatetruecolor($new_width, $new_height);
// Set transparency according to image type
        if ($image_type == IMAGETYPE_GIF) {
            $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
            imagecolortransparent($new_image, $alpha);
        }
        if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
        }
// Copy old image to new image - this resizes the image
        $new_x = 0;
        $new_y = 0;
        $old_x = 0;
        $old_y = 0;
        imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
// Write the new image to a new file
        $image_to_file($new_image, $new_image_path);
// Free any memory associated with the new image
        imagedestroy($new_image);
    } else {
// Write the old image to a new file
        $image_to_file($old_image, $new_image_path);
    }
// Free any memory associated with the old image
    imagedestroy($old_image);
}
// ends the if - else began on line 36
//Build Thumbnail display for individual products
function buildThumbnailDisplay($thumbnail) {
    $td = '<ul class=thumbnails>';
    foreach ($thumbnail as $image) {
        $td .= '<li>';
        $td .= "<img src='$image[imgPath]' alt='$image[imgName] image on Acme.com'>";
        $td .= '</li>';
    }
    $td .= '</ul>';
    return $td;
}





