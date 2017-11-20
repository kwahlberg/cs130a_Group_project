<?php
if (isset($_GET['source'])) {
	highlight_file($_SERVER['SCRIPT_FILENAME']);
	exit;
}

// Creates a folder, parameter accepts must accept absolute path only, returns a string with message.
function makeDirectory($name) {
	
	message = "Folder created successfully!";

	if (file_exists($name)) {
		message = "The folder already exists!";
	} else if (!mkdir($name, 0777)) {
		message = "Something happened! Could not create directory.";
	}

	return message;
}

// Returns an array of file paths of the current directory, parameter is absolute path of directory scan.
function getFiles($name) {
	return scandir($name);
}

// Moves a file from absolute directory to absolute directory. returns a string with message.
function moveFiles($origin, $destination) {

	message = "File moved successfully!";

	if (file_exists($destination) {
		message = "There is another file with the same name at the destination";
	} else if (!rename($origin, $destination)) {
		message = "Something went wrong! File was not moved.";
	}

	return message;
}
?>
