<?php

echo "<div id='admin_navbar'>";
echo " :: ";

echo "<a href='admin_index.php'> Home </a>";

echo " :: ";

if (!isset($_SESSION["admin_ssnlogin"])) {
    echo "<a href='admin_login.php'> Login </a>";
} else {
//    if super
    if ($_SESSION["priv"] == "SUPER") {
        echo "<a href='add_admin.php'> Add admin </a>";
        echo " :: ";
    }
    if ($_SESSION["priv"] != "EDITOR") {

        echo "<a href='add_ticket.php'> Add Ticket </a>";
        echo " :: ";
        echo "<a href='add_hotelroom.php'> Add Hotel Room </a>";
        echo " :: ";
        echo "<a href='add_usertype.php'> Add User Type </a>";
        echo " :: ";
    }

    echo "<a href='update_ticket.php'> Update Ticket </a>";
    echo " :: ";
    echo "<a href='update_hotelroom.php'> Update Hotel Room </a>";
    echo " :: ";
    echo "<a href='update_usertype.php'> Update Hotel Room </a>";
    echo " :: ";
}
        // everyone
echo "<a href='../logout.php'> Logout </a>";
echo " :: ";
echo "</div>";