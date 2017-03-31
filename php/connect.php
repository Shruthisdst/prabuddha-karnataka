<?php
$user='root';
$password='mysql';
$database='pk';

$db = @new mysqli('localhost', "$user", "$password", "$database");

if($db->connect_errno > 0)
{
	echo '<span class="aFeature clr2">Not connected to the Database</span>';
	echo '</div> <!-- cd-container -->';
	echo '</div> <!-- cd-scrolling-bg -->';
	echo '</main> <!-- cd-main-content -->';
	include("include_footer.php");

    exit(1);
}
$db->query("set names utf8");
?>
