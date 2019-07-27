# GeoIP
Collection of functions for getting the location of an ip address in PHP without any ip tables.

Part of https://webanalytics.one

## Usage
All you need to do is including "geoip.php":
```php
include  "geoip.php";
```
GeoIP consists of 3 functions:
* get_country_by_host($host, $topleveltocountry = null)
* get_country_by_ip($ip, $topleveltocountry = null)
* get_continent_by_country($country, $countrytocontinent)

What they do is already obvious by their name, the return value is either a the two character country/continent code or null if the location is unknown.

GeoIP also consists of 2 arrays:
* $topleveltocountry
* $countrytocontinent

"$countrytocontinent" is needed as an argument when using get_continent_by_country(...) as it contains the necessary information, "$topleveltocountry" can be used to add a country code for additional TLDs.
