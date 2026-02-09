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

        <label for="">Attendees</label>
        <input type="number" name="attendees" id="" required>
        <br> <br>
        <label for="">Cost per Person</label>
        <input type="number" name="cost_per_person" id="" required>
        <br> <br>
        <label for="">Venue Capacity </label>
        <input type="number" name="venue_capacity" id="" required>
        <br> <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $attendees = $_POST["attendees"];
    $cost_per_person = $_POST["cost_per_person"];
    $venue_capacity = $_POST["venue_capacity"];

    $total_venues = ceil($attendees / $venue_capacity);
    $empty_seat = ($total_venues * $venue_capacity) - $attendees;
    $wasted_money = $empty_seat * $cost_per_person;

    echo "Total Venues: " . $total_venues . "<br>";
    echo "Empty Seats: " . $empty_seat . "<br>";
    echo "Wasted Money (BDT): " . $wasted_money . "<br>";
}
?>