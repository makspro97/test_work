<?php
include "sql.php";
include "connect.php";
$query = "select * from company";
$result = mysql_query($query) or die(mysql_error());
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Test</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="script.js"></script>
    
</head>
<body>
    <div class="view">
        <form id="viewCom">
            <h2>View a Company:</h2>
            <select id="idCom">
            <?php
                $number=1;
                while ($row=mysql_fetch_array($result)) {
                    $company_name[$number]=$row['name'];
                    $company_id[$number]=$row['id'];
                    print "<option value=".$company_id[$number].">";
                    print $company_name[$number];
                    echo("</option>");
                    $number++;
                }
            ?>
            </select>
        </form>
        <div id="v_content"></div>
    </div>
    <div class="new">
        <h2>Create new company</h2>
        <form class="new_comp">
        <h3>Edit name</h3><input type="text" id="new_name"  required>
        <h3>Edit estimated</h3><input type="text" id="new_est" required>
        <h3>Edit subsidiary company</h3>
        <select id="new_comp">
        <option value="null">Not Sub company</option>
            <?php
                for ($i=1; $i<=count($company_name); $i++) {
                    print "<option value=".$company_id[$i].">";
                    print $company_name[$i];
                    echo("</option>");
                }
            ?>
        </select><br><br>
        <input type="button" id="new_save" value="Save">
        </form>
    </div>
    <div class="remove">
        <h2>Delete company</h2>
        <select id="remove_comp">
        <option value="null">Select a company to delete</option>
            <?php
                for ($i=1; $i<=count($company_name); $i++) {
                    print "<option value=".$company_id[$i].">";
                    print $company_name[$i];
                    echo("</option>");
                }
            ?>
        </select><br><br>
        <input type="button" id="delete_b" value="Delete">
    </div>
    <div class="tree">
        <h2>Company Structure</h2>
        <?php
            include "connect.php"; 
            $query = "select * from company";
            $result = mysql_query($query) or die(mysql_error());

            function getComp($result){
                $levels = array();
                $tree = array();
                $cur = array();

                while($rows = mysql_fetch_assoc($result)){

                    $cur = &$levels[$rows['id']];
                    $cur['main_id'] = $rows['main_id'];
                    $cur['name'] = $rows['name'];
                    $cur['est'] = $rows['estimated'];
                    $cur['sub_est'] = $rows['sub_est'];

                    if($rows['main_id'] == 0){
                        $tree[$rows['id']] = &$cur;
                    }
                    else{
                        $levels[$rows['main_id']]['children'][$rows['id']] = &$cur;
                    }

                }
                return $tree;
            }

            function getTree($arr){
                $out = '';
                $out .= '<div>';
                foreach($arr as $k=>$v){
                    $sum=$v['est']+$v['sub_est'];
                    $out .= '<div>'.$v['name'].' |'.$v['est'].' |'.$sum.'</div>';
                    if(!empty($v['children'])){
                        $out .= getTree($v['children']);
                    }            
                }
                $out .= '</div>';
                return $out;
            }

            $cats = getComp($result);
            echo getTree($cats);
        ?>
    </div>
</body>
</html>