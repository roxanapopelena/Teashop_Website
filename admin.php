<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!--linking to stylesheet-->
    <link rel="stylesheet" type="text/css" href="adminPage.css">
</head>
<body>
<!--table that displays details of people who are interested in offers-->
<h1>Requested interest</h1>
<div class="table">
<table>
    <tr>
    <th>Surname</th>
    <th>Forename</th>
    <th>Postal Address</th>
    <th>Landline Telephone Number</th>
    <th>Mobile Number</th>
    <th>Email Address</th>
    <th>Contact Method</th>
    <th>Category</th>
    </tr>
<?php
//Attempt MySQL server connection
$dbConn = new mysqli('localhost', 'unn_w18004367', 'RoxanasiRusty99', 'unn_w18004367');

//Check connection
if($dbConn === false){
    die("ERROR: Could not connect. " .
        mysqli_connect_error());
}

//sql that joins the two tables found in the database
$sql = "SELECT forename, surname, postalAddress, landLineTelNo,mobileTelNo, email, sendMethod, catDesc
			FROM CT_expressedInterest
			INNER JOIN CT_category
			ON CT_category.catID = CT_expressedInterest.catID
			ORDER BY surname ASC";
$queryResult = $dbConn->query($sql);

// Check for and handle query failure
if($queryResult === false) {
    echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";
    exit;
}
// Otherwise fetch all the rows returned by the query one by one
else {
    while($rowObj = $queryResult->fetch_assoc()){
        echo "<tr><td>". $rowObj["surname"]. "</td><td>".$rowObj["forename"]. "</td><td>".$rowObj["postalAddress"]. "</td><td>". $rowObj["landLineTelNo"]."</td><td>".$rowObj["mobileTelNo"] . "</td><td>".$rowObj["email"] . "</td><td>".$rowObj["sendMethod"] . "</td><td>".$rowObj["catDesc"]."</td></tr>";
    }
}
$queryResult->close();
$dbConn->close();
?>
</table>
</div>
    <a href="index.html" class="button">Back to homepage</a>
</body>
</html>