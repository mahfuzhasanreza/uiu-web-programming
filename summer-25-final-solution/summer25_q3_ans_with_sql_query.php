<?php
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "sundarban";

$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// ans 1
$sql = "SELECT CategoryName, SUM(Revenue) AS TotalRevenue
        FROM sales_data
        GROUP BY CategoryName";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo $row['CategoryName'] . ": " . $row['TotalRevenue'] . "<br>";
}

// ans 2
$sql = "UPDATE sales_data
        SET CategoryName = 'Low Performing'
        WHERE Revenue < 40000";
$result = mysqli_query($conn, $sql);

// ans 3
$sql = "UPDATE sales_data
        SET Revenue = Revenue + (Revenue * 0.1)
        WHERE Revenue > 70000";
$result = mysqli_query($conn, $sql);

// ans 4
$sql = "SELECT s.ProductName, s.CategoryName, s.Revenue,
        CASE
            WHEN s.Revenue > c.avgRevenue
            THEN 'Top Seller'
            ELSE 'Regular Seller'
        END AS Label
        FROM sales_data s
        JOIN (
            SELECT CategoryName, AVG(Revenue) AS avgRevenue
            FROM sales_data
            GROUP BY CategoryName
        ) c ON s.CategoryName = c.CategoryName";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo "Product Name: " . $row['ProductName'] . ", Category Name: " . $row['CategoryName'] . ", Label: " . $row['Label'] . "<br>";
}

mysqli_close($conn);
?>