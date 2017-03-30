<?php
 
class DB_Functions {
 
    private $db;
 
    //put your code here
    // constructor
    function __construct() {
        include_once './db_connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }
 
    // destructor
    function __destruct() {
 
    }
     /**
     * Getting all users
     */
    public function getAllUsers() {
        $result = mysql_query("select * FROM shop ORDER BY item");
        return $result;
    }


    public function getincome($year,$month) {
        $result = mysql_query("SELECT SUM(income) AS 'income_sum' FROM income WHERE YEAR(date) = '$year' AND MONTH(date) = '$month'");
        return $result;
    }


    public function getincome_each($year,$month) {
        $result = mysql_query("SELECT * FROM income WHERE YEAR(date) = '$year' AND MONTH(date) = '$month' ORDER BY date");
        return $result;
    }


    public function getincome_year($year) {
        $result = mysql_query("SELECT * FROM income WHERE YEAR(date) = '$year' ORDER BY date");
        return $result;
    }



    public function updated_time(){
        $result = mysql_query("SELECT UPDATE_TIME FROM information_schema.tables WHERE TABLE_SCHEMA = 'u902035696_data' AND TABLE_NAME = 'shop'");
        return $result;
    }


    public function delete($item){
        $result=mysql_query("DELETE FROM shop WHERE item='$item'");
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function insert($item,$price,$barcode) {
        // Insert user into database
        $row=mysql_query("SELECT * FROM shop WHERE item='$item'");
        if(mysql_num_rows($row)){
        $result = mysql_query("UPDATE shop SET price=$price,barcode='$barcode' WHERE item='$item'");
        }
        else{
        $result = mysql_query("INSERT INTO shop(item,price,barcode) VALUES('$item',$price,'$barcode')");
        }
        
    if ($result) {
            return true;
        } else {
            return false;
            }            
    }

    public function insert_income($date,$income) {
        // Insert user into database
        $row=mysql_query("SELECT * FROM income WHERE date='$date'");
        if(mysql_num_rows($row)){
        $result = mysql_query("UPDATE income SET income=$income WHERE date='$date'");
    }
    else
    {
    $result = mysql_query("INSERT INTO income(date,income) VALUES('$date',$income)");
    }
        
    if ($result) {
            return true;
        } else {
            return false;
            }            
    }
}
 
?>
