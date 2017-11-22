<?php
  if (isset($_GET['source'])) {
    highlight_file($_SERVER['SCRIPT_FILENAME']);
    exit;
  }
// diplays a single url as full url. takes relative path as arg.
function displayURL($path) {
        global $full_directory;
        global $active_directory;
        if(preg_match("/^[A-Za-z0-9_ ]+\.([A-Za-z0-9]+$)/", $path)){

                $dir_split = preg_split("/\/public_html/", $full_directory);
                //echo "$dir_split[0]";
                $user = '/'.'~'. substr($dir_split[0], strrpos($dir_split[0], '/') + 1);;
                $full_path ='https://'. $_SERVER['SERVER_NAME'] . $user . $dir_split[1] . '/' . $path;
                $type = mime_content_type ($active_directory .'/'. $path);

                echo "<br><a href = '$full_path'>";
                if(preg_match('/^image/',$type)){
                        echo "<br><img src='$full_path' style='width:42px;height:42px;border:20px;'>'".$full_path."</a>";
                }else{
                echo  $full_directory . "</a>";
                }
                //echo "<p>resource not found. Please check path and try again</p>";
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













