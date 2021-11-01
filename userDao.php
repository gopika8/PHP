<?php
include_once('userClass.php');
class userDAO
{

    public function registerUser(User $userObj)
    {
        include_once('config.php');
        $dbObj = new DataBaseConfig();
        $conn = $dbObj->getDBObject();
        var_dump($userObj);
        $stmt = $conn->prepare("INSERT INTO users (userName, userEmail, userPassword) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $userObj->getUserName(), $userObj->getUserEmail(), $userObj->getUserPassword());
        $stmt->execute();
        echo "user inserted successfully";
    }


    public function getAllUser()
    {
        include_once('config.php');
        $dbObj = new DataBaseConfig();
        $conn = $dbObj->getDBObject();
        $query = "SELECT * FROM users";
        $result = $conn->query($query);
        include_once('userClass.php');
        if ($result->num_rows > 0) {
            while ($data = $result->fetch_array()) {
                $userObj = new User();
                $userObj->setUserName($data["userName"]);
                $userObj->setUserEmail($data["userEmail"]);
                $userObj->setUserPassword($data["userPassword"]);
                // array_push($userArray, $userObj);
                $userArray[] = array(
                    "userName" => $userObj->getUserName(),
                    "userEmail" => $userObj->getUserEmail(),
                    "userPassword" => $userObj->getUserPassword()
                );
            }
            echo json_encode(["users" => $userArray]);
            return ;
        }
       // var_dump($userArray);
    }
}
