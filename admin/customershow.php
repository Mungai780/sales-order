<?php
include("../partials/connect.php");

// Fetch customer data from the database
$sql = "SELECT * FROM customers";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    $customers = $result->fetch_all(MYSQLI_ASSOC);

    foreach ($customers as $customer) {
        echo "<tr>";
        echo "<td>" . $customer['id'] . "</td>";
        echo "<td>" . $customer['customer_name'] . "</td>";
        echo "<td>" . $customer['address'] . "</td>";
        echo "<td>" . $customer['email'] . "</td>";
        echo "<td>" . $customer['phone'] . "</td>";
        echo "<td>" . (isset($customer['created_at']) ? $customer['created_at'] : '') . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No customers found</td></tr>";
}
?>
