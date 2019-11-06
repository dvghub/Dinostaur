<?php 
function beginDocument() {
    echo '<!DOCTYPE html>
    <html>';
}
function showHeadSection() {
    echo "
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <title>Opdracht_3.3</title>
    <link rel='stylesheet' href='css/bootstrap.css'>
    <link rel='stylesheet' href='css/open-iconic-bootstrap.css'>
    <link rel='stylesheet' href='css/style.css'>
</head>";
}
function endDocument() {
    echo '</html>';
}