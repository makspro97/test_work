<?php
    include "connect.php";
    $query = "update company set name='".$_REQUEST['edit_name']."',  estimated=".$_REQUEST['edit_est'].",  main_id=".$_REQUEST['edit_comp']." where id=" .$_REQUEST['edit_id']." ";
    $result = mysql_query($query) or die(mysql_error());
    include "sql.php";
    
?>
