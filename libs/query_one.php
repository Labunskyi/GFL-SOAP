<?php
 class query_one
{
private  $client;
function __construct()
{
 $this->setClient('http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL');
}
private function setClient($path)
{
 $this->client = new SoapClient('http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL');
}
 public function getClient()
  {
  return $this->client;
 }
 public function ReturnXMLResult()
{
$result = $this->client->ListOfCountryNamesByCode();
return $result->ListOfCountryNamesByCodeResult->tCountryCodeAndName;
} }
