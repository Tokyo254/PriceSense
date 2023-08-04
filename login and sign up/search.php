<?php
include 'connection.php';
// Handling the form submission
if (isset($_POST["product_search"])) {
    $searchQuery = $_POST["product_search"];
    $sql = "SELECT ProductName, 
                   (SELECT Prices FROM naivas WHERE ProductName = main.ProductName) AS Naivas,
                   (SELECT Prices FROM carrefour WHERE ProductName = main.ProductName) AS Carrefour,
                   (SELECT Prices FROM chandarana WHERE ProductName = main.ProductName) AS Chandarana,
                   (SELECT Prices FROM quickmart WHERE ProductName = main.ProductName) AS Quickmart,
                   (SELECT Prices FROM onntheway WHERE ProductName = main.ProductName) AS Onntheway,
                   (SELECT Prices FROM cleanshelf WHERE ProductName = main.ProductName) AS Cleanshelf
            FROM your_table_name AS main
            WHERE ProductName LIKE '%$searchQuery%'";
    $result = $con->query($sql);
}

            if (isset($result) && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["ProductName"] . "</td>";
                    echo "<td>" . $row["Naivas"] . "</td>";
                    echo "<td>" . $row["Carrefour"] . "</td>";
                    echo "<td>" . $row["Chandarana"] . "</td>";
                    echo "<td>" . $row["Quickmart"] . "</td>";
                    echo "<td>" . $row["Onntheway"] . "</td>";
                    echo "<td>" . $row["Cleanshelf"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No items found</td></tr>";
            }
            
$con->close();
