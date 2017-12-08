<?php
class LogModel{
    protected static $db;
    
    private function __construct() {
                require_once('phplib/app/models/dbadapter.php');
                //$db_login = parse_ini_file('secure/config.ini');
                $db = new dbAdapter('/students/kwahlber/cs130a/group/MVC/config.ini');
                if (!$db) echo "<p>Cannot connect to database</p>";
    }
    public function initAdapter(){
        require_once('phplib/app/models/dbadapter.php');
        $db = new dbAdapter('/students/kwahlber/cs130a/group/MVC/config.ini');
        if (!$db) echo "<p>Cannot connect to database</p>";
    }
     public function meanVisit(){
        if(!$db) initAdapter();
        $result = $db->select('SELECT count(*), AVG(TIME_TO_SEC(TIMEDIFF(`ts_in`,`ts_out`))) as avdiff FROM  sec_log;') ;
        return $result;
    }
    
    public function logOut($vname){
        if(!$db) initAdapter();
        $query = 'INSERT INTO `sec_log`(`ts_out`) VALUES(NOW()) WHERE `v_name` = ' .$db->secureField($vname);
        $result = $db->query($query) ;
        return $result;
    }
    public function listTenants(){
        if(!$db) initAdapter();
        $result = $db->select('SELECT `t_name` FROM `tenants` ') ;
        return $result;
    
    public function getActive(){
        if(!$db) initAdapter();
        $result = $db->select('SELECT * FROM `sec_log` WHERE `ts_out` = NULL') ;
        return $result;
    }
    
    public function countActive(){
        if(!$db) initAdapter();
        $result = $db->query('SELECT count(*) FROM `sec_log` WHERE `ts_out` = NULL') ;
        return $result;
    }
    public function createEntry($vname, $tname){
        if(!$db) initAdapter();
        $v_name = $db->secureField($vname);
        $t_name = $db->secureField($tname);
        $myquery = <<<HEREDOC
        INSERT INTO `sec_log`(`v_name`, `t_name`,`ts_out`) VALUES ($v_name, $t_name, NULL)
HEREDOC;

        if($db->query($myquery)){
                $v_id = $db->getId();
                $message = 'Thank you ' .$v_name. 'your entry time is ' .$db->query('SELECT `ts_in` FROM `sec_log` WHERE v_id = '.$v_id);
                }else{
                    $message = 'something went wrong ';
             
                }
        
        }
        return $message;                                                                               
    }
    
}
?>