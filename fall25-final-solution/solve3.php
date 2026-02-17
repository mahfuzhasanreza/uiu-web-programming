<?php
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "campus_library";

$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// ans 1
$sql1 = "SELECT Status, COUNT(*) AS BookCount
        FROM book_loans
        GROUP BY Status";
$result1 = mysqli_query($conn, $sql1);

echo "<h1>Campus Library - Book Loans</h1>";

echo "<h3>Total number of books for each status which have more than 1 entry in the table: </h3>";
while($row = mysqli_fetch_assoc($result1)){
    if($row['BookCount'] > 1){
        echo $row['Status'] . ": " . $row['BookCount']. "<br>";
    }
}

// ans 2
$sql2 = "UPDATE book_loans
        SET Status = 'Grace Period', PenaltyFee = 0
        WHERE Status = 'Overdue' AND DaysOverdue < 7";
$result2 = mysqli_query($conn, $sql2);

// ans 3
$sql3 = "UPDATE book_loans
        SET PenaltyFee = PenaltyFee + (PenaltyFee * 0.1)
        WHERE PenaltyFee > 20 AND (PenaltyFee + (PenaltyFee * 0.1)) <= 50";
$result3 = mysqli_query($conn, $sql3);

// ans 4
$sql4 = "SELECT BookTitle, SUM(PenaltyFee) AS TotalPenalty
        FROM book_loans
        GROUP BY BookTitle
        ORDER BY TotalPenalty DESC";
$result4 = mysqli_query($conn, $sql4);

echo "<h3>Display each book title and the total penalty fee collected for that book (Descending sort)</h3>";
while($row = mysqli_fetch_assoc($result4)){
    echo "Book Title: " . $row['BookTitle'] . ", Total Penalty Fee: " . $row['TotalPenalty'] . "<br>";
}

mysqli_close($conn);
?>