<?php
session_start();   
$url = "http://www.arpansa.gov.au/uvindex/realtime/xml/uvvalues.xml";
$xml = simplexml_load_file($url); 
foreach ($xml->location as $location)
{
    if($location['id'] == 'melbourne'){   
        $uvIndex = $location->index->asXML();
        $_SESSION['uvIndex'] = $uvIndex;   
    }
    
}

?>