<?php

include_once "org_netbeans_saas/RestConnection.php";
include_once "GoogleGeocodingServiceAuthenticator.php";

class GoogleGeocodingService {

    public function GoogleGeocodingService() {
        
    }

    /*
      @param q resource URI parameter
      @param output resource URI parameter
      @return an instance of RestResponse */

    public static function geocode($q, $output) {
        $apiKey = GoogleGeocodingServiceAuthenticator::getApiKey();
        $pathParams = array();
        $queryParams = array();
        $queryParams["q"] = $q;
        $queryParams["key"] = $apiKey;
        $queryParams["output"] = $output;

        $conn = new RestConnection("http://maps.google.com/maps/geo", $pathParams, $queryParams);

        sleep(1);
        return $conn->get();
    }

}

?>
