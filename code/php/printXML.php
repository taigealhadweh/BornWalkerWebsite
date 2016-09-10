<?php
    
$url = "http://www.arpansa.gov.au/uvindex/realtime/xml/uvvalues.xml";
$xml = simplexml_load_file($url); 
foreach ($xml->location as $location)
{
    if($location['id'] == 'melbourne'){
        print_r("The uv index is: ");
        echo $location->index;
        
    }
    
}
?>