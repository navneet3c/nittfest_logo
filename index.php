<?php
//redirect on new user authentication or blank hit
$pagename='NITTFEST';
$appID='589734334376691';
$secretID='644b33be4f05d424b2ccfd865c8f902e';
$app_name='nittfest_app';

if(!isset($_REQUEST['signed_request']))
	header("Location: https://www.facebook.com/{$pagename}/app_{$appID}");

function getUrl($path = '/') {
    if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1)
      || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'
    ) {
      $protocol = 'https://';
    }
    else {
      $protocol = 'http://';
    }
    return $protocol . $_SERVER['HTTP_HOST'] . $path;
}

// Enforce https on production
if (substr(getUrl(), 0, 8) != 'https://' && $_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
  header('Location: https://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
  exit();
}
require_once('utils.php');
?>
<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#" lang="en">
<head>
<title>NITTFEST 13</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes" />
<meta property="og:title" content="<?php echo he($app_name); ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo getUrl(); ?>" />
<meta property="og:image" content="<?php echo getUrl('/images/logo.png'); ?>" />
<meta property="og:site_name" content="<?php echo he($app_name); ?>" />
<meta property="og:description" content="NITTFEST Logo" />
<meta property="fb:app_id" content="<?php echo $appID; ?>" />
<link rel="stylesheet" type="text/css" href="stylesheets/base.css">
<script type="application/x-javascript" src="javascript/jquery-1.7.1.min.js"></script>
<script type="application/x-javascript" src="javascript/jquery.jqpuzzle.min.js"></script>
<script type="application/x-javascript" src="javascript/scripts.js"></script>
</head>
<body>
<?php
function base64_url_decode($input) {
  return base64_decode(strtr($input, '-_', '+/'));
}
$signed_request = $_REQUEST['signed_request'];
$secret=$secretID;
  list($encoded_sig, $payload) = explode('.', $signed_request, 2);

  // decode the data
  $sig = base64_url_decode($encoded_sig);
  $data = json_decode(base64_url_decode($payload), true);

  if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
    error_log('Unknown algorithm. Expected HMAC-SHA256');
    die();
  }

  // Adding the verification of the signed_request below
  $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
  if ($sig !== $expected_sig) {
    error_log('Bad Signed JSON signature!');
    die();
  }

  $data_signed=$data;
if(!$data_signed['page']['liked']){
	echo '<center><img src="images/like.jpg" alt="Like our page!" title="Become our fan first to unveil the logo!" /><br />Like our Page to check out the new NITTFEST \'13 LOGO!!!</center>';
}else{ ?>
<center><div id="logopuzzle">
<span id="toptext"><h4>The Wild Unscramble</h4></span>
	<img src="images/logo.jpg" style="display: none; position: relative; z-index:25" alt="logotest" id="logo">
	<div id="giveup">Reveal Logo!</div></div></center>
<?php
}
?>
</body>
</html>
