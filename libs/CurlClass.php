<?php
class CurlClass implements iClient
{	
	// Использование Web-сервиса

	// Создание SOAP-клиента по WSDL-документу
	private  $client;
	function __construct(){
		$this->client = new SoapClient('http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL');
	}
	// Поcылка SOAP-запроса без параметров и получение результата
	
	public function getClientWithoutParams(){
		
		$xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
			<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
			  <soap:Body>
				<ListOfContinentsByName xmlns="http://www.oorsprong.org/websamples.countryinfo">
				</ListOfContinentsByName>
			  </soap:Body>
			</soap:Envelope>';
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
		$continents = $xml->soapBody->mListOfContinentsByNameResponse->mListOfContinentsByNameResult->mtContinent;

		$listOfContinents = '';
			foreach ($continents as $value) {
			$listOfContinents .= $value->msName . '</br>';
			}
		return $listOfContinents;
	}
	
	
	public function getClientWithParams($code){
	
		$xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
			<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
			  <soap:Body>
				<CountryName xmlns="http://www.oorsprong.org/websamples.countryinfo">
				  <sCountryISOCode>' . $code . '</sCountryISOCode>
				</CountryName>
			  </soap:Body>
			</soap:Envelope>';
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
		return $response;
		
	
	}
}
