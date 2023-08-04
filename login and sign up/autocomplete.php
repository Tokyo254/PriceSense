<?php
include 'connection.php';

// Handling the autosuggestion search
if (isset($_GET["q"])) {
    $searchQuery = $_GET["q"];
    $sql = "SELECT DISTINCT ProductName FROM naivas WHERE ProductName LIKE '%$searchQuery%' LIMIT 5";
    $result = $con->query($sql);

    $suggestions = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $suggestions[] = $row["ProductName"];
        }
    }

    echo json_encode($suggestions);
}

$conn->close();
?>