<?php
/*
 * Sample REST API Call
 *
 */
 

include('needed_functions.php');
require_once('phpdocumentdb.php');

ob_start("ob_gzhandler");


$method = $_SERVER['REQUEST_METHOD'];
$request = split("/", substr(@$_SERVER['PATH_INFO'], 1));
// Variable initialization
$error = false;
$format = strtolower(htmlentities($_GET['format']));
$callback = htmlentities($_GET['callback']);


// This is only really required if you plan on validating an api key before you 
// proceed. How you validate this key is totally up to you.
$key = htmlentities($_GET['key']); 

if ($format == '') $format = 'json';

$out = array();
$out['status'] = '200';
$out['message'] = 'This is a sample api call. Change this to a description of what this API call does.';
//$out['link'] = 'http://yourdomain.com/path-to-your-api-documentation';
$out['request']['format'] = $format;
$out['request']['key'] = $key;
$out['request']['date'] = date('Y-m-d h:i:s');



$host = getenv('APPSETTING_DB_HOST');
$master_key = getenv('APPSETTING_DB_KEY');

echo("HOST:". $host);

echo("masterkey:". $master_key);
// connect DocumentDB
 try {
	 
 
$documentdb = new DocumentDB($host, $master_key);
$db = $documentdb->selectDB("slackBigData");
$col = $db->selectCollection("messages");


require('display_output.php');
exit();
// run query
//$json = $col->query("SELECT * FROM col_test");


switch ($method) {
  case 'PUT':
    
    break;
  case 'POST':
    $json = $documentdb->createDocument($db->id, $col->id, file_get_contents('php://input'));
    break;
  case 'GET':
    
    break;
  case 'DELETE':
    
    break;
}


// Debug
$object = json_encode($json);
var_dump($object);

// If the format is json and there is a callback passed in, set this call up for a JSONP response.
if ($format == 'json') {
	if ($callback != '') $out['request']['callback'] = $callback;
}

require_once('display_output.php');
 }
 catch (Exception $e)
 {
	 $out['message'] = 'Caught nasty exception: '. $e->getMessage();
   require('display_output.php');
exit();
 }