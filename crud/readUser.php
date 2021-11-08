<?php
require 'config.php';
$dbConfig = new DataBaseConfig();
$con = $dbConfig->getDBObject();
$employeeEmail = null;
$employeeDetails = null;
if (!empty($_GET['id'])) {
    $employeeEmail = $_REQUEST['id'];
}

if (null == $employeeEmail) {
    header("Location : index.php");
} else {
    $retrievalQuery = "SELECT * FROM employee WHERE employeeEmail = '$employeeEmail'";
    $result = $con->query($retrievalQuery);
    if ($result->num_rows > 0) {
        while ($data = $result->fetch_assoc()) {
            $employeeDetails = $data;
        }
    }
}

?>


<html>

<style>
    table {
        text-align: justify;
        padding: 180px;
        font-style: italic;
        font-weight: bolder;
        font-size: 24px;
    }
</style>

<body>
    <table>
        <?php
        foreach ($employeeDetails as $key => $val) {
            echo "<tr><th>$key : $val</th></tr>";
        }
        ?>
    </table>
</body>

</html>