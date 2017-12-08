<?php
if(!$db){
        require_once('phplib/app/models/dbadapter.php');
        //$db_login = parse_ini_file('secure/config.ini');
        $db = new dbAdapter('/students/kwahlber/cs130a/group/MVC/config.ini');
        if (!$db) die("<p>Cannot open database</p>");
    }
    
?>