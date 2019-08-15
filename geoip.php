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

$countrytocontinent = array("AD"=>"EU","AE"=>"AS","AF"=>"AS","AG"=>"NA","AI"=>"NA","AL"=>"EU","AM"=>"AS","AN"=>"NA","AO"=>"AF","AP"=>"AS","AR"=>"SA","AS"=>"OC","AT"=>"EU","AU"=>"OC","AW"=>"NA","AX"=>"EU","AZ"=>"AS","BA"=>"EU","BB"=>"NA","BD"=>"AS","BE"=>"EU","BF"=>"AF","BG"=>"EU","BH"=>"AS","BI"=>"AF","BJ"=>"AF","BL"=>"NA","BM"=>"NA","BN"=>"AS","BO"=>"SA","BR"=>"SA","BS"=>"NA","BT"=>"AS","BV"=>"AN","BW"=>"AF","BY"=>"EU","BZ"=>"NA","CA"=>"NA","CC"=>"AS","CD"=>"AF","CF"=>"AF","CG"=>"AF","CH"=>"EU","CI"=>"AF","CK"=>"OC","CL"=>"SA","CM"=>"AF","CN"=>"AS","CO"=>"SA","CR,NA","CU"=>"NA","CV"=>"AF","CX"=>"AS","CY"=>"AS","CZ"=>"EU","DE"=>"EU","DJ"=>"AF","DK"=>"EU","DM"=>"NA","DO"=>"NA","DZ"=>"AF","EC"=>"SA","EE"=>"EU","EG"=>"AF","EH"=>"AF","ER"=>"AF","ES"=>"EU","ET"=>"AF","EU"=>"EU","FI"=>"EU","FJ"=>"OC","FK"=>"SA","FM"=>"OC","FO"=>"EU","FR"=>"EU","FX"=>"EU","GA"=>"AF","GB"=>"EU","GD"=>"NA","GE"=>"AS","GF"=>"SA","GG"=>"EU","GH"=>"AF","GI"=>"EU","GL"=>"NA","GM"=>"AF","GN"=>"AF","GP"=>"NA","GQ"=>"AF","GR"=>"EU","GS"=>"AN","GT"=>"NA","GU"=>"OC","GW"=>"AF","GY"=>"SA","HK"=>"AS","HM"=>"AN","HN"=>"NA","HR"=>"EU","HT"=>"NA","HU"=>"EU","ID"=>"AS","IE"=>"EU","IL"=>"AS","IM"=>"EU","IN"=>"AS","IO"=>"AS","IQ"=>"AS","IR"=>"AS","IS"=>"EU","IT"=>"EU","JE"=>"EU","JM"=>"NA","JO"=>"AS","JP"=>"AS","KE"=>"AF","KG"=>"AS","KH"=>"AS","KI"=>"OC","KM"=>"AF","KN"=>"NA","KP"=>"AS","KR"=>"AS","KW"=>"AS","KY"=>"NA","KZ"=>"AS","LA"=>"AS","LB"=>"AS","LC"=>"NA","LI"=>"EU","LK"=>"AS","LR"=>"AF","LS"=>"AF","LT"=>"EU","LU"=>"EU","LV"=>"EU","LY"=>"AF","MA"=>"AF","MC"=>"EU","MD"=>"EU","ME"=>"EU","MF"=>"NA","MG"=>"AF","MH"=>"OC","MK"=>"EU","ML"=>"AF","MM"=>"AS","MN"=>"AS","MO"=>"AS","MP"=>"OC","MQ"=>"NA","MR"=>"AF","MS"=>"NA","MT"=>"EU","MU"=>"AF","MV"=>"AS","MW"=>"AF","MX"=>"NA","MY"=>"AS","MZ"=>"AF","NA"=>"AF","NC"=>"OC","NE"=>"AF","NF"=>"OC","NG"=>"AF","NI"=>"NA","NL"=>"EU","NO"=>"EU","NP"=>"AS","NR"=>"OC","NU"=>"OC","NZ"=>"OC","OM"=>"AS","PA"=>"NA","PE"=>"SA","PF"=>"OC","PG"=>"OC","PH"=>"AS","PK"=>"AS","PL"=>"EU","PM"=>"NA","PN"=>"OC","PR"=>"NA","PS"=>"AS","PT"=>"EU","PW"=>"OC","PY"=>"SA","QA"=>"AS","RE"=>"AF","RO"=>"EU","RS"=>"EU","RU"=>"EU","RW"=>"AF","SA"=>"AS","SB"=>"OC","SC"=>"AF","SD"=>"AF","SE"=>"EU","SG"=>"AS","SH"=>"AF","SI"=>"EU","SJ"=>"EU","SK"=>"EU","SL"=>"AF","SM"=>"EU","SN"=>"AF","SO"=>"AF","SR"=>"SA","ST"=>"AF","SV"=>"NA","SY"=>"AS","SZ"=>"AF","TC"=>"NA","TD"=>"AF","TF"=>"AN","TG"=>"AF","TH"=>"AS","TJ"=>"AS","TK"=>"OC","TL"=>"AS","TM"=>"AS","TN"=>"AF","TO"=>"OC","TR"=>"EU","TT"=>"NA","TV"=>"OC","TW"=>"AS","TZ"=>"AF","UA"=>"EU","UG"=>"AF","UM"=>"OC","US"=>"NA","UY"=>"SA","UZ"=>"AS","VA"=>"EU","VC"=>"NA","VE"=>"SA","VG"=>"NA","VI"=>"NA","VN"=>"AS","VU"=>"OC","WF"=>"OC","WS"=>"OC","YE"=>"AS","YT"=>"AF","ZA"=>"AF","ZM"=>"AF","ZW"=>"AF");

function get_continent_by_country($country, $countrytocontinent) {
    if(isset($country) && isset($countrytocontinent) && array_key_exists($country, $countrytocontinent)) {
        return $countrytocontinent[$country];
    }
    return null;
}

function get_country_by_host($host) {
    if(isset($host) && filter_var($host, FILTER_VALIDATE_IP) == false) {
        $domainparts = explode(".", $host);
        $topleveldomain = $domainparts[count($domainparts) - 1];
        if(strlen($topleveldomain) == 2) {
            return strtoupper($topleveldomain);
        }
    }
    return null;
}

function get_country_by_ip($ip) {
    if (filter_var($ip, FILTER_VALIDATE_IP)) {
        $host = gethostbyaddr($ip);
        $country = get_country_by_host(gethostbyaddr($ip));
        if($country == null && $ip != "127.0.0.1" && $ip != "::1") {
            $country = get_country_by_rdap($ip);
            if($country == null) {
                $domainparts = explode(".", $host);
                $topleveldomain = $domainparts[count($domainparts) - 1];
                if($topleveldomain == "com" || $topleveldomain == "net" || $topleveldomain == "edu" || $topleveldomain == "gov") {
                    return "US";
                }
            }
        }
        return $country;
    }
    return null;
}

function get_country_by_rdap($query) {
    if(filter_var($query, FILTER_VALIDATE_IP)) {
        $ip = $query;
        if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $iana_ipv4 = file_get_contents("http://data.iana.org/rdap/ipv4.json");
            if(is_bool($iana_ipv4)) {
                return null;
            }
            $iana_ipv4 = json_decode($iana_ipv4, true);
            $ipparts = explode(".", $ip);
            foreach ($iana_ipv4["services"] as $service) {
                foreach ($service[0] as $iprange) {
                    if($iprange == $ipparts[0].".0.0.0/8") {
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
            $iana_ipv6 = file_get_contents("http://data.iana.org/rdap/ipv6.json");
            if(is_bool($iana_ipv6)) {
                return null;
            }
            $iana_ipv6 = json_decode($iana_ipv6, true);
            $ipparts = explode(":", $ip);
            foreach ($iana_ipv6["services"] as $service) {
                foreach ($service[0] as $iprange) {
                    if(preg_match("/".$ipparts[0].":".$ipparts[1]."::\/\d[\d]*/", $iprange) || preg_match("/".$ipparts[0]."::\/\d[\d]*/", $iprange)) {
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