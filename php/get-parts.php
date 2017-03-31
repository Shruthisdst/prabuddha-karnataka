<?php

include("connect.php");
require_once("common.php");

if(isset($_GET['volume'])){$volume = $_GET['volume'];}else{$volume = '';}

if(!(isValidVolume($volume)))
{
	exit(1);
}

$query = "select distinct part,month,year from article where volume='$volume' order by part";
$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

echo '<div id="issueHolder" class="issueHolder"><div class="issue">';

if($num_rows > 0)
{
	$isFirst = 1;
	while($row = $result->fetch_assoc())
	{
		$part = $row['part'];
		$dpart = preg_replace("/^0/", "", $part);
		$dpart = preg_replace("/\-0/", "-", $dpart);
		echo (($row['month'] == '01') && ($isFirst == 0)) ? '<div class="deLimiter">|</div>' : '';
		$monthdetails = getMonth($row['month']) . ", " . $row['year'];
		$monthdetails = preg_replace('/^,/', '', $monthdetails);
		
		echo '<div class="aIssue"><a href="toc.php?vol=' . $volume . '&amp;part=' . $row['part'] . '" title="'. $monthdetails .'">ಸಂ. ' . toKannada($dpart) . '</a></div>';
		$isFirst = 0;
	}
}

echo '</div></div>';

if($result){$result->free();}
$db->close();

?>
