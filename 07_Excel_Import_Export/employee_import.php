<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$host = "localhost";
$dbname = "exceldemo";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<form method="post" enctype="multipart/form-data">
    <label>Select Excel File:</label>
    <input type="file" name="excelFile" required>
    <input type="submit" name="import" value="Import">
</form>

<?php

if(isset($_POST['import']))
{
    $file = $_FILES['excelFile']['tmp_name'];

    try
    {
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        array_shift($rows);

        foreach($rows as $row)
        {
            $emp_id     = $conn->real_escape_string($row[0]);
            $emp_name   = $conn->real_escape_string($row[1]);
            $department = $conn->real_escape_string($row[2]);
            $salary     = $conn->real_escape_string($row[3]);

            $sql = "INSERT INTO employee
                    (emp_id, emp_name, department, salary)
                    VALUES
                    ('$emp_id','$emp_name','$department','$salary')
                    ON DUPLICATE KEY UPDATE
                    emp_name='$emp_name',
                    department='$department',
                    salary='$salary'";

            $conn->query($sql);
        }

        echo "<h3>Excel Data Imported Successfully</h3>";
    }
    catch(Exception $e)
    {
        echo "Error : " . $e->getMessage();
    }
}

$conn->close();
?>