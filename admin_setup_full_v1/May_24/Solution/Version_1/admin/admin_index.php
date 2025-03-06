<?php

session_start();

require_once 'admin_functions.php';
require_once '../dbconnect/db_connect_master.php';

echo "<!DOCTYPE html>";

echo "<html lang='en'>";

echo "<head>";
echo "<link rel='stylesheet' href='admin_styles.css'>";
echo "<title> RZL Admin System</title>";
echo "</head>";

echo "<body>";

echo "<div id='container'>";

echo "<div id='title'>";

echo "<h3 id='banner'>RZL Admin System</h3>";

echo "</div>";

include 'admin_nav.php';

echo "<div id='content'>";

echo "<h4> Admin System</h4>";

echo "<br>";
echo admin_error($_SESSION);

echo "<br>";

echo "Use the links above to complete the tasks needed. ";
echo "<br>";
echo "<br>";

echo "<img src='../assets/zoo-animals.jpg'>";

echo "<br><br>";

echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";



