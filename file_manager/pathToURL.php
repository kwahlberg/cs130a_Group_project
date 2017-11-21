<?php
if (isset($_GET['source'])) {
        highlight_file($_SERVER['SCRIPT_FILENAME']);
        exit;
}
$base_directory = getcwd();
$active_directory = "/data";
$full_directory = $base_directory . $active_directory;
// Creates a folder, parameter accepts must accept absolute path only, returns $
function makeDirectory($name) {

        $message = "Folder created successfully!";
        global $full_directory;
        if (file_exists($full_directory . "/" . $name)) {
                $message = "The folder already exists!";
        } else if (!mkdir($full_directory . "/" . $name, 0755)) {
                $message = "Something happened! Could not create folder.";
        }
	return $message;
}
// Returns an array of file paths of the current directory, parameter is absolu$
function getFiles($name) {
        listURL(scandir($name));
}
// Moves a file from absolute directory to absolute directory. returns a string$
function moveFiles($origin, $destination) {
        $message = "File moved successfully!";
        if (file_exists($destination)) {
                $message = "There is another file with the same name at the des$
        } else if (!rename($origin, $destination)) {
                $message = "Something went wrong! File was not moved.";
        }
	return $message;
}
?>







