<html>
<div class="box">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Page of Find out More Form</title>
    <!--linking to stylesheet-->
    <link rel="stylesheet" type="text/css" href="formConfirmation.css">
</head>
<h1>Confirmation Page of Customer Info</h1>
<br><br>
<p>Thank you for submitting this form.

<p>Below is a summary of the information you provided.</p><br><br>

<?php
//Attempt MySQL server connection
$dbConn = new mysqli('localhost', 'unn_w18004367', 'RoxanasiRusty99', 'unn_w18004367');

//Check connection
if($dbConn === false){
    die("ERROR: Could not connect. " .
        mysqli_connect_error());
}

//Escape user inputs for security
$Forename = mysqli_real_escape_string($dbConn,
    $_REQUEST['Forename']);
$Surname = mysqli_real_escape_string($dbConn,
    $_REQUEST['Surname']);
$EmailAddress = mysqli_real_escape_string($dbConn,
    $_REQUEST['EmailAddress']);
$MobileNumber = mysqli_real_escape_string($dbConn,
    $_REQUEST['MobileNumber']);
$LandlineNumber = mysqli_real_escape_string($dbConn,
    $_REQUEST['LandlineNumber']);
$PostalAddress = mysqli_real_escape_string($dbConn,
    $_REQUEST['PostalAddress']);

//define variables
$GetInTouch = $_POST["GetInTouch"];
$Category = $_POST["Category"];

//displays user inputs
echo 'Forename: ' . $_POST ["Forename"] . '<br>';
echo 'Surname: ' . $_POST ["Surname"] . '<br>';
echo 'Email Address: ' . $_POST ["EmailAddress"] . '<br>';
echo 'Mobile Number: ' . $_POST ["MobileNumber"] . '<br>';
echo 'LandlineNumber: ' . $_POST ["LandlineNumber"] . '<br>';
echo 'Postal Address: ' . $_POST ["PostalAddress"] . '<br>';
$sqlCat = "SELECT catDesc FROM CT_category WHERE catID='$Category'";

$queryResult=$dbConn->query($sqlCat);

while($Category = $queryResult->fetch_object()){
    echo 'Category chosen: ' . "{$Category->catDesc}" . '<br>';
}

echo 'Method to get in touch: ' . $_POST ["GetInTouch"] . '<br><br>';


//Attempt insert query execution
$Category = $_POST['Category'];
$sql = "INSERT INTO CT_expressedInterest (forename, surname, postalAddress, landLineTelNo, mobileTelNo, email, sendMethod, catID)
VALUES ('$Forename', '$Surname', '$PostalAddress', '$LandlineNumber', '$MobileNumber', '$EmailAddress', '$GetInTouch', '$Category')";

//displays a different icon based on user's choice
if($GetInTouch == 'email')
    echo "<img src='icons8-secured-letter-64.png' />";
if($GetInTouch == 'SMS')
    echo "<img src='icons8-sms-64.png' />";
if($GetInTouch == 'post')
    echo "<img src='icons8-post-box-64.png' />";

// Check for and handle query failure
echo "<br><br>";
if(mysqli_query($dbConn, $sql)){
    echo "Records added successfully";
} else {
    echo "ERROR: Could not execute sql. " ;
}

$dbConn->close();
?>
<br><br>
<a href="index.html" class="button">Back to homepage</a>
</div>