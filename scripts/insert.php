<?php

// require_once("./connect.php");
//store the SQL statements in a variables
/* $sql = 'INSERT INTO products (product_name, price, details, category, subcategory, colour) VALUES("new_product3","10000","details_here","Ladies","Accessories","5")';
$result = $db->query($sql);

if($result===true){
    echo "new product added</br>";
} else {
    echo "there was an error";
}
//close the db connection
$db->close(); */

/* 
<=============================================== NOTE TO ADD VIA FORM BUTTON =================================>
syntax for submitting a form to Database
if(!empty($_POST['button_name'])){
    if(empty($_POST['input1_name'])||empty($_POST['input2_name']))
    {
    exit("error message. <a href='return link'>return</a>");
}
    $sql="INSERT INTO products (column1, column2) VALUES ('{$_POST['input1_name']}','{$_POST['input2_name']}')";
    require_once("./connect.php");
$result = $db->query($sql);

if($result===true){
    echo "success</br>";\
} else {
    echo "failure";
    var_dump($db->error);
}
//close the db connection
$db->close(); 
    }

?>
<form action ="" method="POST">
    input1: <input name="input1_name" type="text" value=""/></br>
    input2: <input name="input2_name" type="text" value=""/></br>
    <input name="button_name" type="submit" value="submit"/></br>
</form>

<=====================================END OF ADD NOTE NOTE======================>

*/

if(!empty($_POST['button_name'])){
    if(empty($_POST['product_name'])||empty($_POST['product_price'])||empty($_POST['product_details'])||empty($_POST['product_category'])||empty($_POST['product_subcategory'])||empty($_POST['product_colour'])){
    exit("please fill all the form fields. <a href='insert.php'>return</a>");
}
    $sql="INSERT INTO products (product_name, price, details, category, subcategory, colour) VALUES ('{$_POST['product_name']}','{$_POST['product_price']}','{$_POST['product_details']}','{$_POST['product_category']}','{$_POST['product_subcategory']}','{$_POST['product_colour']}')";
    require_once("./connect.php");
$result = $db->query($sql);

if($result===true){
    echo "new product added</br>";
} else {
    echo "there was an error";
    var_dump($db->error);
}
//close the db connection
$db->close(); 
    }

?>
<form action ="" method="POST">
    product name: <input name="product_name" type="text" value=""/></br>
    product price: <input name="product_price" type="text" value=""/></br>
    product details: <input name="product_details" type="text" value=""/></br>
    product category: <input name="product_category" type="text" value=""/></br>
    product subcategory: <input name="product_subcategory" type="text" value=""/></br>
    product colour: <input name="product_colour" type="text" value=""/></br>
    <input name="button_name" type="submit" value="add product"/></br>
</form>


<?php
require_once("./connect.php");
//store the SQL statements in a variables
$sqlproducts = 'SELECT * FROM products';

//query the SQL variables statement and store in a result variables
$resultproducts = $db->query($sqlproducts);

$output = "total products number: ".$resultproducts->num_rows." </br>";
echo $output;
$dynamic_options = "";
//outputting the detail of the different tables
//unique array variable name and result name
echo "<hr>The Products are:</br>";
while ($array_products = $resultproducts->fetch_array()){
    echo "".$array_products['product_id'] ." : ".$array_products['product_name']."</br>";
   
    $dynamic_options .= '<option value="'.$array_products['product_id'].'">'.$array_products['product_name'].'</option>';
}

?>

<?php
/* 
<=============================================== NOTE TO UPDATE VIA FORM BUTTON =================================>
syntax for submitting a form to Database
if(!empty($_POST['button_name'])){
    if(empty($_POST['input1_name'])||empty($_POST['input2_name']))
    {
    exit("error message. <a href='return link'>return</a>");
}
    $sql="INSERT INTO products (column1, column2) VALUES ('{$_POST['input1_name']}','{$_POST['input2_name']}')";
    require_once("./connect.php");
$result = $db->query($sql);

if($result===true){
    echo "success</br>";\
} else {
    echo "failure";
    var_dump($db->error);
}
//close the db connection
$db->close(); 
    }

?>
<form action ="" method="POST">
    input1: <input name="input1_name" type="text" value=""/></br>
    input2: <input name="input2_name" type="text" value=""/></br>
    <input name="button_name" type="submit" value="submit"/></br>
</form>

<=====================================END OF UPDATE NOTE NOTE======================>


*/

$pid = "";
if(isset($_POST['button2_name'])){
    if(empty($_POST['new_name']))
    {
    exit("you didn't enter a new name <a href='insert.php'>return</a>");
}   
    $sql="UPDATE products SET product_name = '{$_POST['new_name']}' 
    WHERE product_id = '{$_POST['id_of_product']}' LIMIT 1";
    require_once("./connect.php");
$result = $db->query($sql);

if($result===true){
    header("location: insert.php");
    //exit("successful update");
   echo "successful update</br>";
} else {
    echo "failure";
    var_dump($db->error);
   
}
//close the db connection
$db->close(); 
    }

?>
<hr>
<form action ="" method="POST">
    <select name="id_of_product"><?php echo $dynamic_options; ?></select>
    new name: <input name="new_name" type="text" value="" placeholder="new product name"/></br>
<input name="button2_name" type="submit" value="update"/></br>
</form>