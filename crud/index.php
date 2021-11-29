<html>

<style>
    a {
        font-weight: bold;
        color: #000;
    }

    table {
        padding: 50px;
    }

    th,
    td {
        padding-left: 30px;
    }
</style>


<body>
    <div class="btn">
        <a href="createUser.php">Create Employee</a>
    </div>
    <br>
    <div>
        <form action="index.php?nHighestSalary=<?php echo $nHighestSalary ?>" method="GET">
            <label><b>Search employee of n'th highest salary : </b></label>
            <input type="text" name="nHighestSalary" value="<?php echo !empty($nHighestSalary) ? $nHighestSalary : "" ?>" />
            <button type="submit">Search</button>
        </form>
    </div>

    <div>
        <table>
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Employee Mail-Id</th>
                    <th>Designation</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require  'config.php';
                $dbConfig = new DataBaseConfig();
                $con = $dbConfig->getDBObject();
                $retrivalQuery = "SELECT employeeName, employeeEmail, designation FROM employee";
                $result = $con->query($retrivalQuery);
                if ($result->num_rows > 0) {
                    while ($data = $result->fetch_array()) {
                        echo '<tr>';
                        echo '<td>' . $data['employeeName'] . '</td>';
                        echo '<td>' . $data['employeeEmail'] . '</td>';
                        echo '<td>' . $data['designation'] . '</td>';
                        echo '<td><a href="readUser.php?id=' . $data['employeeEmail'] . '">View</a></td>';
                        echo '<td><a href="updateUser.php?id=' . $data['employeeEmail'] . '">Edit</a></td>';
                        echo '<td><a href="deleteUser.php?id=' . $data['employeeEmail'] . '">Delete</a></td>';
                        echo '<tr>';
                    }
                }

                if (!empty($_GET["nHighestSalary"])) {
                    $nHighestSalary = $_REQUEST["nHighestSalary"];
                    $highestSalaryQuery = "SELECT * FROM employee ORDER BY employeeSalary DESC";
                    $resultSet = $con->query($highestSalaryQuery);
                    //var_dump($resultSet -> fetch_all());
                    $resultArray = $resultSet -> fetch_all();
                    echo '<p><b>The ' .$nHighestSalary. '-th highest salary employee is ' . $resultArray[$nHighestSalary-1][0] . '</b></p>';
                    // if ($resultSet->num_rows > 0) {
                    //     while ($data = $resultSet->fetch_array()) {
                    //         $count++;
                    //         if ($count == $nHighestSalary) {
                    //             echo '<p><b>The ' .$nHighestSalary. '-th highest salary employee is ' . $data['employeeName'] . '</b></p>';
                    //         }
                    //         if ($count > $nHighestSalary) break;
                    //     }
                    // }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>