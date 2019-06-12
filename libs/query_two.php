<?php
class query_two
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
 public function ReturnXMLResult($val)
  {
  $arr = array("sCountryISOCode"=>$val);
 $result = $this->client->CountryName($arr);
 return $result->CountryNameResult;
 }
 }
