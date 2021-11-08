<?php
require "config.php";
$dbObject = new DataBaseConfig();
$con = $dbObject->getDBObject();



//initialize errors
$nameError = null;
$ageError = null;
$emailError = null;
$passwordError = null;
$designationError = null;

if (!empty($_POST)) {
    $employeeName = $_POST["employeeName"];
    $employeeDOB = $_POST["employeeDOB"];
    $employeeEmail = $_POST["employeeEmail"];
    $employeePassword = $_POST["employeePassword"];
    $employeeDesignation = $_POST["employeeDesignation"];

    $isValid = true;
    if (empty($employeeEmail)) {
        $emailError = "Please enter email";
        $isValid = false;
    } else if (!filter_var($employeeEmail, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Please enter valid email";
        $isValid = false;
    }
    if (empty($employeePassword)) {
        $passwordError = "Please enter passowrd";
        $isValid = false;
    }
    if (empty($employeeName)) {
        $nameError = "Please enter name";
        $isValid = false;
    }
    if (empty($employeeDOB)) {
        $ageError = "Please enter DOB";
        $isValid = false;
    }
    if (empty($employeeDesignation)) {
        $designationError = "Please enter Designation";
        $isValid = false;
    }

    if ($isValid) {
        $insertQuery = "INSERT INTO `employee` (`employeeName`, `employeeDOB`, `employeeEmail`, `employeePassword`, `designation`)
        VALUES ('$employeeName', '$employeeDOB', '$employeeEmail', '$employeePassword', '$employeeDesignation')
        ";
        if ($con->query($insertQuery) === TRUE) {
            echo "User Inserted successfully";
            header("Location: index.php");
        } else {
            echo $con->error;
        }
    }
}
?>


<html>

<style>
    div {
        text-align: center;
        padding: 50px 0px 0px 0px;
    }

    label {
        padding: 0px 30px 0px 30px;
    }
</style>


<body>
    <form method="POST" action="createUser.php">
        <div>
            <label>Employee Name : </label>
            <input name="employeeName" type="text" value="<?php echo !empty($employeeName) ? $employeeName : "" ?>" />
            <br><span><?php echo "$nameError" ?></span>
        </div>
        <div>
            <label>Employee DOB : </label>
            <input name="employeeDOB" type="date" value="<?php echo !empty($employeeDOB) ? $employeeDOB : "" ?>" />
            <br><span><?php echo "$ageError" ?></span>
        </div>
        <div>
            <label>Employee Email : </label>
            <input name="employeeEmail" type="email" value="<?php echo !empty($employeeEmail) ? $employeeEmail : "" ?>" />
            <br><span><?php echo "$emailError" ?></span>
        </div>
        <div>
            <label>Employee Password : </label>
            <input name="employeePassword" type="password" value="<?php echo !empty($employeePassword) ? $employeePassword : "" ?>" />
            <br><span><?php echo "$passwordError" ?></span>
        </div>
        <div>
            <label>Employee Designation : </label>
            <input name="employeeDesignation" type="text" value="<?php echo !empty($employeeDesignation) ? $employeeDesignation : "" ?>" />
            <br><span><?php echo "$designationError" ?></span>
        </div>
        <div>
            <button type="submit">Create</button>
        </div>
    </form>
</body>

</html>