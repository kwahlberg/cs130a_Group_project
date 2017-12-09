<?php
//error_reporting(E_ALL); ini_set('display_errors', 1);
  if (isset($_GET['source'])) {
    highlight_file($_SERVER['SCRIPT_FILENAME']);
    exit;
  }  
    include_once("app/controllers/Controller.php");  
      
    $controller = new Controller();  
    $controller->invoke();  
?>
