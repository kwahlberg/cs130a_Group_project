<?php
include("/students/kwahlber/public_html/cs130a/SecurityLog/phplib/app/models/LogModel.php");  

class Controller {  
			
            
			public function __construct()    
			{    
					 
			}
			
			public function invoke()  
			{
                include_once('phplib/app/views/navbar.php');
                $model = new LogModel();
				if (isset($_GET['page']))  
				{  
					$page = $_GET['page'];
					if($page == 'home') { 
						$tenants = $model->listTenants();
						$active = $model->getActive();
                        

						include_once('phplib/app/views/home.php');
					}
					if($page == 'login') {
                        if($_POST['v_name']&&$_POST['t_name']){
						  $message = $model->logIn($_POST['v_name'], $_POST['t_name'] );
						  include_once('phplib/app/views/login.php');
                        }
					}
					if($page == 'logout'){
                        if($_POST['v_id']){
						  $model->logOut($_POST['v_id']);
						  include_once('phplib/app/views/logout.php');
                        }else{$page='error';} 
					}
                    
					if($page == 'history'){
						$history = $model->history();  
						include_once('phplib/app/views/history.php'); 
					}
                    if($page == 'biglogout'){
						$active = $model->getActive();
						include_once('phplib/app/views/biglogout.php'); 
					}
                    if($page == 'average'){
						$mean = $model->meanVisit();  
						include_once('phplib/app/views/average.php'); 
					}
                    if($page == 'error'){
						  
						include_once('phplib/app/views/error.php');
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