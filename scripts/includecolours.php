<?php
//sel
require_once("./connect.php");
//store the SQL statement in a variable

$sqlcolours = 'SELECT * FROM colours';

//query the SQL variable statement and store in a result variable

$resultcolours = $db->query($sqlcolours);

//var_dump($resultuser);
//var_dump($db->error);
//if($db->error){
  //  exit("SQL error");
//}
echo" </br> total colours number: ".$resultcolours->num_rows.;

$resultcolours->free();
//close the db connection
$db->close();

?>