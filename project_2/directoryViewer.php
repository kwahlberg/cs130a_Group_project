<?php
if (isset($_GET['source'])) {
	highlight_file($_SERVER['SCRIPT_FILENAME']);
	exit;
}

$full_directory = getcwd() . "/data";

// Creates a folder, parameter accepts must accept absolute path only, returns a string with message.
function makeDirectory($folder, $path) {

	$message = "Folder created successfully!";

	if (file_exists($path . "/" . $folder)) {
		$message = "The folder already exists!";
	} else if (!mkdir($path . "/" . $folder, 0755)) {
		$message = "Something happened! Could not create folder.";
	}

	return $message;
}

// Returns an array of file paths of the current directory, parameter is absolute path of directory scan.
function getFiles($path) {
	listURL(scandir($path));
}

function sanitizeData($string, $urlBool) {
	$pattern = "/[\.*]/";
	$newString = preg_replace($pattern, "", $string);

	if (!$urlBool) {
		$pattern = "/[\/*]/";
		$newString = preg_replace($pattern, "", $newString);
	}

	return $newString;
}

// Moves a file from absolute directory to absolute directory. returns a string with message.
function moveFiles($origin, $destination) {

	$message = "File moved successfully!";

	if (file_exists($destination)) {
		$message = "There is another file with the same name at the destination";
	} else if (!rename($origin, $destination)) {
		$message = "Something went wrong! File was not moved.";
	}

	return $message;
}
?>
