<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Security Log PHP App</title>
  <meta name="description" content="Project for CCSF 130A">
  <meta name="author" content="By Eduardo Garcia, Kurt Wahlberg, and Thi Mach">

  <link rel="stylesheet" href="css/styles.css?v=1.0">

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>

  <?php
  //error_reporting(E_ALL); ini_set('display_errors', 1);
    if (isset($_GET['source'])) {
      highlight_file($_SERVER['SCRIPT_FILENAME']);
      exit;
    }
    include_once("phplib/app/controllers/Controller.php");

    $controller = new Controller();
    $controller->invoke();
  ?>

  <script src="js/scripts.js"></script>
</body>
</html>
