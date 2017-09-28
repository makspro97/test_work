<?php
    include "connect.php"; 
    $query = "select * from company";
    $result = mysql_query($query) or die(mysql_error());
    $number1=1;
    global $sum_est;
    global $sum_it;
    global $sum;
    while ($row=mysql_fetch_array($result))
    {
        $id[$number1]=$row['id'];
        $name[$number1]=$row['name'];
        $est[$number1]=$row['estimated'];
        $main_id[$number1]=$row['main_id'];
        if ($main_id[$number1]!=null){
            $sum[$id[$number1]]=$main_id[$number1];
            $sum_est[$id[$number1]]=$est[$number1];
        }
        $sub_est[$id[$number1]]=$row['sub_est'];

        $number1++;

    }
    $sum_it=array();
    function count_sub($sum){
        krsort($GLOBALS['sum']);
        foreach ($GLOBALS['sum'] as $key=>$value){
            foreach ($GLOBALS['sum'] as $key1=>$value1){
                foreach ($GLOBALS['sum'] as $key2=>$value2){
                    if ($key==$value1 and $key1==$value2){
                        $GLOBALS['sum_it'][$key1]=$GLOBALS['sum_est'][$key2];
                        $GLOBALS['sum_est'][$key1]+=$GLOBALS['sum_est'][$key2];
                        unset($GLOBALS['sum'][$key2]);
                        $sum=count_sub($GLOBALS['sum']);
                        goto next;
                    }
                }
                if ($key==$value1){
                    $GLOBALS['sum_it'][$key]=$GLOBALS['sum_est'][$key1];
                    $GLOBALS['sum_est'][$key]+=$GLOBALS['sum_est'][$key1];
                    unset($GLOBALS['sum'][$key1]);
                }
                
            }
            next:
        }
        return $GLOBALS['sum'];
    }
    $sum=count_sub($sum);
    $sum_it=$GLOBALS['sum_it'];
    $sum_est=$GLOBALS['sum_est'];
    foreach ($sum as $key=>$value){
        $sum_it[$value]+=$sum_est[$key];
    }
    $query="";
    foreach ($sub_est as $key=>$value){
        if(isset($sum_it[$key])){
            $value1=$sum_it[$key];
        }
        else {$value1=0;}
        include "connect.php";
        $query = "update company set sub_est=".$value1." where id=".$key." ; ";
        $result = mysql_query($query) or die(mysql_error());
    }
?>