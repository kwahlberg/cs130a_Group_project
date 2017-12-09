<html>  
<head></head>  
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
<body>    
       
    <form action='LogModel.php?page="login"' autocomplete='on' method='POST'>
      <p>Visitor name
      <input type='text' name='v_name' maxlength='30' required></p>
      <p>Tenant name
      <input type='text' name='t_name' maxlength='30' required></p>
      <select name="tenant">';
<?php
foreach($tenants as $tenant){
  echo '<option value="' .$tenant['t_name']. '">' .$tenant['t_name']. '</option>';
    
}
?>
</select>

<table>  
        <tr><th>ID</th><th>Visitor Name</th><th>Visiting</th><th>Time In</th><th>Time Out</th></tr>  
        
<?php 
    foreach($model->visitors_in as $visitor){
      
      echo " <tr><td> $visitor['v_id']</td>";
      echo " <td> $visitor['t_name']</td>";
      echo " <td> $visitor['ts_in']</td>";
      echo " <td> $visitor['ts_out']</td></tr>";
    }
?>
      </table>
      </body>
  
    
