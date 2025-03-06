<?php

echo "<div id='user_navbar'>";
echo " :: ";

echo "<a href='index.php'> Home </a>";

echo " :: ";

if (!isset($_SESSION["user_ssnlogin"])) {
    echo "<a href='user_reg.php'> Register </a>";
    echo " :: ";
    echo "<a href='user_login.php'> Login </a>";
    echo " :: ";

} else {
//    if super

    echo "<a href='book_tickets.php'> Book tickets </a>";
    echo " :: ";
    echo "<a href='book_hotelroom.php'> Book Hotel Room </a>";
    echo " :: ";

}
// everyone
if (isset($_SESSION["user_ssnlogin"])) {
    echo "<a href='logout.php'> Logout </a>";
    echo " :: ";
}
echo "</div>";