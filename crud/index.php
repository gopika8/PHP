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
                        echo '<td><a href="readUser.php?id='.$data['employeeEmail'].'">View</a></td>';
                        echo '<td><a href="updateUser.php?id='.$data['employeeEmail'].'">Edit</a></td>';
                        echo '<td><a href="deleteUser.php>id='.$data['employeeEmail'].'">Delete</a></td>';
                        echo '<tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>