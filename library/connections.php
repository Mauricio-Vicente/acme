<?php

function acmeConnect(){
    $server = 'localhost';
    $database = 'acme';
    $user = 'iClient';
    $password = "lZFroH2aGW1mDpZX";
    $dsn = "mysql:host=$server;dbname=$database";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

   try {
    $acmeLink = new PDO($dsn, $user, $password, $options);
   return $acmeLink; 
  } catch (PDOException $ex) {
   // echo $ex->getMessage();
    header('location:/acme/view/500.php');
   exit;
  }
  }
  
  
