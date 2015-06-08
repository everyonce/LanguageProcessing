<?php
/**
 * Needed Functions
 *
 */
 
 
function array2xml($array, $xml = false){
    if($xml === false){
        $xml = new SimpleXMLExtended('<root/>');
    }
    foreach($array as $key => $value){
        if(is_array($value)){
            if(!is_numeric($key)){
            	array2xml($value, $xml->addChild($key));
            } else {
            	array2xml($value, $xml->addChild('item'));
            }
        }else{
            if(!is_numeric($key)){
            	$xml->addChild($key, $value);
            } else {
            	$xml->addChild('item', $value);
            }
        }
    }
    return $xml->asXML();
}


