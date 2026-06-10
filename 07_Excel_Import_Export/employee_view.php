<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$file = "employee_list.xlsx";

try {

    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray();

    echo "<table border='1' cellpadding='5'>";

    foreach ($data as $row) {

        echo "<tr>";

        foreach ($row as $cell) {
            echo "<td>" . htmlspecialchars($cell) . "</td>";
        }

        echo "</tr>";
    }

    echo "</table>";

} catch(Exception $e) {

    echo "Error : " . $e->getMessage();
}
?>