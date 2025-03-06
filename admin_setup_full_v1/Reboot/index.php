<?php

session_start(); // needs to be first thing, so we have connection to session data

require_once "common_functions.php";  // includes the common functions we will use alot.

echo "<!DOCTYPE html>";

echo "<html lang='en'>";

echo "<head>";
echo "<link rel='stylesheet' href='styles.css'>";
echo "<title> Page title for the tab</title>";
echo "</head>";

echo "<body>";

echo "<div id='container'>";

require_once 'title.php';  // includes the title section of code

require_once 'nav.php';  // includes the nav bar hyperlinks

echo "<div id='content'>";

echo "<h4> Hello and Welcome to the RZA Website</h4>";

echo "<br>";

echo usr_error($_SESSION);  // calls the function for feedback

echo "<br>";

echo "Use the links above to complete the tasks needed. ";
echo "<br>";
echo "<br>";

echo " this is some text";

echo "<br><br>";

echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";



