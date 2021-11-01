<?php
class DataBaseConfig
{
    public function getDBObject()
    {
        $conn = new mysqli('localhost', 'root', '', 'user');
        if ($conn->connect_error) {
            //echo "Connection error"; 
            return null;
        } else {
            //echo "connected successfully";
            return $conn;
        }
        return $conn;
    }
}
?>
