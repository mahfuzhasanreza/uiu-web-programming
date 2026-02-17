<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Calculation</title>
</head>

<body>
    <form method="POST">
        <h2>Mark Calculation</h2>
        <h3>Input:</h3>

        <label for="">CT1:</label>
        <input type="number" name="ct1" required>
        <br>
        <label for="">CT2:</label>
        <input type="number" name="ct2" required>
        <br>
        <label for="">CT3:</label>
        <input type="number" name="ct3" required>
        <br>
        <label for="">Midterm Marks:</label>
        <input type="number" name="mid" required>
        <br>
        <label for="">Final Marks:</label>
        <input type="number" name="final" required>
        <br> <br>
        <input type="submit" value="Calculate Total">
    </form>
</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $ct1 = $_POST["ct1"];
    $ct2 = $_POST["ct2"];
    $ct3 = $_POST["ct3"];
    $mid = $_POST["mid"];
    $final = $_POST["final"];

    $best_ct = 0;
    if ($ct1 >= $ct2) {
        $best_ct += $ct1;
        if ($ct3 >= $ct2) {
            $best_ct += $ct3;
        } else {
            $best_ct += $ct2;
        }
    } else {
        $best_ct += $ct2;
        if ($ct3 >= $ct1) {
            $best_ct += $ct3;
        } else {
            $best_ct += $ct1;
        }
    }
    // $total_marks = $best_ct + $mid + $final;

    $avg_ct_marks = $best_ct / 2;
    $total_marks = $avg_ct_marks + $mid;
    $total_marks += ($avg_ct_marks + $final);

    echo "<h3> Output: </h3>";
    echo "Best two CT's total: " . $best_ct . "<br>";
    echo "Midterm marks: " . $mid . "<br>";
    echo "Final marks: " . $final . "<br> <br>";
    echo "<b>Total Marks: </b>" . $total_marks . "<br>";
    echo "Status: ";
    if ($total_marks > 54) {
        echo "Passed";
    } else {
        echo "Failed";
    }
}
?>