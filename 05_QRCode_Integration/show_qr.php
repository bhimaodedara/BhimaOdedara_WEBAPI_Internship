<?php

$images = glob("qr_images/*.png");

echo "<h2>Generated QR Codes</h2>";

foreach($images as $img)
{
    echo "<img src='$img' width='200'><br><br>";
}

?>
