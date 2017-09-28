<?php
    include "connect.php"; 
    $query = "select a.name, a.estimated, a.estimated+a.sub_est as sum, a.main_id, b.name as name2 from company a left join company b on a.main_id=b.name where a.id=".$_REQUEST['id_m']."";
    $result = mysql_query($query) or die(mysql_error());

    while ($row=mysql_fetch_array($result))
    {
        $name_c=$row['name'];
        $est_c=$row['estimated'];
        $sum_c=$row['sum'];
        $sub_cid=$row['main_id'];
        $sub_cn=$row['name2'];
      
    }
    echo "<table><tr>
    <th>Name</th>
    <th>Company estimated earnings</th>
    <th>Estimated earnings all companies</th></tr>";
    echo "<tr><td>".$name_c."</td><td>".$est_c."</td><td>".$sum_c."</td></tr>";
    echo "</table>";
    echo "<br><button id='edit_c'>Edit this  company</button>";
    echo '<br><form class="edit" style="display:none;">
    <h3>Edit name</h3><input type="text" id="edit_name" value="'.$name_c.'" required>
    <h3>Edit estimated</h3><input type="text" id="edit_est" value="'.$est_c.'" required>';
    echo '<h3>Edit subsidiary company</h3><select id="edit_comp">';
    if ($sub_cid == null){
        echo '<option value="null" selected>Not Sub company</option>';
    }
    else {
        echo '<option value="null">Not Sub company</option>';
    }
    
    include "connect.php"; 
    $query = "select * from company";
    $result = mysql_query($query) or die(mysql_error());
    while ($row=mysql_fetch_array($result)){
        if ($row['id']==$sub_cid){
            echo '<option value="'.$row['id'].'" selected>'.$row['name'].'</option>';
        }
        else {
            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }
    }
        
    echo '</select><br><br><input type="button" id="save_c" value="Save"></form>';
?>