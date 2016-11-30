
<?php session_start(); ?>
<html>
<head>
    <title>ITEH</title>
</head>
<body id="body">
<button id="trips">Aranzmani</button>
<button id="passengers">Putnici</button>
<div id="response">

</div>

<?php loadScripts() ;?>
</body>
</html>

<?php


function loadScripts()
{
    echo "<script src='js/jquery-3.1.1.js.js'></script>";
    echo "<script src='js/functions.js'></script>";
    echo "<script src='js/tableFunctions.js'></script>";
    echo "<script src='js/tripPassenger.js'></script>";
}