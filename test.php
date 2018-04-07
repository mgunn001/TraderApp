<?php

$url='http://www.zipcodeapi.com/rest/JLXi98W5gX428RfOFL1sF7tjBpGhLt5xxUfS5NW7I1q4Axhotojpy3R7OuMkGIF1/distance.json/23508/23510/miles';


  //echo file_get_contents($url);
	
	echo  Json_decode(file_get_contents($url),true)['distance'];

?>