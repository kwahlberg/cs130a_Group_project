<?php
  if (isset($_GET['source'])) {
        highlight_file($_SERVER['SCRIPT_FILENAME']);
        exit;
  }
?>
<title>Farm-Life Simulator</title><h1>Farm-Life Simulator</h1>
<form action='week8.php' method='POST'>
  <p>Select as many animals as you would like:<br/>
  <select name='animalNoise[]' size=5 multiple="multiple">
    <option value='pig:squeel'>Pig
    <option value='duck:quack'>Duck
    <option value='cow:moo'>Cow
    <option value='sheep:baa'>Sheep
    <option value='horse:neigh'>Horse
    <option value='dog:woof'>Dog
    <option value='cat:meow'>Cat
    <option value='rooster:cock-a-doodle-doo'>Rooster
  </select></p>
  <input type='submit' value='Sing!'>
</form>
<p><a href="http://hills.ccsf.edu/~kwahlber/cs130a/index.php">Back</a></p>
<?php

if(isset($_POST['animalNoise'])){
$verses = $_REQUEST['animalNoise'];

    foreach($verses as $value){
        $aniNoise = explode(':',$value);
        printOneVerse($aniNoise[0],$aniNoise[1]);
    }
}

function printOneVerse($animal = "pig",$noise ="oink") {

echo "<br>Old MacDonald had a farm, E-I-E-I-O!
<br>And on that farm he had a $animal, E-I-E-I-O!
<br>With a $noise-$noise here and a $noise-$noise there
<br>
Here a $noise, there a $noise, everywhere a $noise-$noise
<br>Old MacDonald had a farm, E-I-E-I-O!<br><br>";
}


?>
