<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['employee_id'])) {
    // Retrieve employee details from the database based on the session employee_id
    $employeeId = $_SESSION['employee_id'];

    // Replace database_host, database_user, database_password, and database_name with your actual database credentials
    $connection = mysqli_connect("database_host", "database_user", "database_password", "database_name");

    // Check if the database connection is successful
    if ($connection) {
        $query = "SELECT id, employee_name FROM employees WHERE id = ?";
        $stmt = mysqli_prepare($connection, $query);
        
        // Bind the employeeId parameter
        mysqli_stmt_bind_param($stmt, "i", $employeeId);
        
        // Execute the statement
        mysqli_stmt_execute($stmt);
        
        // Bind the result variables
        mysqli_stmt_bind_result($stmt, $employeeNo, $employeeName);
        
        // Fetch the results
        mysqli_stmt_fetch($stmt);

        // Close the statement
        mysqli_stmt_close($stmt);

        // Close the database connection
        mysqli_close($connection);
    } else {
        // Handle database connection error
        $employeeNo = "Error connecting to database";
        $employeeName = "Error connecting to database";
        echo "Database Connection Error: " . mysqli_connect_error();
    }
} else {
    $employeeNo = "N/A";
    $employeeName = "N/A";
}
?>
