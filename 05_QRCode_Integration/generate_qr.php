<?php

include "db.php";
include "phpqrcode/qrlib.php";

$query = "SELECT * FROM qr_records";
$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($result))
{
    $token = $row['qr_token'];

    if($token == "")
    {
        continue;
    }

    $qrData = "http://localhost/Def/05_QRCode_Integration/view.php?token=".$token;

    $fileName = "qr_images/".$token.".png";

    QRcode::png(
        $qrData,
        $fileName,
        QR_ECLEVEL_H,
        6
    );

    echo "QR Code Generated for Token : ".$token."<br>";
}

echo "<br>All QR Codes Generated Successfully";

?>
