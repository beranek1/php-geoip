<?php

include "geoip.php";

$country = get_country_by_ip($_SERVER['REMOTE_ADDR']);
echo "Location: ".get_country_by_ip($_SERVER['REMOTE_ADDR'])."";