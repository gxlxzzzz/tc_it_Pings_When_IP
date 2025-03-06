<?php

session_start();

require_once "common_functions.php";

echo "<!DOCTYPE html>";

echo "<html lang='en'>";

echo "<head>";
echo "<link rel='stylesheet' href='styles.css'>";
echo "<title> RZA</title>";
echo "</head>";

echo "<body>";

echo "<div id='container'>";

echo "<div id='title'>";

echo "<h3 id='banner'>Ridget Zoo Adventures</h3>";

echo "</div>";

include 'user_nav.php';

echo "<div id='content'>";

echo "<h4> Hello and Welcome to the RZA Website</h4>";

echo "<br>";
echo usr_error($_SESSION);
echo "<br>";

echo "Use the links above to complete the tasks needed. ";
echo "<br>";
echo "<br>";

echo "<img src='assets/zoo-animals.jpg'>";

echo "<br><br>";

echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";



