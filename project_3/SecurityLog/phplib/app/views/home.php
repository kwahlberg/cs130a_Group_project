<html>  
<head></head>  
  
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
    foreach(
    
