<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
set_include_path ( "./classes" );
spl_autoload_register ();
  if (isset($_GET['source'])) {
    highlight_file($_SERVER['SCRIPT_FILENAME']);
    exit;
  }
?>
<head>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
</head>
<body>

<table>
      <tr>
        <th>ID</th>
        <th>Visitor Name</th>
        <th>Visiting</th>
        <th>Time In</th>
        <th>Time Out</th>
          <th>Log Out</th>
      </tr>
    
<?php
        //print_r($active);
foreach($active as $visitor){
  echo "<tr>" .
    "<td>" .$visitor['v_id']. "</td>" .
    "<td>".$visitor['v_name']."</td>" .
    "<td>".$visitor['t_name']."</td>" .
    "<td>".$visitor['ts_in']."</td>" .
    "<td>'Currently Inside'</td>" .
    "<td><form action='index.php?page=logout' method='POST'>".
    "<button name='v_id' type='submit' value='".$visitor['v_id']."'>Logout</button>
    </td></tr>";
  }
?>
    </table>