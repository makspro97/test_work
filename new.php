<?php
    include "connect.php";
    $query = "insert into company (name,estimated,main_id) values ('".$_REQUEST['new_name']."', ".$_REQUEST['new_est'].", ".$_REQUEST['new_comp'].")";
    $result = mysql_query($query) or die(mysql_error());
    include "sql.php";
?>