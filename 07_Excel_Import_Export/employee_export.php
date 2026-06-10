<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$host = "localhost";
$dbname = "exceldemo";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT emp_id, emp_name, department, salary FROM employee";
$result = $conn->query($sql);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$headers = ['emp_id', 'emp_name', 'department', 'salary'];

$col = 'A';

foreach ($headers as $header) {
    $sheet->setCellValue($col . '1', $header);
    $col++;
}

$rowNumber = 2;

while ($row = $result->fetch_assoc()) {

    $col = 'A';

    foreach ($headers as $field) {
        $sheet->setCellValue($col . $rowNumber, $row[$field]);
        $col++;
    }

    $rowNumber++;
}

$filename = "employee_export.xlsx";

$writer = new Xlsx($spreadsheet);
$writer->save($filename);

echo "Export Successful :
<a href='$filename' download>Download Excel</a>";
?>
