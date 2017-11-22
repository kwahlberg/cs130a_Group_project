<!doctype html>

<?php

session_start();
include("directoryViewer.php");
include("pathToURL.php");

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

if (!empty($_POST)) {
  header("Refresh:0");
}

if( !empty($_SESSION["currentDir"]) ) {
  echo "<p>Current Folder: " . $_SESSION["currentDir"] . "</p>";
  getFiles($_SESSION["currentDir"]);
} else {
  $_SESSION["currentDir"] = $full_directory;
  header("Refresh:0");
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
  <input type="submit" name="root" value="Go to Root Folder">
  <h1>Move a File to Folder</h1>
  <p>File Name: <input type="text" value="" name="selected_file"></p>
  <p>Folder Name: <input type="text" value="" name="selected_folder"></p>
  <input type="submit" name="move" value="Move File">
</form>
<h1>Upload Files</h1>
<p>Click <a href="uploadFiles.php">here</a> to upload files.</p>
</div>

<?php

if (!empty($_POST)) {

	if (isset($_POST["folder"])) {

		if (!empty($_POST["new_directory"])) {
      makeDirectory(sanitizeData($_POST["new_directory"], false), $_SESSION["currentDir"]);
    }

  }

	if (isset($_POST["open"])) {

		if (file_exists($_SESSION["currentDir"] . "/" . sanitizeData($_POST["moveto_folder"], false))) {
				$_SESSION["currentDir"] = $_SESSION["currentDir"] . "/" . sanitizeData($_POST["moveto_folder"], false);
		}
	}


	if (isset($_POST["move"])) {
    echo moveFiles($_SESSION["currentDir"] . "/" . sanitizeData($_POST["selected_file"], false), $_SESSION["currentDir"] . "/" . sanitizeData($_POST["selected_folder"], false) . "/" . sanitizeData($_POST["selected_file"], false));
  }

  if (isset($_POST["up"])) {

    if ( strlen($full_directory) > strlen($_SESSION["currentDir"]) ) {
      $pattern = "/\/[^\/]*$/";
      $_SESSION["currentDir"] = sanitizeData($_SESSION["currentDir"], true);
      $_SESSION["currentDir"] = preg_replace($pattern, "", $_SESSION["currentDir"]);
    } else {
      $_SESSION["currentDir"] = $full_directory;
    }

  }

  if (isset($_POST["root"])) {
    $_SESSION["currentDir"] = $full_directory;
  }

}

?>

  <script src="js/scripts.js"></script>
</body>
</html>
