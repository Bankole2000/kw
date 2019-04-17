<?php
//sel
require_once("./connect.php");
//store the SQL statement in a variable

$sqlsizes = 'SELECT * FROM sizes';
//query the SQL variable statement and store in a result variable

$resultsizes = $db->query($sqlsizes);
//var_dump($resultuser);
//var_dump($db->error);
//if($db->error){
  //  exit("SQL error");
//}
echo "The number of sizes :".$resultsizes->num_rows." </br> That's all the queries";

$resultsizes->free();
//close the db connection
$db->close();

?>