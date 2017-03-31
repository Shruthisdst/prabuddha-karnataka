<?php include("include_header.php");?>
<main class="cd-main-content">
		<div class="cd-scrolling-bg cd-color-2">
			<div class="cd-container">
				<h1 class="clr1 gapBelowSmall">ಸ್ಥಿರ ಶೀರ್ಷಿಕೆಗಳು</h1>
<?php

include("connect.php");
require_once("common.php");

$query = 'select * from feature order by feat_name';

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		echo ($row['feat_name'] == '') ? '' : '<div class="author"><span class="aAuthor"><a href="feat.php?feature=' . urlencode($row['feat_name']) . '&amp;featid=' . $row['featid'] . '">' . $row['feat_name'] . '</a></div>';
	}
}

if($result){$result->free();}
$db->close();

?>
			</div> <!-- cd-container -->
		</div> <!-- cd-scrolling-bg -->
	</main> <!-- cd-main-content -->
<?php include("include_footer.php");?>
