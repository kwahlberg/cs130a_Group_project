<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Security Log PHP App</title>
  <meta name="description" content="Project for CCSF 130A">
  <meta name="author" content="By Eduardo Garcia, Kurt Wahlberg, and Thi Mach">

  <link rel="stylesheet" href="css/styles.css?v=1.0">

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>

  <div id="current-visitors">
    <h1>History Log</h1>

    <table>
      <tr>
        <th>ID</th>
        <th>Visitor Name</th>
        <th>Visiting</th>
        <th>Time In</th>
        <th>Time Out</th>
          
      </tr>
    
<?php
        //print_r($active);
foreach($history as $visitor){
  echo "<tr>" .
    "<td>" .$visitor['v_id']. "</td>" .
    "<td>".$visitor['v_name']."</td>" .
    "<td>".$visitor['t_name']."</td>" .
    "<td>".$visitor['ts_in']."</td>" ;
    if($visitor['ts_out']){
        echo '<td>'.$visitor['ts_out'].'</td>';
    }else{
    echo "<td>'Currently Inside'</td>" ;
    }
  }
?>
    </table>
  </div>

  <script src="js/scripts.js"></script>
</body>
</html>
