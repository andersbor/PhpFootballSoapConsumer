<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Stadiums</title>
</head>
<body>
<h1>Stadiums</h1>
<?php
$client = new SoapClient("http://footballpool.dataaccess.eu/data/info.wso?wsdl");

$result = $client->StadiumNames();
print_r($result);
$stadiumNames = $result->StadiumNamesResult->string;
//print_r($stadiumNames->StadiumNamesResult);


foreach ($stadiumNames as $name) {
    echo "<h2>" . $name . "</h2>";

    $resultDetail = $client->StadiumInfo(array('sStadiumName' => $name));
    $details = $resultDetail->StadiumInfoResult;
    print_r($details);
    echo "City " . $details->sCityName . "<br />";
    echo "Seats " . $details->iSeatsCapacity . "<br />";
    echo "<a href=" . $details->sWikipediaURL . ">WikiPedia</a><br />";
    echo "<a href=" . $details->sGoogleMapsURL . ">Google maps</a>";
    //print_r($resultDetail);
}
?>
</body>
</html>
