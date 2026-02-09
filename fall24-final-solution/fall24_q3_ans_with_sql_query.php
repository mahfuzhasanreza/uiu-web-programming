<?php
// =======================
// DB CONNECTION
// =======================
$conn = mysqli_connect("localhost", "root", "", "uiuweb_final");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/* =======================
   1) Total students by letter grade
======================= */
echo "<h3>1) Total Students by Letter Grade</h3>";

$q1 = "
SELECT LetterGrade, COUNT(*) AS TotalStudents
FROM student_final
GROUP BY LetterGrade
";

$result1 = mysqli_query($conn, $q1);

while ($row = mysqli_fetch_assoc($result1)) {
    echo "Grade {$row['LetterGrade']} : {$row['TotalStudents']} students<br>";
}

/* =======================
   2) Grade < 75 AND Letter != 'D' → Letter = 'C'
======================= */
$q2 = "
UPDATE student_final
SET LetterGrade = 'C'
WHERE Grade < 75
  AND LetterGrade <> 'D'
";

mysqli_query($conn, $q2);
echo "<h3>2) Letter grade updated (grade < 75 and not D → C)</h3>";

/* =======================
   3) Grade > 80 → +5 bonus, but new grade <= 90
======================= */
$q3 = "
UPDATE student_final
SET Grade = Grade + 5
WHERE Grade > 80
  AND Grade + 5 <= 90
";

mysqli_query($conn, $q3);
echo "<h3>3) Bonus added to eligible students</h3>";

/* =======================
   4) Course-wise student count (most popular first)
======================= */
echo "<h3>4) Students per Course (Most Popular First)</h3>";

$q4 = "
SELECT CourseTitle, COUNT(*) AS TotalStudents
FROM student_final
GROUP BY CourseTitle
ORDER BY TotalStudents DESC
";

$result4 = mysqli_query($conn, $q4);

while ($row = mysqli_fetch_assoc($result4)) {
    echo "{$row['CourseTitle']} : {$row['TotalStudents']} students<br>";
}

mysqli_close($conn);
?>
