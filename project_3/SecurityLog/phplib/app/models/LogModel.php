
	
<?php
include_once('phplib/app/models/dbadapter.php');
//----------------------------------------------
class LogModel{
    public static $db;
    public $visitors_in;
    public $history;
    public $count;
    public $mean_visit;
    public $tenants;
    
    public function __construct() {
			require_once('phplib/app/models/dbadapter.php');
			self::$db = new dbAdapter('secure/config.ini');
			if (!self::$db) echo "<p>Cannot connect to database</p>";
		}
		
    public function initAdapter(){
			require_once('phplib/app/models/dbadapter.php');
			self::$db = new dbAdapter('secure/config.ini');
			if (!self::$db) echo "<p>Cannot connect to database</p>";
    }
		
    public function meanVisit(){
			//if(!self::$db) initAdapter();
			$result = self::$db->query('SELECT count(*), AVG(TIME_TO_SEC(TIMEDIFF(`ts_in`,`ts_out`))) as avdiff FROM  sec_log');
			$mean_visit = $result;
			return $result;
    }
    
    public function logOut($v_id){
        echo $v_id;
			//if(!self::$db) initAdapter();UPDATE sec_log SET ts_out=NOW() WHERE v_id = 1;
			$query = 'UPDATE sec_log SET ts_out=NOW() WHERE v_id ='. $v_id;
			if($result = self::$db->query($query)){
				$message = 'Thank you ';
			}
			else{
				$message = 'something went wrong ';
			}
			//return $message;
    }
    
    public function listTenants(){
			//if(!self::$db) self::initAdapter();
			$result = self::$db->select('SELECT `t_name` FROM `tenants` ') ;
			$tenants = $result;
            //print_r($result);
			return $result;
		}
    
    public function getActive(){
			//if(!self::$db) initAdapter();
			$result = self::$db->select('SELECT * FROM `sec_log` WHERE `ts_out` IS NULL') ;
			$visitors_in = $result;
			return $result;
    }
	
    public function history(){
			//if(!self::$db) initAdapter();
			$result = self::$db->select('SELECT * FROM `sec_log`') ;
			$history = $result;
			return $result;
    }
	
    public function countActive(){
			
			$result = self::$db->query('SELECT count(*) FROM `sec_log` WHERE `ts_out` IS NULL') ;
			$count = $result;
			return $result;
    }
	
    public function LogIn($vname, $tname){
			
			$v_name = self::$db->secureField($vname);
			$t_name = self::$db->secureField($tname);
            echo $v_name;
			$myquery = "INSERT INTO sec_log (v_name, t_name) VALUES (".$v_name.",".$t_name.")";

			if(self::$db->query($myquery)){
				$v_id = self::$db->getId();
				$message = 'Thank you ' ;
                //.$v_name. 'your entry time is ' .self::$db->query('SELECT `ts_in` FROM `sec_log` WHERE `v_id` = '.$v_id);
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

