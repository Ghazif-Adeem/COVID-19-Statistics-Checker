<?php

$ch = curl_init('https://covid19.mathdro.id/api/og');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


$x = file_get_contents('https://covid19.mathdro.id/api/og');
echo "<img src='https://covid19.mathdro.id/api/og' />";
// echo "<img src=$x />"
// $result = curl_exec($ch);

// echo "<img src=og />";


?>