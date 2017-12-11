
	
<?php
require_once('phplib/app/models/dbadapter.php');
//----------------------------------------------
	class LogModel{
    protected static $db;
    public $visitors_in;
    public $history;
    public $count;
    public $mean_visit;
    public $tenants;
    
    public function __construct() {
			require_once('phplib/app/models/dbadapter.php');
			//$db_login = parse_ini_file('secure/config.ini');
			$db = new dbAdapter('/students/kwahlber/cs130a/group/MVC/config.ini');
			//$db = new dbAdapter('/students/tmach4/public_html/cs130a/Group/config.ini');
			
			if (!$db) echo "<p>Cannot connect to database</p>";
		}
		
    public function initAdapter(){
			require_once('phplib/app/models/dbadapter.php');
			$db = new dbAdapter('/students/kwahlber/cs130a/group/MVC/config.ini');
			if (!$db) echo "<p>Cannot connect to database</p>";
    }
		
    public function meanVisit(){
			if(!$db) initAdapter();
			$result = $db->select('SELECT count(*), AVG(TIME_TO_SEC(TIMEDIFF(`ts_in`,`ts_out`))) as avdiff FROM  sec_log');
			$this->mean_visit = $result;
			return $result;
    }
    
    public function logOut($vname, $v_id){
			if(!$db) initAdapter();
			$query = 'INSERT INTO `sec_log`(`ts_out`) VALUES(NOW()) WHERE `v_name` = ' .$db->secureField($vname);
			if($result = $db->query($query)){
				$message = 'Thank you ' .$db->secureField($vname). 'your exit time is ' .$db->query('SELECT `ts_out` FROM `sec_log` WHERE v_id = '.$v_id);
			}
			else{
				$message = 'something went wrong ';
			}
			return $message;
    }
    
    public function listTenants(){
			if(!$db) initAdapter();
			$result = $db->select('SELECT `t_name` FROM `tenants` ') ;
			$this->tenants = $result;
			return $result;
		}
    
    public function getActive(){
			if(!$db) initAdapter();
			$result = $db->select('SELECT * FROM `sec_log` WHERE `ts_out` = NULL') ;
			$this->visitors_in = $result;
			return $result;
    }
	
    public function history(){
			if(!$db) initAdapter();
			$result = $db->select('SELECT * FROM `sec_log`') ;
			$this->history = $result;
			return $result;
    }
	
    public function countActive(){
			if(!$db) initAdapter();
			$result = $db->query('SELECT count(*) FROM `sec_log` WHERE `ts_out` = NULL') ;
			$this->count = $result;
			return $result;
    }
	
    public function LogIn($vname, $tname){
			if(!$db) initAdapter();
			$v_name = $db->secureField($vname);
			$t_name = $db->secureField($tname);
			$myquery = "INSERT INTO `sec_log`(`v_name`, `t_name`,`ts_out`) VALUES ('".$v_name."','".$t_name."', NULL)";

			if($db->query($myquery)){
				$v_id = $db->getId();
				$message = 'Thank you ' .$v_name. 'your entry time is ' .$db->query('SELECT `ts_in` FROM `sec_log` WHERE `v_id` = '.$v_id);
			}
			else{
				$message = 'something went wrong ';
			}
			
			return $message;                                                                               
	}
    
}

//-----------------------------------------Not implemented

	class visitor{
		public $v_name;
		public $t_name;
		public $ts_in;
		public $ts_out;

		public function __construct($vname, $tname, $tsin, $tsout=null){
			$v_name = $vname;
			$t_name = $tname;
			$ts_in = $ts_in;
			$this->ts_out = ($ts_out) ?: 'Currently in building';
		}    
	}
    
?>

