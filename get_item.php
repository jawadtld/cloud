<?php
include_once './db_functions.php';
//Create Object for DB_Functions clas
$db = new DB_Functions(); 
//Util arrays to create response JSON
$a=array();
$b=array();
//Store User into MySQL DB
$res = $db->getAllUsers();
    //Based on inserttion, create JSON response
   /* if($res){
        $b["item"] = $data[$i]->item;
        $b["price"] = $data[$i]->price;
        array_push($a,$b);
    }else{
        $b["item"] = $data[$i]->item;
        $b["updated"] = $data[$i]->price*/
    while ($itemarray=mysql_fetch_array($res)) {
        $b["item"] = $itemarray[1];
        $b["price"] = $itemarray[2];
        $b["barcode"] = $itemarray[3];
        array_push($a,$b);
    }
//Post JSON response back to Android Application
echo json_encode($a);

?>