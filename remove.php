<?php
    include "connect.php";
    $query = "delete from company where id=".$_REQUEST['id_rem']." ";
    $result = mysql_query($query) or die(mysql_error());
    include "sql.php";
?>