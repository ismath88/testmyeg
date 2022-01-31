
<?php
require_once 'config.php';
 
function create_meeting() {
    $client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
    
 
    $db = new DB();
    $arr_token = $db->get_access_token();
    $accessToken = $arr_token->access_token;
 //echo $accessToken;exit;
    try {
        // if you have userid of user than change it with me in url
        $response = $client->request('POST', '/v2/users/me/meetings', [
            "headers" => [
                "Authorization" => "Bearer $accessToken"
            ],
            'json' => [
                "topic" => "Integrate zoom APIs",
                "type" => 2,                              
                "start_time" => "2020-06-22T20:30:00",    // meeting start time
                "duration" => "30",                       // 30 minutes
                "password" => "123456"                    // meeting password
            ],
        ]);
 
        $data = json_decode($response->getBody());
        echo "Join URL: ". $data->join_url;
        echo "<br>";
        echo "Meeting Password: ". $data->password;
 
    } catch(Exception $e) {
        if( 401 == $e->getCode() ) {
            $refresh_token = $db->get_refersh_token();
            $client1 = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
            
            $response1 = $client1->request('POST', '/oauth/token', [
                "headers" => [
                    "Authorization" => "Basic ". base64_encode(CLIENT_ID.':'.CLIENT_SECRET)
                ],
                'form_params' => [
                    "grant_type" => "authorization_code"
                ],
            ]);
                $token = json_decode($response1->getBody()->getContents(), true);
                //echo json_encode($token);
         
           
            /*
            $response = $client->request('POST', '/oauth/token', [
                "headers" => [
                    "Authorization" => "Basic ". base64_encode(CLIENT_ID.':'.CLIENT_SECRET)
                ],
                'form_params' => [
                    "grant_type" => "refresh_token",
                    "refresh_token" => $refresh_token
                ],
            ]);
*/
//echo json_encode($token);exit;
            $db->update_access_token(json_encode($token));
 
            create_meeting();
        } else {
            
            echo $e->getMessage();
        }
    }
}
 
create_meeting();