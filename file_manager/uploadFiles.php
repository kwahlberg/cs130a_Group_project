<?php
	if(isset($_GET['source'])){
		highlight_file($_SERVER['SCRIPT_FILENAME']);
		exit;
}
?>

<html>
	<head>
		<title>Upload File</title>
	</head>
	
	<body>
		<h2> Upload File</h2>
		<form enctype="multipart/form-data" action="{$_SERVER['SCRIPT_URL']}" method = "post">
			Choose file: <input name= 'uploaded[]' type = 'file'/><br/>
			<input type="submit" value="Upload"/>
 		</form>
	
	<?php
		//function to display the link
		function displayLink($dirname, $glob = NULL){
			if (!file_exists($dirname)) 
				return FALSE;
			if (strlen($glob)){
				if(substr($dirname, -1) == '/')
					$dirname .= $glob;
				else
					$dirname .= '/'.$glob;
			}
			
			if(count($files = glob($dirname, GLOB_BRACE))){
				foreach ($files as $file){
					if (filetype($file) == 'file')
						$links[] = "<a href = '${file}' target = '_blank'>${file} </a>";
					else{
						$subdir = displayLink($dirname,$glob);
						if (is_array($subdir) && count($subdir))
							$links = array_merge($links, $subdir);
					}
				}
			}
			else
				return NULL;
		
			//return all the links from directories
			if (isset($links))
				return $links;

			return NULL;
		}
	
		
		function moveUploadedFile($dirname){
			//process when submitted file upload
			if(is_array($_FILES) && count($_FILES) && isset($_FILES[uploaded])){
				foreach ($_FILES['uploaded']['error'] as $key => $error){
					if($error == UPLOAD_ERR_OK){
						$tmp_name = $FILES['uploaded']['tmp_name'][$key];
						$name = basename($_FILES['upload']['name'][$key]);
						move_uploaded_file($tmp_name, $dirname);
					}
				}//end foreach
			}//end if
		}//end moveUploadedFile
		
		
		//Testing two function
		$myfolder = '../../../images';
		$fileTypes = "{*.gif,*.jpg,*.png}";
		moveUploadedFile($myfolder);
		$links = displayLink($myfolder, $fileTypes);
		if (is_array($links)){
			echo '<ul><li>';
			echo implode('</li><li>', $links);
			echo '</li></ul>';
		}
	?>
		
	</body>
</html>