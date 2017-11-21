<?php
  if (isset($_GET['source'])) {
    highlight_file($_SERVER['SCRIPT_FILENAME']);
    exit;
  }
// diplays a single url as full url. takes relative path as arg.
function displayURL($path) {
        global $full_directory;
        if(preg_match("/^[A-Za-z0-9_ ]+\.([A-Za-z0-9]+$)/", $path)){

                $dir_split = preg_split("/\/public_html/", $full_directory);
                //echo "$dir_split[0]";
                $user = '/'.'~'. substr($dir_split[0], strrpos($dir_split[0], '$
                $full_path ='https://'. $_SERVER['SERVER_NAME'] . $user . $dir_$
                echo "<p><a href = '$full_path'>" .$full_path . "</a></p>";
                //echo "<p>resource not found. Please check path and try again<$
        }
}
//displays list of urls takes array of strings
function listURL($urlarray){
        global $full_directory;
        if(is_array($urlarray)){
                foreach($urlarray as $value){
                        //echo $full_directory . "/" . $value;
                        displayURL($value);
                }
        }
}
//examples
//displayURL('../cs130a/week11.php');
//$urls = ['week10.php','../test/test.php','week3.php'];
//listURL($urls);
?>









