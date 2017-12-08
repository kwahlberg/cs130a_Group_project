<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
set_include_path ( "//students/phplib/classes" );
spl_autoload_register ();
  if (isset($_GET['source'])) {
    highlight_file($_SERVER['SCRIPT_FILENAME']);
    exit;
  }


switch($controller) {
      case 'pages':
        $controller = new PagesController();
      break;
      case 'posts':


?>