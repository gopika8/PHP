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
$salaryError = null;


if (!empty($_POST)) {
    $employeeName = $_POST["employeeName"];
    $employeeDOB = $_POST["employeeDOB"];
    $employeeEmail = $_POST["employeeEmail"];
    $employeePassword = $_POST["employeePassword"];
    $employeeDesignation = $_POST["employeeDesignation"];
    $employeeSalary = $_POST["employeeSalary"];

    //file upload
    $targetDir = "uploads/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

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
    if (empty($employeeSalary)) {
        $salaryError = "Please enter Salary";
        $isValid = false;
    }
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {

        if ($isValid && move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            $insertQuery = "INSERT INTO `employee` (`employeeName`, `employeeDOB`, `employeeEmail`, `employeePassword`, `designation`, `verificationDocument`, `employeeSalary`)
        VALUES ('$employeeName', '$employeeDOB', '$employeeEmail', '$employeePassword', '$employeeDesignation', '$fileName', '$employeeSalary')";
            if ($con->query($insertQuery) === TRUE) {
                echo "User Inserted successfully";
                header("Location: index.php");
            } else {
                echo $con->error;
            }
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
    <form method="POST" action="createUser.php" enctype="multipart/form-data">
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
            <label>Verfication Document : </label>
            <input type="file" name="file" />
        </div>
        <div>
            <label>Employee Salary : </label>
            <input name="employeeSalary" type="text" value="<?php echo !empty($employeeSalary) ? $employeeSalary : "" ?>" />
            <br><span><?php echo "$salaryError" ?></span>
        </div>
        <div>
            <button type="submit">Create</button>
        </div>
    </form>
</body>

</html>