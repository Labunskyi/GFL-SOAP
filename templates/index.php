<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	
</head>
<body>
	<div class="row"  style='border:1px solid black'>
		<div class="col-md-3"><p>Continents (SOAP):</p><?=$listOfContinentsSoap;?></div>
		<div class="col-md-3"><p>Country by Code (SOAP):</p><?=$countryNameSoap;?></div>
		<div class="col-md-3" style='border-left:1px solid black'><p>Continents (cURL):</p><?=$listOfContinentsCurl;?></div>
		<div class="col-md-3"><p>Country by Code (cURL):</p><?=$countryNameCurl;?></div>
	</div>

</body>
</html>