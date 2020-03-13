<?php
/*
#-----------------------------------------
| GeoIP
| https://github.com/beranek1/geoip
#-----------------------------------------
| made by beranek1
| https://github.com/beranek1
#-----------------------------------------
*/

// Get continent for given country code
function get_continent_by_country($country, $countrytocontinent = array("AD"=>"EU","AE"=>"AS","AF"=>"AS","AG"=>"NA","AI"=>"NA","AL"=>"EU","AM"=>"AS","AN"=>"NA","AO"=>"AF","AP"=>"AS","AR"=>"SA","AS"=>"OC","AT"=>"EU","AU"=>"OC","AW"=>"NA","AX"=>"EU","AZ"=>"AS","BA"=>"EU","BB"=>"NA","BD"=>"AS","BE"=>"EU","BF"=>"AF","BG"=>"EU","BH"=>"AS","BI"=>"AF","BJ"=>"AF","BL"=>"NA","BM"=>"NA","BN"=>"AS","BO"=>"SA","BR"=>"SA","BS"=>"NA","BT"=>"AS","BV"=>"AN","BW"=>"AF","BY"=>"EU","BZ"=>"NA","CA"=>"NA","CC"=>"AS","CD"=>"AF","CF"=>"AF","CG"=>"AF","CH"=>"EU","CI"=>"AF","CK"=>"OC","CL"=>"SA","CM"=>"AF","CN"=>"AS","CO"=>"SA","CR,NA","CU"=>"NA","CV"=>"AF","CX"=>"AS","CY"=>"AS","CZ"=>"EU","DE"=>"EU","DJ"=>"AF","DK"=>"EU","DM"=>"NA","DO"=>"NA","DZ"=>"AF","EC"=>"SA","EE"=>"EU","EG"=>"AF","EH"=>"AF","ER"=>"AF","ES"=>"EU","ET"=>"AF","EU"=>"EU","FI"=>"EU","FJ"=>"OC","FK"=>"SA","FM"=>"OC","FO"=>"EU","FR"=>"EU","FX"=>"EU","GA"=>"AF","GB"=>"EU","GD"=>"NA","GE"=>"AS","GF"=>"SA","GG"=>"EU","GH"=>"AF","GI"=>"EU","GL"=>"NA","GM"=>"AF","GN"=>"AF","GP"=>"NA","GQ"=>"AF","GR"=>"EU","GS"=>"AN","GT"=>"NA","GU"=>"OC","GW"=>"AF","GY"=>"SA","HK"=>"AS","HM"=>"AN","HN"=>"NA","HR"=>"EU","HT"=>"NA","HU"=>"EU","ID"=>"AS","IE"=>"EU","IL"=>"AS","IM"=>"EU","IN"=>"AS","IO"=>"AS","IQ"=>"AS","IR"=>"AS","IS"=>"EU","IT"=>"EU","JE"=>"EU","JM"=>"NA","JO"=>"AS","JP"=>"AS","KE"=>"AF","KG"=>"AS","KH"=>"AS","KI"=>"OC","KM"=>"AF","KN"=>"NA","KP"=>"AS","KR"=>"AS","KW"=>"AS","KY"=>"NA","KZ"=>"AS","LA"=>"AS","LB"=>"AS","LC"=>"NA","LI"=>"EU","LK"=>"AS","LR"=>"AF","LS"=>"AF","LT"=>"EU","LU"=>"EU","LV"=>"EU","LY"=>"AF","MA"=>"AF","MC"=>"EU","MD"=>"EU","ME"=>"EU","MF"=>"NA","MG"=>"AF","MH"=>"OC","MK"=>"EU","ML"=>"AF","MM"=>"AS","MN"=>"AS","MO"=>"AS","MP"=>"OC","MQ"=>"NA","MR"=>"AF","MS"=>"NA","MT"=>"EU","MU"=>"AF","MV"=>"AS","MW"=>"AF","MX"=>"NA","MY"=>"AS","MZ"=>"AF","NA"=>"AF","NC"=>"OC","NE"=>"AF","NF"=>"OC","NG"=>"AF","NI"=>"NA","NL"=>"EU","NO"=>"EU","NP"=>"AS","NR"=>"OC","NU"=>"OC","NZ"=>"OC","OM"=>"AS","PA"=>"NA","PE"=>"SA","PF"=>"OC","PG"=>"OC","PH"=>"AS","PK"=>"AS","PL"=>"EU","PM"=>"NA","PN"=>"OC","PR"=>"NA","PS"=>"AS","PT"=>"EU","PW"=>"OC","PY"=>"SA","QA"=>"AS","RE"=>"AF","RO"=>"EU","RS"=>"EU","RU"=>"EU","RW"=>"AF","SA"=>"AS","SB"=>"OC","SC"=>"AF","SD"=>"AF","SE"=>"EU","SG"=>"AS","SH"=>"AF","SI"=>"EU","SJ"=>"EU","SK"=>"EU","SL"=>"AF","SM"=>"EU","SN"=>"AF","SO"=>"AF","SR"=>"SA","ST"=>"AF","SV"=>"NA","SY"=>"AS","SZ"=>"AF","TC"=>"NA","TD"=>"AF","TF"=>"AN","TG"=>"AF","TH"=>"AS","TJ"=>"AS","TK"=>"OC","TL"=>"AS","TM"=>"AS","TN"=>"AF","TO"=>"OC","TR"=>"EU","TT"=>"NA","TV"=>"OC","TW"=>"AS","TZ"=>"AF","UA"=>"EU","UG"=>"AF","UM"=>"OC","US"=>"NA","UY"=>"SA","UZ"=>"AS","VA"=>"EU","VC"=>"NA","VE"=>"SA","VG"=>"NA","VI"=>"NA","VN"=>"AS","VU"=>"OC","WF"=>"OC","WS"=>"OC","YE"=>"AS","YT"=>"AF","ZA"=>"AF","ZM"=>"AF","ZW"=>"AF")) {

    // Check if given array contains continent of given country
    if(isset($country) && isset($countrytocontinent) && array_key_exists($country, $countrytocontinent)) {
        // Return continent
        return $countrytocontinent[$country];
    }

    // Return null if continent is unknown
    return null;
}

// Use hostname to determine origin country
function get_country_by_host($host) {
    // Make sure host is set and not an ip address
    if(isset($host) && filter_var($host, FILTER_VALIDATE_IP) == false) {

        // Split host by dots
        $domain_parts = explode(".", $host);

        // Get TLD (Last element of array)
        $top_level_domain = $domain_parts[count($domain_parts) - 1];

        // Check if TLD is country code
        if(strlen($top_level_domain) == 2) {
            // Return upper case country code
            return strtoupper($top_level_domain);
        }
    }

    // Return null if determination of host origin fails
    return null;
}

// Get country code of ip address using determination via hostname and RDAP
function get_country_by_ip($ip) {
    // Check if ip address is valid
    if (filter_var($ip, FILTER_VALIDATE_IP)) {
        // Get host
        $host = gethostbyaddr($ip);

        // Try determination of origin via hostname
        $country = get_country_by_host(gethostbyaddr($ip));

        // If determination via hostname fails and ip is not localhost check RDAP record of ip address
        if($country == null && $ip != "127.0.0.1" && $ip != "::1") {
            $country = get_country_by_rdap($ip);
            if($country == null) {
                $domain_parts = explode(".", $host);
                $top_level_domain = $domain_parts[count($domain_parts) - 1];
                if($top_level_domain == "com" || $top_level_domain == "net" || $top_level_domain == "edu" || $top_level_domain == "gov") {
                    return "US";
                }
            }
        }
        return $country;
    }
    return null;
}

// Get country code of ip address using RDAP record
function get_country_by_rdap($query, $real_time_data = false) {
    // Make sure given query is ip address
    if(filter_var($query, FILTER_VALIDATE_IP)) {
        $ip = $query;

        // Perform request depending on whether ip address is ipv4 or ipv6
        if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $iana_ipv4 = ["description"=>"RDAP bootstrap file for IPv4 address allocations","publication"=>"2019-06-07T19:00:02Z","services"=>[[["41.0.0.0/8","102.0.0.0/8","105.0.0.0/8","154.0.0.0/8","196.0.0.0/8","197.0.0.0/8"],["https://rdap.afrinic.net/rdap/","http://rdap.afrinic.net/rdap/"]],[["1.0.0.0/8", "14.0.0.0/8", "27.0.0.0/8", "36.0.0.0/8", "39.0.0.0/8", "42.0.0.0/8", "43.0.0.0/8", "49.0.0.0/8", "58.0.0.0/8", "59.0.0.0/8", "60.0.0.0/8", "61.0.0.0/8", "101.0.0.0/8", "103.0.0.0/8", "106.0.0.0/8", "110.0.0.0/8", "111.0.0.0/8", "112.0.0.0/8", "113.0.0.0/8", "114.0.0.0/8", "115.0.0.0/8", "116.0.0.0/8", "117.0.0.0/8", "118.0.0.0/8", "119.0.0.0/8", "120.0.0.0/8", "121.0.0.0/8", "122.0.0.0/8", "123.0.0.0/8", "124.0.0.0/8", "125.0.0.0/8", "126.0.0.0/8", "133.0.0.0/8", "150.0.0.0/8", "153.0.0.0/8", "163.0.0.0/8", "171.0.0.0/8", "175.0.0.0/8", "180.0.0.0/8", "182.0.0.0/8", "183.0.0.0/8", "202.0.0.0/8", "203.0.0.0/8", "210.0.0.0/8", "211.0.0.0/8", "218.0.0.0/8", "219.0.0.0/8", "220.0.0.0/8", "221.0.0.0/8", "222.0.0.0/8", "223.0.0.0/8"], ["https://rdap.apnic.net/"]], [["3.0.0.0/8", "4.0.0.0/8", "6.0.0.0/8", "7.0.0.0/8", "8.0.0.0/8", "9.0.0.0/8", "11.0.0.0/8", "12.0.0.0/8", "13.0.0.0/8", "15.0.0.0/8", "16.0.0.0/8", "17.0.0.0/8", "18.0.0.0/8", "19.0.0.0/8", "20.0.0.0/8", "21.0.0.0/8", "22.0.0.0/8", "23.0.0.0/8", "24.0.0.0/8", "26.0.0.0/8", "28.0.0.0/8", "29.0.0.0/8", "30.0.0.0/8", "32.0.0.0/8", "33.0.0.0/8", "34.0.0.0/8", "35.0.0.0/8", "38.0.0.0/8", "40.0.0.0/8", "44.0.0.0/8", "45.0.0.0/8", "47.0.0.0/8", "48.0.0.0/8", "50.0.0.0/8", "52.0.0.0/8", "54.0.0.0/8", "55.0.0.0/8", "56.0.0.0/8", "63.0.0.0/8", "64.0.0.0/8", "65.0.0.0/8", "66.0.0.0/8", "67.0.0.0/8", "68.0.0.0/8", "69.0.0.0/8", "70.0.0.0/8", "71.0.0.0/8", "72.0.0.0/8", "73.0.0.0/8", "74.0.0.0/8", "75.0.0.0/8", "76.0.0.0/8", "96.0.0.0/8", "97.0.0.0/8", "98.0.0.0/8", "99.0.0.0/8", "100.0.0.0/8", "104.0.0.0/8", "107.0.0.0/8", "108.0.0.0/8", "128.0.0.0/8", "129.0.0.0/8", "130.0.0.0/8", "131.0.0.0/8", "132.0.0.0/8", "134.0.0.0/8", "135.0.0.0/8", "136.0.0.0/8", "137.0.0.0/8", "138.0.0.0/8", "139.0.0.0/8", "140.0.0.0/8", "142.0.0.0/8", "143.0.0.0/8", "144.0.0.0/8", "146.0.0.0/8", "147.0.0.0/8", "148.0.0.0/8", "149.0.0.0/8", "152.0.0.0/8", "155.0.0.0/8", "156.0.0.0/8", "157.0.0.0/8", "158.0.0.0/8", "159.0.0.0/8", "160.0.0.0/8", "161.0.0.0/8", "162.0.0.0/8", "164.0.0.0/8", "165.0.0.0/8", "166.0.0.0/8", "167.0.0.0/8", "168.0.0.0/8", "169.0.0.0/8", "170.0.0.0/8", "172.0.0.0/8", "173.0.0.0/8", "174.0.0.0/8", "184.0.0.0/8", "192.0.0.0/8", "198.0.0.0/8", "199.0.0.0/8", "204.0.0.0/8", "205.0.0.0/8", "206.0.0.0/8", "207.0.0.0/8", "208.0.0.0/8", "209.0.0.0/8", "214.0.0.0/8", "215.0.0.0/8", "216.0.0.0/8"], ["https://rdap.arin.net/registry/", "http://rdap.arin.net/registry/"]], [["2.0.0.0/8", "5.0.0.0/8", "25.0.0.0/8", "31.0.0.0/8", "37.0.0.0/8", "46.0.0.0/8", "51.0.0.0/8", "53.0.0.0/8", "57.0.0.0/8", "62.0.0.0/8", "77.0.0.0/8", "78.0.0.0/8", "79.0.0.0/8", "80.0.0.0/8", "81.0.0.0/8", "82.0.0.0/8", "83.0.0.0/8", "84.0.0.0/8", "85.0.0.0/8", "86.0.0.0/8", "87.0.0.0/8", "88.0.0.0/8", "89.0.0.0/8", "90.0.0.0/8", "91.0.0.0/8", "92.0.0.0/8", "93.0.0.0/8", "94.0.0.0/8", "95.0.0.0/8", "109.0.0.0/8", "141.0.0.0/8", "145.0.0.0/8", "151.0.0.0/8", "176.0.0.0/8", "178.0.0.0/8", "185.0.0.0/8", "188.0.0.0/8", "193.0.0.0/8", "194.0.0.0/8", "195.0.0.0/8", "212.0.0.0/8", "213.0.0.0/8", "217.0.0.0/8"], ["https://rdap.db.ripe.net/"]], [["177.0.0.0/8", "179.0.0.0/8", "181.0.0.0/8", "186.0.0.0/8", "187.0.0.0/8", "189.0.0.0/8", "190.0.0.0/8", "191.0.0.0/8", "200.0.0.0/8", "201.0.0.0/8"], ["https://rdap.lacnic.net/rdap/"]]], "version"=> "1.0"];
            if($real_time_data) {
                $iana_ipv4 = file_get_contents("http://data.iana.org/rdap/ipv4.json");
                if(is_bool($iana_ipv4)) {
                    return null;
                }
                $iana_ipv4 = json_decode($iana_ipv4, true);
            }
            $ip_parts = explode(".", $ip);
            foreach ($iana_ipv4["services"] as $service) {
                foreach ($service[0] as $ip_range) {
                    if($ip_range == $ip_parts[0].".0.0.0/8") {
                        $service_rdap = file_get_contents(preg_replace("/https/i", "http", $service[1][0])."ip/".$ip);
                        if($service_rdap == FALSE) {
                            return null;
                        }
                        $service_rdap = json_decode($service_rdap, true);
                        if(isset($service_rdap["country"])) {
                            return strtoupper($service_rdap["country"]);
                        } else {
                            return null;
                        }
                    }
                }
            }
        } else if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $iana_ipv6 = ["description"=> "RDAP bootstrap file for IPv6 address allocations", "publication"=> "2019-11-06T19:00:04Z", "services"=> [[["2001:4200::/23", "2c00::/12"], ["https://rdap.afrinic.net/rdap/", "http://rdap.afrinic.net/rdap/"]], [["2001:200::/23", "2001:4400::/23", "2001:8000::/19", "2001:a000::/20", "2001:b000::/20", "2001:c00::/23", "2001:e00::/23", "2400::/12"], ["https://rdap.apnic.net/"]], [["2001:1800::/23", "2001:400::/23", "2001:4800::/23", "2600::/12", "2610::/23", "2620::/23", "2630::/12"], ["https://rdap.arin.net/registry/", "http://rdap.arin.net/registry/"]], [["2001:1400::/22", "2001:1a00::/23", "2001:1c00::/22", "2001:2000::/19", "2001:4000::/23", "2001:4600::/23", "2001:4a00::/23", "2001:4c00::/23", "2001:5000::/20", "2001:600::/23", "2001:800::/22", "2003::/18", "2a00::/12", "2a10::/12"], ["https://rdap.db.ripe.net/"]], [["2001:1200::/23", "2800::/12"], ["https://rdap.lacnic.net/rdap/"]]], "version"=>"1.0"];
            if($real_time_data) {
                $iana_ipv6 = file_get_contents("http://data.iana.org/rdap/ipv6.json");
                if (is_bool($iana_ipv6)) {
                    return null;
                }
                $iana_ipv6 = json_decode($iana_ipv6, true);
            }
            $ip_parts = explode(":", $ip);
            foreach ($iana_ipv6["services"] as $service) {
                foreach ($service[0] as $ip_range) {
                    if(preg_match("/".$ip_parts[0].":".$ip_parts[1]."::\/\d[\d]*/", $ip_range) || preg_match("/".$ip_parts[0]."::\/\d[\d]*/", $ip_range)) {
                        $service_rdap = file_get_contents(preg_replace("/https/i", "http", $service[1][0])."ip/".$ip);
                        if($service_rdap == FALSE) {
                            return null;
                        }
                        $service_rdap = json_decode($service_rdap, true);
                        if(isset($service_rdap["country"])) {
                            return strtoupper($service_rdap["country"]);
                        } else {
                            return null;
                        }
                    }
                }
            }
        }
    }
    return null;
}