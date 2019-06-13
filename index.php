<?php
include('libs/iClient.php');
include('libs/SoapClass.php');
include('libs/CurlClass.php');

$resultSoap = new SoapClass();
$listOfContinentsSoap = $resultSoap->getClientWithoutParams();
$countryNameSoap = $resultSoap->getClientWithParams('CA');

$resultCurl = new CurlClass();
$listOfContinentsCurl = $resultCurl->getClientWithoutParams();
$countryNameCurl = $resultCurl->getClientWithParams('CA');

include 'templates/index.php';
?>