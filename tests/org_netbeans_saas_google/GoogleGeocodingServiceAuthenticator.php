<?php

include("GoogleGeocodingServiceAuthenticatorProfile.php");

class GoogleGeocodingServiceAuthenticator {

    public static function getApiKey() {
        $apiKey = GoogleGeocodingServiceAuthenticatorProfile::getApiKey();
        if ($apiKey == null || $apiKey == "") {
            throw new Exception("Please specify your api key in the apikey.php file.");
        }
        return $apiKey;
    }

}

?>
