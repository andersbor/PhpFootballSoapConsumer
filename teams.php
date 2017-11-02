<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<h1>Countries</h1>
<?php
$client = new SoapClient("http://footballpool.dataaccess.eu/data/info.wso?wsdl");
$result = $client->Teams();
//print_r($result);
$teams = $result->TeamsResult->tTeamInfo;
//print_r($teams);
echo "Click the flag";
echo "<table>";

foreach ($teams as $team) {
    echo "<tr><td>" . $team->sName . "</td><td><a href='" . $team->sWikipediaURL . "'><img src='" . $team->sCountryFlag . "' alt='" . $team->sName . "'/></a><td></tr>\n";
}
echo "</table>"
?>
</body>
</html>