<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://data.covid19.go.id/public/api/update.json");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);

