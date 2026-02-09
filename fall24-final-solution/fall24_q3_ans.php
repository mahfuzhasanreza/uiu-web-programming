<?php
$conn = mysqli_connect("localhost", "root", "", "uiuweb_final");
if (!$conn)
    die("Connection failed: " . mysqli_connect_error());

/* ================
   1) Grade count (PHP logic)
================ */
$result = mysqli_query($conn, "SELECT * FROM student_final");

$gradeCount = ['A' => 0, 'B' => 0, 'C' => 0, 'D' => 0];
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row; // save for later too

    $lg = $row['LetterGrade'];
    if (isset($gradeCount[$lg]))
        $gradeCount[$lg]++;
}

echo "<h3>1) Total Students by Letter Grade</h3>";
foreach ($gradeCount as $g => $c) {
    echo "Grade $g : $c<br>";
}

/* ================
   2) grade < 75 AND letter != 'D' => letter = 'C' (PHP logic)
================ */
foreach ($data as $row) {
    $grade = (int) $row['Grade'];
    $letter = $row['LetterGrade'];

    if ($grade < 75 && $letter != 'D') {
        $id = (int) $row['StudentID'];
        mysqli_query($conn, "UPDATE student_final SET LetterGrade='C' WHERE StudentID=$id");
    }
}
echo "<h3>2) Update Done (grade < 75 and not D → C)</h3>";

/* ================
   3) grade > 80 => +5 bonus, but (grade+5) <= 90 (PHP logic)
================ */
foreach ($data as $row) {
    $grade = (int) $row['Grade'];

    if ($grade > 80 && ($grade + 5) <= 90) {
        $id = (int) $row['StudentID'];
        $newGrade = $grade + 5;
        mysqli_query($conn, "UPDATE student_final SET Grade=$newGrade WHERE StudentID=$id");
    }
}
echo "<h3>3) Bonus Applied (grade > 80 and new <= 90)</h3>";

/* ================
   Re-fetch for correct latest counts for (4)
================ */
$result2 = mysqli_query($conn, "SELECT * FROM student_final");
$courseCount = [];

while ($row = mysqli_fetch_assoc($result2)) {
    $course = $row['CourseTitle'];
    $courseCount[$course] = ($courseCount[$course] ?? 0) + 1;
}

/* sort by student count desc */
arsort($courseCount);

echo "<h3>4) Students per Course (Most popular first)</h3>";
foreach ($courseCount as $course => $count) {
    echo $course . " : " . $count . "<br>";
}

mysqli_close($conn);
?>