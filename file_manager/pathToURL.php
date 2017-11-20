<?php
  if (isset($_GET['source'])) {
    highlight_file($_SERVER['SCRIPT_FILENAME']);
    exit;
  }
// diplays a single url as full url. takes relative path as arg.
function displayURL($path) {
        if(file_exists($path)){
                $fullurl = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                $fullurl = substr($fullurl, 0,strrpos($fullurl, '/')) .'/'. $path;

                echo "<p><a href = '//$fullurl'>" .$fullurl . "</a></p>";
        }else{
              	echo "<p>resource not found. Please check path and try again</p>";

        }
}
//displays list of urls takes array of strings
function listURL($urlarray){
	global $full_directory;
        if(is_array($urlarray)){
                foreach($urlarray as $value){
			echo $full_directory . "/" . $value;
                        displayURL($full_directory . "/" . $value);
                }
        }
}
//examples
//displayURL('../cs130a/week11.php');
//$urls = ['week10.php','../test/test.php','week3.php'];
//listURL($urls);

?>


