<?php
//sir e aapel fpdf library add kari
require('fpdf.php');

//datbase connection
require('db.php');

//databse fetch, sort in descending 
$sql = "SELECT * FROM receipt ORDER BY amt DESC";
$result = $conn->query($sql);

//pdf layout define
$pdf = new FPDF('L', 'mm', 'A3');

$pdf->AddPage('L');

//pdf title
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Student Payment Data (Sorted by Fees)', 0, 1, 'C');
$pdf->Ln(5); 

//all cells define, last column add nat karel

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 10, 'Rcpt No', 1, 0, 'C');
$pdf->Cell(25, 10, 'Date', 1, 0, 'C');
$pdf->Cell(30, 10, 'Student ID', 1, 0, 'C');
$pdf->Cell(60, 10, 'Student Name', 1, 0, 'C');
$pdf->Cell(20, 10, 'Code', 1, 0, 'C');
$pdf->Cell(70, 10, 'Course Name', 1, 0, 'C');
$pdf->Cell(25, 10, 'Amount', 1, 1, 'C'); 

//data table -
$pdf->SetFont('Arial', '', 10);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        
        $pdf->Cell(20, 10, $row['rno'], 1, 0, 'C');
        $pdf->Cell(25, 10, $row['rdate'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['stud_id'], 1, 0, 'C');
        $pdf->Cell(60, 10, $row['stud_nm'], 1, 0, 'L'); 
        $pdf->Cell(20, 10, $row['ccode'], 1, 0, 'C');
        $pdf->Cell(70, 10, $row['cname'], 1, 0, 'L');         
        $pdf->Cell(25, 10, $row['amt'], 1, 1, 'R'); 
    }
} else {
    $pdf->Cell(250, 10, 'No data found', 1, 1, 'C');
}

$conn->close();
$pdf->Output();
?>