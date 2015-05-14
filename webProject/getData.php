<?php

  session_start();

  define('FACEBOOK_SDK_V4_SRC_DIR', '/Facebook/');
  require __DIR__ . '/autoload.php';

  //require_once ('connToDB.php');
  //
  // create table events(idDB int not null auto_increment, id int, name varchar(255), category varchar(255),  )

  require_once( 'Facebook/FacebookRequest.php' );
  require_once( 'Facebook/FacebookSession.php' );
  require_once( 'Facebook/FacebookRedirectLoginHelper.php' );
  require_once( 'Facebook/FacebookResponse.php' );
  require_once( 'Facebook/FacebookSDKException.php' );
  require_once( 'Facebook/FacebookRequestException.php' );
  require_once( 'Facebook/FacebookAuthorizationException.php' );
  require_once( 'Facebook/FacebookServerException.php' );
  require_once( 'Facebook/GraphObject.php' );
  require_once( 'Facebook/GraphUser.php' );
  require_once( 'Facebook/GraphLocation.php' );
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
  use Facebook\GraphLocation;
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



  /* make the API call */
  $request = new FacebookRequest(
    $session,
    'GET',
    '/search?q=Πάτρα&type=place&center=38.247431,21.736739&distance=5000'
  );
  $response = $request->execute();
  $graphObject = $response->getGraphObject()->asArray();
  //print_r($response->getRawResponse());
  print_r($graphObject);
  //print_r($graphObject['data'][1]->location);
 
  $nextPageRequest = $response->getRequestForNextPage();  //get nextPageRequest

  curl_setopt($ch, CURLOPT_TIMEOUT,5500); //increase the curl's timeout limit due to a timeout error on large facebook requests

  //while loop, handling large(more than one page) requests
  while(!empty($nextPageRequest)){
    $response = $nextPageRequest->execute();
    $graphObject = $response->getGraphObject()->asArray();
    print_r($graphObject);

    $nextPageRequest = $response->getRequestForNextPage();

  }
/*
$stmt = $con->prepare('
    INSERT INTO this_should_be_your_table_name
    (id, created_time, place_id, latitude, longitude, state, street, zip, name)
    VALUES
    (?, ?, ?, ?, ?, ?)
');

foreach($graphObject['tagged_places']->data as $data) {
   $stmt->execute(array(
       $data->id,
       $data->created_time,
       $data->place->id,
       $data->place->location->latitude,
       $data->place->location->longitude,
       $data->place->location->state,
       $data->place->location->street,
       $data->place->location->zip,
       $data->place->name
   ));
}*/
  
  
?>