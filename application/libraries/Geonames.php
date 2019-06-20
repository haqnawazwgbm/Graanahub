<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
include_once APPPATH.'/third_party/geonames-client-master/src/Client.php';
 use GeoNames\Client as GeoNamesClient;
class Geonames {
 
	public function __construct()
	{
	    $g = new GeoNamesClient('username');

		// get a list of supported endpoints
		$endpoints = $g->getSupportedEndpoints();

		// get info for country
		// note that I'm using the array destructor introduced in PHP 7.1
		$country = $g->countryInfo([
		    'country' => 'IL',
		    'lang'    => 'ru', // display info in Russian
		]);

		// country name (in Russian)
		$country_name = $country->countryName;

		// spoken languages (ISO-639-1)
		$country_languages = $country->languages;
	}
}



?>