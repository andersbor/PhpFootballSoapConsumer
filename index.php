<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>SOAP consumer: football</title>
</head>
<body>
<h1>SOAP consumer: football</h1>
<p>
    Example from
    <a href="http://www.vankouteren.eu/blog/2009/03/simple-php-soap-example/">
        http://www.vankouteren.eu/blog/2009/03/simple-php-soap-example/
    </a>
</p>
<?php
if (isset($_POST['topn']) && $_POST['topn'] > 1 && (int)$_POST['topn'] <= 20) {
    $topn = (int)$_POST['topn'];
    $client = new SoapClient("http://footballpool.dataaccess.eu/data/info.wso?wsdl");
    /*
        $result = $client->StadiumNames();
        print_r($result);
        $stadiumNames = $result->StadiumNamesResult->string;
        print_r($stadiumNames->StadiumNamesResult);

        foreach ($stadiumNames as $name) {
            echo $name . "<br />";
        }
    */
    $result = $client->TopGoalScorers(array('iTopN' => $topn));
    // Note that $array contains the result of the traversed object structure

    $array = $result->TopGoalScorersResult->tTopGoalScorer;
    print_r($array);
    print "<table border='2'>
            <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>Country</th>
                <th>Goals</th>
            </tr>
            ";

    foreach ($array as $k => $v) {
        print "
            <tr>
                <td align='right'>" . ($k + 1) . "</td>
                <td>" . $v->sName . "</td>
                <td><img src='" . $v->sFlag . "'></td>
                <td align='right'>" . $v->iGoals . "</td>
            </tr>";
    }

    print "</table>";
} else {
    ?>
    <h2>Stadiums</h2>
    <a href="stadiums.php">Stadiums</a>

    <h2>Teams</h2>
    <a href="teams.php">Teams</a>

    <h2>Top scorers</h2>

    <form id="topscorers" action="index.php" method="post">
        How long should your topscorers list be? (Choose a digit between 2 and 20).
        <input id="topn" name="topn" size="2" type="text" value="10"/>
        <input id="submit" name="submit" type="submit" value="submit"/>
    </form>

    <?php
}
?>
</body>
</html>
