<?php
$conn = mysqli_connect("localhost", "root", "", "uiutech_final");
if (!$conn) {
    die("Connection failed");
}

// 1
$result = mysqli_query($conn, "SELECT PerformanceRating, COUNT(*) AS TotalEmployees
FROM employee_final
GROUP BY PerformanceRating;");

while ($row = mysqli_fetch_assoc($result)) {
    echo "Rating: " . $row['PerformanceRating'] . ", Total Employee: " . $row['TotalEmployees'] . "<br>";
}

// 2
mysqli_query($conn, "
    UPDATE employee_final
    SET PerformanceRating = 'C'
    WHERE Salary < 40000
      AND PerformanceRating <> 'D'
");

// 3
mysqli_query($conn, "
    UPDATE employee_final
    SET Salary = Salary + 5000
    WHERE Salary > 50000
      AND Salary + 5000 <= 60000
");

//4
$result = mysqli_query($conn, "
    SELECT DepartmentName, COUNT(*) AS TotalEmployees
    FROM employee_final
    GROUP BY DepartmentName
    ORDER BY TotalEmployees DESC
");

while ($row = mysqli_fetch_assoc($result)) {
    echo "{$row['DepartmentName']} : {$row['TotalEmployees']} employees<br>";
}

mysqli_close($conn);
?>
