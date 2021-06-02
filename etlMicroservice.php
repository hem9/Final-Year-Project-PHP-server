<?php

//display errors if tested
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'convertXML2.php';

include_once 'XML2JSON.php';


//Ensuring it's a POST Request
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
    //405 if it is not a POST Request
    header($_SERVER["SERVER_PROTOCOL"]." 405 Method Not Allowed", true, 405);
    exit;
}

//Getting the RAW XML from the post stream
$xml = trim(file_get_contents('php://input'));



//If the parsing fails
if($xml === false) {
    //Revert back 400 Bad Request error.
    header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request", true, 400);
    exit;
}


/*
Description about mapping.csv - 

Mapping CSV files contains the mapping in following structure
oldTag, NewTag, OldAttribute, NewAttribute
*/
$file = fopen('mapping.csv', 'r');
while (($map = fgetcsv($file)) !== FALSE) {
   //$line[0] = '1004000018' in first iteration
   $xml =  transformTags($xml, $map[0], $map[1],$map[2],$map[3]);
}
fclose($file);

//echo '<pre>'; print_r(($xml)); echo '</pre>';


//Converting to a JSON


$xml = new \SimpleXMLElement($xml);
$converter = new TransformXML2JSON();
<<<<<<< HEAD
$jsonString = $converter->convert2JSONString($xml);

echo json_encode(json_decode($jsonString, true), JSON_PRETTY_PRINT);

  

?>
   
=======
$json = $converter->convert2JSONString($xml);
echo $json;
?>
>>>>>>> f56b080ca04b6ce5ca8d513407b7c52e91fffd8b
