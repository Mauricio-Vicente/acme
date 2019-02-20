<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "utf-8">
        <meta http-equiv = "X-UA-Compatible" content="IE=edge">
        <meta name = "viewport" content="width=device-width, initial-scale=1">
        <link href="/acme/css/style.css" rel="stylesheet" >
        <title>Acme</title>
    </head>
    <body>
        <header>
            <?php require '../common/header.php'; ?>
            <nav>
                <?php echo $navList; ?>
            </nav>
        </header>

        <main>

            <h1>Add Category</h1>
            <p>Add a new category of products below.</p>

            <form method="post" action="/acme/products/index.php">
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>

                <label>New Category Name</label><br>
                <input required type="text" name="categoryName">
                <input type="submit" name="submit" value="Add Category" class="sButton"><br>
                <input type="hidden" name="action" value="submit">
            </form>
        </main>

        <!-- Footer -->
        <?php require '../common/footer.php' ?>
        <!--Footer-->
    </body>
</html>

