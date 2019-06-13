<?php
class SoapClass implements iClient
{	
	// Использование Web-сервиса

	// Создание SOAP-клиента по WSDL-документу
	private  $client;
	function __construct(){
		$this->client = new SoapClient('http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL');
	}
	// Поcылка SOAP-запроса без параметров и получение результата
	
	public function getClientWithoutParams(){
		$continents = $this->client->ListOfContinentsByName()->ListOfContinentsByNameResult->tContinent;

		$listOfContinents = '';
			foreach ($continents as $value) {
			$listOfContinents .= $value->sName . '</br>';
			}
		return $listOfContinents;
	}
	// Поcылка SOAP-запроса с параметрами и получение результата
	public function getClientWithParams($code){
		$response = $this->client->CountryName(['sCountryISOCode' => $code]);   
		return $response->CountryNameResult;
		
	}
	
}