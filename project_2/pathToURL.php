<?php
  if (isset($_GET['source'])) {
    highlight_file($_SERVER['SCRIPT_FILENAME']);
    exit;
  }
// diplays a single url as full url. takes relative path as arg.
function displayURL($path,$active_dir) {
       // global $_SESSION["currentDir"];
        if(preg_match("/^[A-Za-z0-9_ ]+\.([A-Za-z0-9]+$)/", $path)){
                $dir_split = preg_split("/\/public_html/", $_SESSION["currentDir"]);
                //echo "$dir_split[0]";
                $user = '/'.'~'. substr($dir_split[0], strrpos($dir_split[0], '/') + 1);
                $full_path ='https://'. $_SERVER['SERVER_NAME'] . $user . $dir_split[1] . '/' . $path;
                $type = mime_content_type ($active_dir .'/'. $path);
                echo "<br><a href = '$full_path'>";
                if(preg_match('/^image/',$type)){
                        echo "<br><img src='$full_path' style='width:42px;height:42px;border:1;'>'".$full_path."</a>";
                }else{
                echo  $full_path . "</a>";
                }
                //echo "<p>resource not found. Please check path and try again</p>";
        }
}

//take array or take dir path to create urls from array of file names as strings
function listURL($path){
        if(!is_array($path)){
                //print_r($path);
                $dir_split = preg_split("/\/public_html/", $path);
                $afterdata = preg_split("/\/data/", $dir_split[1]);
                
		if($afterdata[1]){
			$withdata = 'data' . $afterdata[1];
		}else{$withdata = 'data';
		}
		
                $karray = scandir($withdata);
        }else{
              	$karray = $path;
        }

	global $full_directory;
        if(is_array($karray)){
                foreach($karray as $value){
                        //echo "<br>" . "/" . $value;
                        displayURL($value, $withdata);
                }
        }
}
//examples
//displayURL('../cs130a/week11.php');
//$urls = ['week10.php','../test/test.php','week3.php'];
//listURL($urls);
?>










