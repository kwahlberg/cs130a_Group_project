<!doctype html>

<?php
include("directoryViewer.php");
include("pathToURL.php");
include("fileUpload.php");

?>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>File Browser</title>
  <meta name="description" content="PHP File Browser">
  <meta name="author" content="CS130a">

  <link rel="stylesheet" href="css/styles.css?v=1.0">

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>

<div>
<h1>Current Folder Contents</h1>
<ul id="folder">
<?php
if (true) {
      if ( !empty($_POST["moveto_folder"]) ) {
              //echo "<p>Current Folder: " . $full_directory . "/" . $_POST["moveto_folder"] . "</p>";
              if(file_exists($full_directory . "/" . $_POST["moveto_folder"])){
            
            $full_directory = $full_directory . "/" . $_POST["moveto_folder"];
              }else{
            echo 'cannot find directory:'. $full_directory . "/" . $_POST["moveto_folder"];
        }
    }
    echo "<p>Current Folder: " . $full_directory . "</p>";
    getFiles($full_directory);
    //header("Refresh:0");
}
?>
</ul>
</div>

<div>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <h1>Create a New Folder</h1>
  <input type="text" value="" name="new_directory">
  <input type="submit" name="folder" value="Create Folder">
  <h1>Open Folder</h1>
  <input type="text" value="" name="moveto_folder">
  <input type="submit" name="open" value="Open Folder">
  <h1>Go Up One Level</h1>
  <input type="submit" name="up" value="Go Up One Level">
  <h1>Move a File to Folder</h1>
  <p>File Name: <input type="text" value="" name="selected_file"></p>
  <p>Folder Destination: <input type="text" value="" name="selected_folder"></p>
  <input type="submit" name="move" value="Move File">
  Choose file: <input name= 'uploaded[]' type = 'file'/><br/>
  <input type="submit" value="Upload"/>             
</form>
</div>

<?php
if (!empty($_POST)) {
  
    
    if (isset($_POST["folder"])) {
        if (!empty($_POST["new_directory"])) {
      makeDirectory($_POST["new_directory"]);
    }
  }
    if (isset($_POST["open"])) {
        if (file_exists($full_directory . "/" . $_POST["moveto_folder"])) {
            //REGEX NEEDED TO AVOID GOING OUT OF ROOT
            if ($_POST["moveto_folder"] !== ".." || $_POST["moveto_folder"] !== "/..") {
                $active_directory = $active_directory . "/" . $_POST["moveto_folder"];
        echo $active_directory;
            }
        }
    }
    if (isset($_POST["move"])) {
    echo moveFiles($full_directory . "/" . $_POST["selected_file"], $full_directory . "/" . $_POST["selected_folder"] . "/" . $_POST["selected_file"]);
    }
    if(is_array($_FILES)){
        moveUploadedFile($full_directory);
    }
    if(isset($_POST['Go Up One Level'])){
        $full_directory = substr($full_directory, 0, strrpos($full_directory, '/'));
    }
var_dump($_POST);
}
?>

  <script src="js/scripts.js"></script>
</body>
</html>
