<?php
require_once 'config.php';
 
function check_auth() {
    $client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
    
 
    $db = new DB();
    $arr_token = $db->get_access_token();
    $accessToken = $arr_token->access_token;
 
    try {
        $response = $client->request('POST', '/oauth/token', [
            "headers" => [
                "Authorization" => "Basic ". base64_encode(CLIENT_ID.':'.CLIENT_SECRET)
            ],
            'form_params' => [
                "grant_type" => "client_credentials"
            ],
        ]);
        echo 'Success';
 
    } catch(Exception $e) {
        if( 401 == $e->getCode() ) {
            echo 'Inalid Credentials';
        } else {
            
            echo $e->getMessage();
        }
    }
}
 
check_auth();