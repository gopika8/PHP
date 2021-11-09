<?php

require 'config.php';
$dbObject = new DataBaseConfig();
$con = $dbObject->getDBObject();


if (!empty($_GET['id'])) {
    $employeeEmail = $_REQUEST['id'];
}

if (!empty($_POST)) {
    $deleteQuery = "DELETE FROM employee WHERE employeeEmail = '$employeeEmail'";
    if ($con->query($deleteQuery) === TRUE) {
        echo "User deleted successfully";
        header("Location: index.php");
    } else {
        echo $con->error;
    }
}

?>

<html>

<body>
    <div>
        <h3>Are you sure to delete an employee?</h3>
    </div>
    <div>
        <form method="POST" action="deleteUser.php?id=<?php echo $employeeEmail ?>">
            <input type="hidden" name="employeeEmail" value="<?php echo $employeeEmail; ?>" />
            <button type="submit">Yes</button>
            <a href="index.php">No</a>
        </form>
    </div>
</body>

</html>