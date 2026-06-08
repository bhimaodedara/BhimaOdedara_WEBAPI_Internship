<?php

include "db.php";

if(isset($_GET['token']))
{
    $token = $_GET['token'];

    $query = "SELECT * FROM qr_records WHERE qr_token='$token'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0)
    {
        $data = mysqli_fetch_assoc($result);

        echo "<h2>QR Details</h2>";
        echo "ID : ".$data['id']."<br>";
        echo "Token : ".$data['qr_token'];
    }
    else
    {
        echo "Invalid QR Code";
    }
}
else
{
    echo "No Token Found";
}

?>
