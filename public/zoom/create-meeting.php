<?php
require_once 'config.php';
 
function create_meeting() {
    $client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
 
    $db = new DB();
    $arr_token = $db->get_access_token();
    $accessToken = $arr_token->access_token;
 
    try {
        //echo '2';exit;
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
        $link = '<a href="'.$data->join_url.'" target="blank">Join Zoom</a>';
        //echo "Join URL: ".$data->join_url;
        echo $link;
        echo "<br>";
        echo "Meeting Password: ". $data->password;
 
    } catch(Exception $e) {
        if( 401 == $e->getCode() ) {
            //echo '1';exit;
            $refresh_token = $db->get_refersh_token();
            //$refresh_token = 'eyJhbGciOiJIUzUxMiIsInYiOiIyLjAiLCJraWQiOiI2MmNjYjM0Yi1iOGU1LTRhOTMtODZlNS03ZTg0YTcyMzNjMTUifQ.eyJ2ZXIiOjcsImF1aWQiOiJmODczYTI3OTllMTQ4MGNiZDE2ZGFhMDFjYTYwZTZjMyIsImNvZGUiOiJjaTVxZFhlU2VGX2xlTHh5S3BDUjdlU0cybzhSVjFURmciLCJpc3MiOiJ6bTpjaWQ6WVZNTG1SNG5TWUtVNGl5czMwYkJHQSIsImdubyI6MCwidHlwZSI6MSwidGlkIjowLCJhdWQiOiJodHRwczovL29hdXRoLnpvb20udXMiLCJ1aWQiOiJsZUx4eUtwQ1I3ZVNHMm84UlYxVEZnIiwibmJmIjoxNjA3MTAzMjU1LCJleHAiOjIwODAxNDMyNTUsImlhdCI6MTYwNzEwMzI1NSwiYWlkIjoiWXU0bE0zZG9TYjZ5Ums4U0xYMDdVdyIsImp0aSI6IjhjNzFkNGRjLTZhNzQtNDUyNi04ODFlLThmMzMzNTM0ZmE0MCJ9.oMJ3CYuLLp0qbXVV1XxTDTiMZFkbH9rMe96mKydq_XPLS6R9RPAK31Y5ELfVDRwuq8QPjOx1NvRIwyaVtQOkCw';
            $url = 'https://zoom.us/oauth/token?';
            $client_id = CLIENT_ID;
            $client_secret = CLIENT_SECRET;
            $param = array(
                'grant_type' => 'refresh_token',
                //refresh_token is coming from the request
                'refresh_token' => $refresh_token,
            );
    
            $headers = array(
                "Authorization: Basic ". base64_encode($client_id.":".$client_secret)
            );
    
            $params = http_build_query($param);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url.$params);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
            $result = curl_exec($ch);
            $db->update_access_token($result);            
            create_meeting();
           
           
        } else {
            echo $e->getMessage();
        }
    }
}
 
create_meeting();