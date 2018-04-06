<?php
echo "hello";

$r = new HttpRequest('http://www.zipcodeapi.com/rest/JLXi98W5gX428RfOFL1sF7tjBpGhLt5xxUfS5NW7I1q4Axhotojpy3R7OuMkGIF1/distance.json/23508/23173/miles', HttpRequest::METH_GET);

try {
    $r->send();
    if ($r->getResponseCode() == 200) {
        echo $r->getResponseBody();
    }
} catch (HttpException $ex) {
    echo $ex;
}

?>