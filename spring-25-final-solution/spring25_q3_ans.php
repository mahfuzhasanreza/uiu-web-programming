<?php
$conn = mysqli_connect("localhost", "root", "", "uiutech_final");
if (!$conn) {
    die("Connection failed");
}

$result = mysqli_query($conn, "SELECT * FROM employee_final");

/* rating-wise counter */
$ratingCount = [
    'A' => 0,
    'B' => 0,
    'C' => 0,
    'D' => 0
];

$deptCount = [];

while ($row = mysqli_fetch_assoc($result)) {
    // 1
    $rating = $row['PerformanceRating'];
    $ratingCount[$rating]++;

    // 2
    if ($row['Salary'] < 40000 && $row['PerformanceRating'] != 'D') {
        $id = $row['EmployeeID'];

        mysqli_query(
            $conn,
            "UPDATE employee_final
             SET PerformanceRating = 'C'
             WHERE EmployeeID = $id"
        );
    }

    // 3
    if ($row['Salary'] > 50000 && ($row['Salary'] + 5000) <= 60000) {

        $id = $row['EmployeeID'];
        $newSalary = $row['Salary'] + 5000;

        mysqli_query(
            $conn,
            "UPDATE employee_final
             SET Salary = $newSalary
             WHERE EmployeeID = $id"
        );
    }

    // 4
    $dept = $row['DepartmentName'];

    if (!isset($deptCount[$dept])) {
        $deptCount[$dept] = 0;
    }
    $deptCount[$dept]++;

    /* sort by number of employees (descending) */
    arsort($deptCount);

    // asc: asort($deptCount);
}

// 1 : Display
echo "<h3>Total Employees by Performance Rating</h3>";
foreach ($ratingCount as $rating => $count) {
    echo "Rating $rating : $count employees <br>";
}

// 4 : Display
echo "<h3>Employees per Department</h3>";
foreach ($deptCount as $dept => $count) {
    echo "$dept : $count employees<br>";
}

mysqli_close($conn);
?>