<?php
$conn = mysqli_connect("localhost", "root", "", "sundarban");

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM sales_data";
$result = mysqli_query($conn, $query);

$categoryRevenue = [];
$categoryCount = [];

while($row = mysqli_fetch_assoc($result)){
    $category = $row['CategoryName'];
    $revenue = $row['Revenue'];

    // ans 1
    if(!isset($categoryRevenue[$category])){
        $categoryRevenue[$category] = 0;
        $categoryCount[$category] = 0;
    }

    $categoryCount[$category]++;
    $categoryRevenue[$category] += $revenue;

    // ans 2
    if($revenue < 40000){
        $id = $row['SaleID'];

        mysqli_query(
            $conn,
            "UPDATE sales_data
            SET CategoryName = 'Low Performing'
            WHERE SaleID = $id"
        );
    }

    // ans 3
    if($revenue > 70000){
        $id = $row['SaleID'];
        $bonus = $revenue * 0.10;
        $newRevenue = $revenue + $bonus;

        mysqli_query(
            $conn,
            "UPDATE sales_data
            SET Revenue = $newRevenue
            WHERE SaleID = $id"
        );
    }
}

// ans 1 : display
echo "<h5>Total revenue per category: </h5>";
foreach($categoryRevenue as $category => $total){
    echo $category . ": " . $total . "<br>";
}

// ans 4
echo "<h5>Display all: </h5>";
$result2 = mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($result2)){
    $name = $row['ProductName'];
    $category = $row['CategoryName'];

    echo "Product Name: " . $name . ", Category Name: " . $category . ", Label: ";

    $avgRevenue = $categoryRevenue[$category] / $categoryCount[$category];
    if($row['Revenue'] > $avgRevenue){
        echo "Top Seller <br>";
    } else{
        echo "Regular Seller <br>";
    }
}

mysqli_close($conn);
?>