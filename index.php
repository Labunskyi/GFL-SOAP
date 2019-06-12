<?php
// Использование Web-сервиса

// Создание SOAP-клиента по WSDL-документу


include('libs/query_one.php');
include('libs/query_two.php');
$client = new SoapClient("http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL");

// Поcылка SOAP-запроса и получение результата

$Continents = $client->ListOfContinentsByName()->ListOfContinentsByNameResult->tContinent;

$listContinents = '';
foreach ($Continents as $value) {
   
    $listContinents .= $value->sName . '</br>';
   
}

function country_name($code){
    $client = new SoapClient("http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL");
    $response = $client->CountryName(['sCountryISOCode'=>$code]);   
    return $response->CountryNameResult;
    }
   
$country = (country_name('CA'));



$client = new query_one;
$result = $client->ReturnXMLResult();

$client2 = new query_two;
$result2 = $client2->ReturnXMLResult("ZM");

echo "<pre>".print_r($result2, true)."</pre>";

$xml_post_string = '<?xml version="1.0" encoding="utf-8"?>'.
                    '<soap12:Envelope xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">'.
                    '<soap12:Body>'.
                         '<ListOfCountryNamesByCode xmlns="http://www.oorsprong.org/websamples.countryinfo">'.
                         '</ListOfCountryNamesByCode>'.
                     '</soap12:Body>'.
                     '</soap12:Envelope>';

$headers = array(
"Content-type: text/xml;charset=\"utf-8\"",
"Accept: text/xml",
"Cache-Control: no-cache",
"Pragma: no-cache",
"SOAPAction: http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso",
"Content-length: ".strlen($xml_post_string),
);

$url = 'http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL';

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);

curl_close($ch);
 
$response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);

$xml = new SimpleXMLElement($response);

foreach($xml->soapBody->mListOfCountryNamesByCodeResponse->mListOfCountryNamesByCodeResult->mtCountryCodeAndName as $item){
print_r($item);
 }




include 'templates/index.php';
?>