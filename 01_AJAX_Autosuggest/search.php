<?php
include "db.php";

$mode = trim($_GET['mode'] ?? '');

if ($mode == '') {
    exit;
}

$mode = mysqli_real_escape_string($conn, $mode);

$sql = "SELECT stud_name, email, contact, mode FROM internship WHERE mode = '$mode'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr>
            <th>Student Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Mode</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['stud_name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['contact'] . "</td>";
        echo "<td>" . ucfirst($row['mode']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No one was found</p>";
}

mysqli_close($conn);
?>