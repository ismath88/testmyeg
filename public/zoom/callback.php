<?php
//require_once 'config.php';
require_once 'vendor/autoload.php';
require_once "db.php";
define('CLIENT_ID', 'YVMLmR4nSYKU4iys30bBGA');
define('CLIENT_SECRET', 'eKqYaJ5NjZKiL8m64jfd3kz3JIK2MFvB');
//define('REDIRECT_URI_DEV', 'http://admin.formeeexpress.com/zoom/callback.php');
define('REDIRECT_URI', 'https://formeeadmin.bicsglobal.com/zoom/callback.php');
//define('REDIRECT_URI', 'http://localhost:8000/zoomAuthourise');
try {
    $client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
 $params = explode(',',base64_decode($_GET['state']));
    $response = $client->request('POST', '/oauth/token', [
        "headers" => [
            "Authorization" => "Basic ". base64_encode($params[2].':'.$params[3])
        ],
        'form_params' => [
            "grant_type" => "authorization_code",
            "code" => $_GET['code'],
            "redirect_uri" => REDIRECT_URI
        ],
    ]);
 
    $token = json_decode($response->getBody()->getContents(), true);
 
    $db = new DB();
    //if($db->is_table_empty()) {
        //$db->update_access_token(json_encode($token));
        $msg = 'success';
        $db->update_access_token_params(json_encode($token),$params);
        if($params[1] == "University")
        {
            //header("Location: http://localhost:4000/#/universitycalendar");
            header("Location: https://formeeuniversity.bicsglobal.com/#/universitycalendar");
        }
        if($params[1] == "Agent")
        {
            //header("Location: http://localhost:7000/#/agentcalendar");
            header("Location: https://formeeagents.bicsglobal.com/#/agentcalendar");
        }
        if($params[1] == "Admin")
        {
            //header("Location: http://admin.formeeexpress.com/createmeeting?msg=success");
            header("Location: https://formeeadmin.bicsglobal.com/createmeeting?msg=".$msg);            
        }
    //}
} catch(Exception $e) {
    echo $e->getMessage();
}