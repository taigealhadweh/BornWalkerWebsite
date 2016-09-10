<?php
session_start();   
$url = "http://www.arpansa.gov.au/uvindex/realtime/xml/uvvalues.xml";
$xml = simplexml_load_file($url); 
foreach ($xml->location as $location)
{
    if($location['id'] == 'melbourne'){
        print_r("The uv index is: ");
        
        $uvIndex = $location->index->asXML();
        print_r($uvIndex);
        $_SESSION['uvIndex'] = $uvIndex;

//print_r("Session is: $_SESSION[uvIndex]" );
//        echo $location->index;
        
    }
    
}

?>