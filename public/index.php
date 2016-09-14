<?php

try {

    require_once "../app/config.php";

    // Handle the request
    $response = $application->handle();

    $response->send();

} catch (\Exception $e) {
     echo "Exception: ", $e->getMessage();
}
