<?php
//WE CAN SELECT MUTLIPLE TABLES AND MULTIPLE DATA
require_once("./connect.php");
//store the SQL statements in a variables
$sqlproducts = 'SELECT * FROM products';
$sqlcolours = 'SELECT * FROM colours';
$sqlsizes = 'SELECT * FROM sizes';
//query the SQL variables statement and store in a result variables
$resultproducts = $db->query($sqlproducts);
$resultcolours = $db->query($sqlcolours);
$resultsizes = $db->query($sqlsizes);
//var_dump($resultuser);
//var_dump($db->error);
//if($db->error){
  //  exit("SQL error");
//}
$output = "total products number: ".$resultproducts->num_rows." </br> total colours number: ".$resultcolours->num_rows." </br> total sizes number: ".$resultsizes->num_rows." </br> That's all the queries </br>";
echo $output;

//outputting the detail of the different tables
//unique array variable name and result name
echo "<hr>The Products are:</br>";
while ($array_products = $resultproducts->fetch_array()){
    echo "".$array_products['product_id'] ." : ".$array_products['product_name']."</br>";
}
echo "<hr>The sizes are:</br>";
while ($array_sizes = $resultsizes->fetch_array()){
    echo "".$array_sizes['size_id'] ." : ".$array_sizes['size_name']."</br>";
}
echo "<hr>The Colours are:</br>";
while ($array_colours = $resultcolours->fetch_array()){
    echo "".$array_colours['colour_id'] ." : ".$array_colours['colour_name']."</br>";
}
$resultproducts->free();
$resultcolours->free();
$resultsizes->free();
//close the db connection
$db->close();

?>