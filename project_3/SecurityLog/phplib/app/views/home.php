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

    <div id="login-form">

    <form action='index.php?page="login"' autocomplete='on' method='POST'>
      <p>Visitor name</p>
      <input type='text' name='v_name' maxlength='30' required />
      <p>Tenant name</p>
      <input type='text' name='t_name' maxlength='30' required />
      <select name="tenant">
<?php
foreach($model->tenants as $tenant){
  echo '<option value="' . $tenant['t_name'] . '">' . $tenant['t_name'] . '</option>';
}
?>
      </select>
      <input type="submit" value="Log Visit" />
    </form>

  <div id="current-visitors">

    <table>
      <tr>
        <th>ID</th>
        <th>Visitor Name</th>
        <th>Visiting</th>
        <th>Time In</th>
        <th>Time Out</th>
      </tr>
      <tr>
        <td>visitor </td>
        <td>tenant name</td>
        <td>time in</td>
        <td>time out</td>
      </tr>
<?php
foreach($model->visitors_in as $visitor){
  echo "<tr>" .
    "<td>$visitor['v_id']</td>" .
    "<td>$visitor['t_name']</td>" .
    "<td>$visitor['ts_in']</td>" .
    "<td>'Currently Inside'</td>" .
    "</tr>";
  }
?>
    </table>
  </div>

  <script src="js/scripts.js"></script>
</body>
</html>
