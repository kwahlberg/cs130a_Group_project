	<?php
		include_once("phplib/app/models/LogModel.php");  

		class Controller {  
			public $model;   

			public function __construct()    
			{    
					$this->model = new LogModel();  
			}
			
			public function invoke()  
			{  
				if (isset($_GET['page']))  
				{  
					$page = $_GET['page'];
					if($page == 'home') { 
						$tenants = $model->listTenants();
						$active = $model->getActive();
						include_once('phplib/app/views/home.php');
					}
					if($page == 'login') {
						$message = $model->logIn();
						include_once('phplib/app/views/login.php');
					}
					if($page == 'logout'){
						$model->logOut();
						include_once('phplib/app/views/logout.php');
					}
					if($page == 'history'){
						$list = $model->history();  
						include_once('phplib/app/views/history.php'); 
					} 
				}
				else 
				{ 
					 
					$tenants = $model->listTenants();
					$active = $model->getActive();
					include_once('phplib/app/views/home.php');
				}  
			}  
		} 
			
	?>
