<?php 
//database connection file
//order: localhost user password db_name
//use @ to block error report
//connect_error: null
$db = new mysqli('localhost','gw','Bankole1.','gw');
/* if($db->connect_error){
    exit("cannot connect to database");
    }
var_dump($db->connect_error); 

//close the connection
 if($db->close()){
    echo "bye";
} else {
    echo "error";
}; */

?>