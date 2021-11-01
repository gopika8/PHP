<?php

include "userClass.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userObject = new User();
    $userObject->setUserName($_REQUEST['userName']);
    $userObject->setUserEmail($_REQUEST['userEmail']);
    $userObject->setUserPassword($_REQUEST['userPassword']);
    include_once("userDao.php");
    $userDAO = new userDAO();
    $userDAO->registerUser($userObject);


    // $dbObj = new DataBaseConfig();
    // $conn = $dbObj->getDBObject();
    // $insertQuery = "INSERT INTO `users` (`userName`, `userEmail`, `userPassword`) VALUES ('$userName', '$userEmail', '$userPassword')";
    // mysqli_query($conn, $insertQuery);
}

if($_SERVER["REQUEST_METHOD"] === "GET") {
    include_once("userDao.php");
    include_once("userDao.php");
    $userDAO = new userDAO();
    $userDAO->getAllUser();
}

?>
