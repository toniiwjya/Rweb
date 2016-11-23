<?php

Autoloader::add_core_namespace('Facebook');

Autoloader::add_classes(array(
	/**
	 * Facebook classes.
	 */
	'Facebook\\FacebookAuthorizationException'               => __DIR__.'/classes/FacebookAuthorizationException.php',
	'Facebook\\FacebookCanvasLoginHelper'                    => __DIR__.'/classes/FacebookCanvasLoginHelper.php',
	'Facebook\\FacebookClientException'                      => __DIR__.'/classes/FacebookClientException.php',
	'Facebook\\FacebookJavaScriptLoginHelper'                => __DIR__.'/classes/FacebookJavaScriptLoginHelper.php',
	'Facebook\\FacebookOtherException'                       => __DIR__.'/classes/FacebookOtherException.php',
	'Facebook\\FacebookPageTabHelper'                        => __DIR__.'/classes/FacebookPageTabHelper.php',
	'Facebook\\FacebookPermissionException'                  => __DIR__.'/classes/FacebookPermissionException.php',
	'Facebook\\FacebookRedirectLoginHelper'                  => __DIR__.'/classes/FacebookRedirectLoginHelper.php',
	'Facebook\\FacebookRequest'                              => __DIR__.'/classes/FacebookRequest.php',
	'Facebook\\FacebookRequestException'                     => __DIR__.'/classes/FacebookRequestException.php',
	'Facebook\\FacebookResponse'                             => __DIR__.'/classes/FacebookResponse.php',
	'Facebook\\FacebookSDKException'                         => __DIR__.'/classes/FacebookSDKException.php',
	'Facebook\\FacebookServerException'                      => __DIR__.'/classes/FacebookServerException.php',
	'Facebook\\FacebookSession'                              => __DIR__.'/classes/FacebookSession.php',
	'Facebook\\FacebookSignedRequestFromInputHelper'         => __DIR__.'/classes/FacebookSignedRequestFromInputHelper.php',
	'Facebook\\FacebookThrottleException'                    => __DIR__.'/classes/FacebookThrottleException.php',
	'Facebook\\GraphAlbum'                                   => __DIR__.'/classes/GraphAlbum.php',
	'Facebook\\GraphLocation'                                => __DIR__.'/classes/GraphLocation.php',
	'Facebook\\GraphObject'                                  => __DIR__.'/classes/GraphObject.php',
	'Facebook\\GraphPage'                                    => __DIR__.'/classes/GraphPage.php',
	'Facebook\\GraphSessionInfo'                             => __DIR__.'/classes/GraphSessionInfo.php',
	'Facebook\\GraphUser'                                    => __DIR__.'/classes/GraphUser.php',
	'Facebook\\GraphUserPage'                                => __DIR__.'/classes/GraphUserPage.php',
	'Facebook\\Entities\\AccessToken'                        => __DIR__.'/classes/Entities/AccessToken.php',
	'Facebook\\Entities\\SignedRequest'                      => __DIR__.'/classes/Entities/SignedRequest.php',
	'Facebook\\HttpClients\\FacebookCurl'                    => __DIR__.'/classes/HttpClients/FacebookCurl.php',
	'Facebook\\HttpClients\\FacebookCurlHttpClient'          => __DIR__.'/classes/HttpClients/FacebookCurlHttpClient.php',
	'Facebook\\HttpClients\\FacebookGuzzleHttpClient'        => __DIR__.'/classes/HttpClients/FacebookGuzzleHttpClient.php',
	'Facebook\\HttpClients\\FacebookHttpable'                => __DIR__.'/classes/HttpClients/FacebookHttpable.php',
	'Facebook\\HttpClients\\FacebookStream'                  => __DIR__.'/classes/HttpClients/FacebookStream.php',
	'Facebook\\HttpClients\\FacebookStreamHttpClient'        => __DIR__.'/classes/HttpClients/FacebookStreamHttpClient.php',
));
