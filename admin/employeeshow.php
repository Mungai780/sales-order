<?php
include("../partials/connect.php");

// Fetch employee data from the database
$sql = "SELECT * FROM employees";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    $employees = $result->fetch_all(MYSQLI_ASSOC);

    foreach ($employees as $employee) {
        echo "<tr>";
        echo "<td>" . $employee['id'] . "</td>";
        echo "<td>" . $employee['employee_name'] . "</td>";
        echo "<td>" . $employee['username'] . "</td>";
        echo "<td>" . $employee['created_at'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No employees found</td></tr>";
}
?>
