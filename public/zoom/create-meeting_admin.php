<?php
function create_meeting($request) {
		 
         $user = Session::get('user');
         $user_id = $user->id;
         
         
         $acc = DB::table('token')->where('userid', $user_id)->first();
         $obj = json_decode($acc->access_token);
         $accessToken = $obj->access_token; 
         $client = new Client(['base_uri' => 'https://api.zoom.us']);
 
   
         $date=date_create($request->meeting_date);
         $startdt = date_format($date,"Y-m-d");
         $ft = (explode(" - ",$request->meeting_time));
         $ftime = (explode(" to ",$ft[1]));
 
         $stime = date("H:i:s", strtotime($ftime[0]));
         $meetdate = $startdt.'T'.$stime;
   
     try {
         $response = $client->request('POST', '/v2/users/me/meetings', [
             "headers" => [
                 "Authorization" => "Bearer $accessToken"
             ],
             'json' => [
                 "topic" => "Integrate zoom APIs",
                 "type" => 2,                              
                 "start_time" => $meetdate,    // meeting start time
                 "duration" => "30",                       // 30 minutes
                 "password" => "123456"                    // meeting password
             ],
         ]);
 
         $data = json_decode($response->getBody());        
         Session::put('url', $data->join_url);
         Session::put('pwd', $data->password);
         Session::put('mid', $data->id);
   
    } catch(Exception $e) {
        if( 401 == $e->getCode() ) {
             
             $acc = DB::table('token')->where('userid', $user_id)->first();
             
             $obj = json_decode($acc->access_token);
             $refresh_token = $obj->access_token; 
            // print_r($refresh_token); exit;
             
             $clientid = $acc->clientid;
             $clientsecret = $acc->clientsecret;
 
             $client = new Client(['base_uri' => 'https://zoom.us']);
             $response = $client->request('POST', '/oauth/token', [
                 "headers" => [
                     "Authorization" => "Basic ". base64_encode($clientid.':'.$clientsecret)
                 ],
                 'form_params' => [
                     "grant_type" => "refresh_token",
                     "refresh_token" => $refresh_token,
                     
                 ],
             ]);
          
          $succ = DB::table('token')->where('userid',$user_id)->update(array('access_token' => $response->getBody())); 
          
 
             create_meeting($request);
         } else {
             echo $e->getMessage();
         }
         
     }
     return $request;
 }
 ?>