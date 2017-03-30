<?php
  include_once 'db_functions.php';
                                $db = new DB_Functions();
                                $time = $db->updated_time();
                                $row = mysql_fetch_row($time);
                                $str = $row[0];
                                $time = strtotime($str);
                                $newformat = date('Y-m-d\TH:i:sP',$time);
                                echo $newformat;
?>