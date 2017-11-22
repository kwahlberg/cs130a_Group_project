  <!doctype html>

<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
//set_include_path ( "./classes" );
//spl_autoload_register ();
  if (isset($_GET['source'])) {
    highlight_file($_SERVER['SCRIPT_FILENAME']);
    exit;
  }
?>

  <html lang="en">

  <head>
    <meta charset="utf-8">

    <title>Group Assignment 2 Form</title>
    <meta name="description" content="CCSF">
    <meta name="author" content="CCSF">
    <style>
      @import url('https://fonts.googleapis.com/css?family=Ubuntu+Condensed');
      
      body {
        background-color: #0c3e50;
      }
      
      article {
        width: 700px;
        margin: 0 auto;
      }
      
      h1 {
        color: #ecf0f1;
        font-family: 'Righteous';
        letter-spacing: .1em;
        font-size: 2em;
        text-align: center;
      }
      
      p {
        text-align: center;
        font-family: 'Righteous';
        font-size: 1.5em;
        color: #ecf0f1;
      }
      
      form input {
        text-align: center;
        font-family: 'Righteous';
        font-size: 1.0em;
        width: 500px;
        padding: 20px;
        border-radius: 10px;
        border: 3px #ecf0f1;
        background-color: #e4495e;
        color: #ecf0f1;
      }
      
.button {
        width: 200px;
        margin-right: 20px;
      }

    </style>

    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
  </head>

<body>
  <article>
    <h1>Registration Form</h1>
          
<?php

if (isset($_POST['submitted'])) {
  formSubmitted();
}  
elseif (isset($_POST['signup'])) {
  displayForm();
} 
else {
  echo '<form method="POST" action=""><p><input class="button"" type="submit" name="signup"  value="Sign Up"></p></form>' ;
}


function displayForm() {

  echo "
    <form action='week10.php' autocomplete='on' method='POST'>
      <p>First name</p>
      <p><input type='text' name='firstname' required  pattern='[A-Za-z].{1,}'></p>
      <p>Last name</p>
      <p><input type='text' name='lastname' required  pattern='[A-Za-z].{1,}'></p>
      <p>Email</p>
      <p><input type='email' name='email' required ></p>
      <p>Phone</p>
      <p><input type='tel' name='phone' pattern='^\d{3}\d{3}\d{4}$' required  maxlength='10' ></p>
      <p> Login:</p>
      <p> <input type='text' name='login' required></p>
      <p> Password:</p>
      <p> <input type='password' name='password' required pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}'
          title='Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters'></p>
      <p><input class='button' type='reset' name='reset' required value='Reset'><input class='button' type='submit' name='submitted'  value='Submit'></p>
    </form>";
}

function formSubmitted(){
    $csphp = new Course('CS130a');
    $form_data = $_POST;
    $csphp->addStudent($form_data);
    $studentarray = $csphp->getStudents();
    foreach($studentarray as $stu){
        $stu_rec = $stu->getRecord();
        foreach($stu_rec as $key => $value){
            echo "<p>$key: $value </p>";
        }
    }
    echo "<p><a href='https://hills.ccsf.edu/~kwahlber/cs130a/week10.php'><button> Reset </button></p>";
}


class Course{
    private $students_in_class = null;
    private $course_name;

    public function __construct($course_name) {
                $this->course_name = $course_name;
    }
    //line 130ish
    public function addStudent($studentdata=null){
        if(!empty($studentdata) && is_array($studentdata)){
            $a_student = new StudentRecord($studentdata);
            $this->students_in_class[] = $a_student;
        }
    }
    
    public function getCourseName(){
                return $this->course_name;
        }
    
    public function getStudents(){
        return $this->students_in_class;
    }
    
    public function getStudentsById($id){
            return $this->students_in_class[$id];
    }
}

class StudentRecord{
    protected $sec_ad;
    public $col = array('firstname','lastname','email','phone','login','password');
    private $student_data;
    
    //implement database stuff later
    public function __construct($student_data/*, SecureAdapter $sec_ad =null*/) {
        //$this->sec_ad = ($sec_ad) ?: new SecureAdapter;
        if(!empty($student_data)){
            $this->setLocalRecord($student_data);
        }
        else{
            throw new Exception('Empty array or null passed to student record');
        }       
    }

    public function setLocalRecord($data){
        if(!empty($data)){
            foreach($data as $key => $val){
                foreach($this->col as $value){
                    if($key==$value){
                        $this->student_data[$key] = $val;
                    }
                }
            }
        }
        else{
            throw new Exception('Empty array or null passed to student record');
        }
    }

    public function setDbRecord($data){
        $keyval = $data;
        
        if(!empty($data)){
            foreach($keyval as $key => $value){
                $safe_key = $this->sec_ad->secureField($key);
                $sec_key[] = '`' .$safe_key. '`';
                $safe_value = $this->sec_ad->secureField($value);
                $sec_val[] = '`' .$safe_value. '`';
                $this->student_data[$sec_key] = $sec_val; 
            }

            $cat_vals = implode(',',$sec_val);
            $cat_keys = implode(',',$sec_key);
            $result = $this->sec_ad -> query("INSERT INTO `students` (".$cat_keys.") VALUES (" .$cat_vals. ")");
        }
        else{
            echo 'setDbRecord Needs array with value key pairs from html forms';
        }                
        
        return $result;
    }
    
    public function getRecord(){
        return $this->student_data;
    }

    public function getRecordById($id){
        $sec_id = $this->sec_ad->secureField($id);
        $rec = $this->sec_ad -> select("SELECT * FROM `students` WHERE id=$sec_id");
        return $rec;     
    }

}

      
/* Inheritance: StudentGrade class inherits StudentRecord, this class manages student
 * grade and calculate the letter grade based on student overall grade
 */  
class StudentGrade extends StudentRecord{
    private $midterm_1;
    private $midterm_2;
    private $final_grade;
    
    public function setMidterm1($grade){
        if($grade >= 0 && is_numeric($grade)){
            $this->midterm_1 = $grade;
        }
        else{
            echo "ERROR! Invalid value for midterm 1 grade";
            return false;
        }
    }
    
     public function setMidterm2($grade){
        if($grade >= 0 && is_numeric($grade)){
            $this->midterm_2 = $grade;
        }
        else{
            echo "ERROR! Invalid value for midterm 2 grade";
            return false;
        }
    }
    
     public function setFinal($grade){
        if($f >= 0 && is_numeric($grade)){
            $this->final_grade = $grade;
        }
        else{
            echo "ERROR! Invalid value for final grade";
            return false;
        }
    }
    
    public function getMidterm1(){
        return $this->midterm_1;
    }
    
    public function getMidterm2(){
        return $this->midterm_2;
    }
    
    public function getFinal(){
        return $this->final_grade;
    }
    
    public function getLetterGrade(){
        $overall = ($this->midterm_1 + $this->midterm_2 + $final_grade) / 3.0;
        if ($overall > 90)
            return "A";
        else if ($overall > 80)
            return "B";
        else if ($overall > 70)
            return "C";
        else if ($overall > 60)
            return "D";
        else
            return "F";
            
    }
}
  
//database adapter to be implemented later
class SecureAdapter {
    protected static $connection;
    
    public function __construct($config=null) {
        $this->config = ($config) ?: '/../config.ini';
    }

    public function connect() {
        if(!isset(self::$connection)) {
            $db_login = parse_ini_file($this->config);
            self::$connection = new mysqli('localhost',$db_login['username'],$db_login['password'],$db_login['dbname']);
        }

        if(self::$connection === false) {
            echo "Warning! Can't connect to database!";
            return false;
        }
        return self::$connection;
    }

    public function query($query) {
        $connection = $this -> connect();
        $result = $connection -> query($query);
        return $result;
    }

    public function select($query) {
        $rows = array();
        $result = $this -> query($query);

        if($result === false) {
            return false;
        }
        while ($row = $result -> fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
    
    public function secureField($value) {
        $connection = $this -> connect();
        return "'" . $connection -> real_escape_string($value) . "'";
    }

    public function error() {
            $connection = $this -> connect();
            return $connection -> error;
    }
}

?>

    </article>

//    <script src="js/scripts.js"></script>
  </body> 
