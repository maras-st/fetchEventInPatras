<?php

define('FACEBOOK_SDK_V4_SRC_DIR', '/Facebook/');
require __DIR__ . '/autoload.php';


require_once( 'Facebook/FacebookRequest.php' );
require_once( 'Facebook/FacebookSession.php' );
require_once( 'Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'Facebook/FacebookResponse.php' );
require_once( 'Facebook/FacebookSDKException.php' );
require_once( 'Facebook/FacebookRequestException.php' );
require_once( 'Facebook/FacebookAuthorizationException.php' );
require_once( 'Facebook/FacebookServerException.php' );
require_once( 'Facebook/GraphObject.php' );
require_once( 'Facebook/GraphSessionInfo.php' );
require_once( 'Facebook/Entities/AccessToken.php' );
require_once( 'Facebook/HttpClients/FacebookHttpable.php' );
require_once( 'Facebook/HttpClients/FacebookCurlHttpClient.php' );
require_once( 'Facebook/HttpClients/FacebookCurl.php' ); 

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookRequestException;
use Facebook\GraphUser;
use Facebook\GraphObject;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookServerException;
use Facebook\GraphSessionInfo;
use Facebook\FacebookAuthorizationException;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookCurl;

session_start();

FacebookSession::setDefaultApplication('427999317379719', '74c48d7edd640209b90e455f93dda31d');

// If you already have a valid access token:
$session = new FacebookSession('427999317379719|tKZCJugNDcMddRV9cacpSr-ImP0');

// If you're making app-level requests:
$session = FacebookSession::newAppSession();

// To validate the session:
try {
  $session->validate();
} catch (FacebookRequestException $ex) {
  // Session not valid, Graph API returned an exception with the reason.
  echo $ex->getMessage();
} catch (\Exception $ex) {
  // Graph API returned info, but it may mismatch the current app or have expired.
  echo $ex->getMessage();
} 

$accessToken = $session->getAccessToken();

try {
  // Exchange the short-lived token for a long-lived token.
  $longLivedAccessToken = $accessToken->extend();
} catch(FacebookSDKException $e) {
  echo 'Error extending short-lived access token: ' . $e->getMessage();
  exit;
}

// Make a new request and execute it.
try {
  $response = (new FacebookRequest($session, 'GET', '/me'))->execute();
  $object = $response->getGraphObject();
  echo $object->getProperty('name');
} catch (FacebookRequestException $ex) {
  echo $ex->getMessage();
} catch (\Exception $ex) {
  echo $ex->getMessage();
}

// Now store the long lived token in the database
// . . . $db->store($longLivedAccessToken);
// Make calls to Graph with the long lived token.
// . . . 



/* make the API call */
/*$request = new FacebookRequest(
  $session,
  'GET',
  '/me'
);
$response = $request->execute();
$graphObject = $response->getGraphObject(); */
/* handle the result */
?>