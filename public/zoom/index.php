<?php
require_once 'config.php';
 $user_id = 18;
 $type = 'Admin';
 $param = base64_encode($user_id.','.$type);
$url = "https://zoom.us/oauth/authorize?response_type=code&client_id=".CLIENT_ID."&state=".$param."&redirect_uri=".REDIRECT_URI;
?>
  
<a href="<?php echo $url; ?>">Login with Zoom</a>
