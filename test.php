<?php

include "geoip.php";

$location = get_country_by_ip($_SERVER['REMOTE_ADDR']);
echo "IP location: ".$location."";