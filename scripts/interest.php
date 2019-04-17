<?php 

require_once ('connect.php');
$query = "UPDATE user_table SET rec_balance = rec_balance + (don_balance / 1000), eligibility = eligibility + (don_balance / 1000) WHERE eligibility < (2 * don_balance)";
$result = $db->query($query);

?>