<?php
include '../connect.php';

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM product WHERE Product_ID LIKE '$search%' OR Product_Name LIKE '$search%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table class="table table-dark table-hover" id="productTable">';

        echo '<tbody id="productTableBody">'; // Add this line
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo "<td>" . $row["Product_ID"] . "</td>";
            echo "<td>" . $row["Product_Name"] . "</td>";
            echo "<td>" . $row["Quantity"] . "</td>";
            echo "<td>" . $row["Price"] . "</td>";
            echo '</tr>';
        }
        echo '</tbody>'; // Add this line
        echo "</table>";
    } else {
        echo "<tr><td colspan='5'>No records found</td></tr>";
    }
} else {
    echo "<tr><td colspan='5'>Enter a search term</td></tr>";
}

$conn->close();
?>
