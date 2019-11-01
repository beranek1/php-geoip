# GeoIP
PHP Library for retrieving the geolocation of ip addresses.

## Usage
All you need to do is including "geoip.php":
```php
include  "geoip.php";
```
GeoIP consists of 4 functions:
* get_country_by_host($host)
* get_country_by_ip($ip)
* get_country_by_rdap($query)
* get_continent_by_country($country, $countrytocontinent)

What they do is already obvious by their name, the return value is either a two character country/continent code or null if the location is unknown.

"get_country_by_rdap($query)" uses the RDAP protocol for getting the ip address' location, works for all european ones.

GeoIP also consists of one array:
* $countrytocontinent (Needed as an argument when using get_continent_by_country(...) as it contains the necessary information)

## Affiliated projects
* [WebAnalytics / PHP web analytics](https://webanalytics.one)
* [UAA / User Agent Analyser](https://uaa.beranek.one)
* [IPA / IP Anonymizer](https://github.com/beranek1/ip-anonymizer)