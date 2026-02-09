<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UIU Tech Fest</title>
</head>

<body>
    <form method="POST">
        <h1>UIU Tech Fest</h1>

        <label for="">Number of Students</label>
        <input type="number" name="students" id="" required>
        <br> <br>
        <label for="">Slice per Student</label>
        <input type="number" name="slice_per_student" id="" required>
        <br> <br>
        <label for="">Slice per Pizza</label>
        <input type="number" name="slice_per_pizza" id="" required>
        <br> <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php
function pizzaParty($students, $slicesPerStudent, $slicesPerPizza) {
    $totalSlicesNeeded = $students * $slicesPerStudent;
    $totalPizzas = ceil($totalSlicesNeeded / $slicesPerPizza);
    $leftoverSlices = ($totalPizzas * $slicesPerPizza) - $totalSlicesNeeded;
    $costPerSlice = 1050 / $slicesPerPizza;
    $wastedMoney = $leftoverSlices * $costPerSlice;

    return [
        'totalPizzas' => $totalPizzas,
        'leftoverSlices' => $leftoverSlices,
        'wastedMoney' => $wastedMoney
    ];
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $students = $_POST["students"];
    $slice_per_student = $_POST["slice_per_student"];
    $slice_per_pizza = $_POST["slice_per_pizza"];

    $result = pizzaParty($students, $slice_per_student, $slice_per_pizza);

    echo "Total Pizzas: " . $result['totalPizzas'] . "<br>";
    echo "Leftover Slices: " . $result['leftoverSlices'] . "<br>";
    echo "Wasted Money (BDT): " . $result['wastedMoney'] . "<br>";
}
?>