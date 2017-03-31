<?php include("include_header.php");?>
<main class="cd-main-content">
		<div class="cd-scrolling-bg cd-color-2">
			<div class="cd-container">
				<h1 class="clr1 gapBelowSmall">ಸಂಪುಟಗಳು</h1>
<?php

include("connect.php");
require_once("common.php");

$query = 'select distinct volume from article order by volume';

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

$row_count = 10;
$count = 0;
$col = 1;

if($num_rows > 0)
{
	echo '<div class="year">';
	while($row = $result->fetch_assoc())
	{
		$count++;
		if($count > $row_count) {
			
			echo '</div>';
			echo '<div class="year">';
			$count = 1;
		}
		echo '<div class="clickYear aIssue" data-volume="' . $row['volume'] . '">ಸಂಪುಟ ' . toKannada(intval($row['volume'])) . '</div>';
	}
	echo '</div>';
}

if($result){$result->free();}
$db->close();

?>
			</div> <!-- cd-container -->
		</div> <!-- cd-scrolling-bg -->
	</main> <!-- cd-main-content -->
<?php include("include_footer.php");?>
