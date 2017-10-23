<!doctype html>

<?php
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
      @import url('https://fonts.googleapis.com/css?family=Righteous');
      
      body {
        background-color: #2c3e50;
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
        border: 3px dashed #ecf0f1;
        background-color: #34495e;
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
  displayInfo();
} elseif (isset($_POST['signup'])) {
  displayForm();
} else {
  echo '<form method="POST" action=""><p><input class="button"" type="submit" name="signup"  value="Sign Up"></p></form>' ;
}

function displayForm() {

  echo "
    <form action='group2.php' autocomplete='on' method='POST'>
      <p>First name</p>
      <p><input type='text' name='fname' required  pattern='[A-Za-z].{1,}'></p>
      <p>Last name</p>
      <p><input type='text' name='lname' required  pattern='[A-Za-z].{1,}'></p>
      <p>Email</p>
      <p><input type='email' name='email' required ></p>
      <p>Phone</p>
      <p><input type='tel' name='phone' pattern='^\d{3}\d{3}\d{4}$' required  maxlength='10' ></p>
      <p> Login:</p>
      <p> <input type='text' name='login' required></p>
      <p> Password:</p>
      <p> <input type='password' name='pw' required pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}'
          title='Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters'></p>
      <p><input class='button' type='reset' name='reset' required value='Reset'><input class='button' type='submit' name='submitted'  value='Submit'></p>
    </form>";
}


function displayInfo(){
    $fname = $_REQUEST['fname'];
     echo "<p>First Name: $fname</p>";
    $lname = $_REQUEST['lname'];
    echo "<p>Last Name: $lname</p>";
    $email = $_REQUEST['email'];
    echo "<p>Email: $email</p>";
    $phone = $_REQUEST['phone'];
    echo "<p>Phone: $phone</p>";
     $login = $_REQUEST['login'];
    echo "<p>Login: $login</p>";
     $pw = $_REQUEST['pw'];
     echo "<p>Password: *********</p>";
        echo "<p><a href='https://hills.ccsf.edu/~kwahlber/cs130a/group2.php'><button> Back </button></p>";
}


?>

    </article>

    <script src="js/scripts.js"></script>
  </body>

  </html>
