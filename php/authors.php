<?php include("include_header.php");?>
<main class="cd-main-content">
		<div class="cd-scrolling-bg cd-color-2">
			<div class="cd-container">
				<h1 class="clr1">ಲೇಖಕರು</h1>
				<div class="alphabet gapBelowSmall gapAboveSmall">
					<span class="letter"><a href="authors.php?letter=ಅ">ಅ</a></span>
					<span class="letter"><a href="authors.php?letter=ಆ">ಆ</a></span>
					<span class="letter"><a href="authors.php?letter=ಇ">ಇ</a></span>
					<span class="letter"><a href="authors.php?letter=ಈ">ಈ</a></span>
					<span class="letter"><a href="authors.php?letter=ಉ">ಉ</a></span>
					<span class="letter"><a href="authors.php?letter=ಊ">ಊ</a></span>
					<span class="letter"><a href="authors.php?letter=ಋ">ಋ</a></span>
					<span class="letter"><a href="authors.php?letter=ಎ">ಎ</a></span>
					<span class="letter"><a href="authors.php?letter=ಏ">ಏ</a></span>
					<span class="letter"><a href="authors.php?letter=ಐ">ಐ</a></span>
					<span class="letter"><a href="authors.php?letter=ಒ">ಒ</a></span>
					<span class="letter"><a href="authors.php?letter=ಓ">ಓ</a></span>
					<span class="letter"><a href="authors.php?letter=ಔ">ಔ</a></span>
					<span class="letter"><a href="authors.php?letter=ಕ">ಕ</a></span>
					<span class="letter"><a href="authors.php?letter=ಖ">ಖ</a></span>
					<span class="letter"><a href="authors.php?letter=ಗ">ಗ</a></span>
					<span class="letter"><a href="authors.php?letter=ಘ">ಘ</a></span>
					<span class="letter"><a href="authors.php?letter=ಚ">ಚ</a></span>
					<span class="letter"><a href="authors.php?letter=ಛ">ಛ</a></span>
					<span class="letter"><a href="authors.php?letter=ಜ">ಜ</a></span>
					<span class="letter"><a href="authors.php?letter=ಝ">ಝ</a></span>
					<span class="letter"><a href="authors.php?letter=ಟ">ಟ</a></span>
					<span class="letter"><a href="authors.php?letter=ಠ">ಠ</a></span>
					<span class="letter"><a href="authors.php?letter=ಡ">ಡ</a></span>
					<span class="letter"><a href="authors.php?letter=ಢ">ಢ</a></span>
					<span class="letter"><a href="authors.php?letter=ತ">ತ</a></span>
					<span class="letter"><a href="authors.php?letter=ಥ">ಥ</a></span>
					<span class="letter"><a href="authors.php?letter=ದ">ದ</a></span>
					<span class="letter"><a href="authors.php?letter=ಧ">ಧ</a></span>
					<span class="letter"><a href="authors.php?letter=ನ">ನ</a></span>
					<span class="letter"><a href="authors.php?letter=ಪ">ಪ</a></span>
					<span class="letter"><a href="authors.php?letter=ಫ">ಫ</a></span>
					<span class="letter"><a href="authors.php?letter=ಬ">ಬ</a></span>
					<span class="letter"><a href="authors.php?letter=ಭ">ಭ</a></span>
					<span class="letter"><a href="authors.php?letter=ಮ">ಮ</a></span>
					<span class="letter"><a href="authors.php?letter=ಯ">ಯ</a></span>
					<span class="letter"><a href="authors.php?letter=ರ">ರ</a></span>
					<span class="letter"><a href="authors.php?letter=ಲ">ಲ</a></span>
					<span class="letter"><a href="authors.php?letter=ವ">ವ</a></span>
					<span class="letter"><a href="authors.php?letter=ಶ">ಶ</a></span>
					<span class="letter"><a href="authors.php?letter=ಷ">ಷ</a></span>
					<span class="letter"><a href="authors.php?letter=ಸ">ಸ</a></span>
					<span class="letter"><a href="authors.php?letter=ಹ">ಹ</a></span>
					<span class="letter"><a href="authors.php?letter=ಳ">ಳ</a></span>
					<span class="letter"><a href="authors.php?letter=other">#</a></span>
				</div> 
<?php

include("connect.php");
require_once("common.php");

 if(isset($_GET['letter']))
 {
 	$letter=$_GET['letter'];

 	if(!(isValidLetter($letter)))
 	{
 		echo '<span class="aFeature clr2">Invalid URL</span>';
 		echo '</div> <!-- cd-container -->';
 		echo '</div> <!-- cd-scrolling-bg -->';
 		echo '</main> <!-- cd-main-content -->';
 		include("include_footer.php");

         exit(1);
 	}
	
 	($letter == '') ? $letter = 'ಅ' : $letter = $letter;
 }
 else
 {
 	$letter = 'ಅ';
 }

if($letter == 'other')
{
	$query = "SELECT * FROM author WHERE authorname REGEXP '^[A-Za-z]'";
}
else
{
	$query = "select * from author where authorname like '$letter%'  union select * from author where authorname like '\"$letter%' union select * from author where authorname like '\'$letter%' order by TRIM(BOTH '\'' FROM TRIM(BOTH '\"' FROM authorname))";
}

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		echo '<div class="author">';
		echo '	<span class="aAuthor"><a href="auth.php?authid=' . $row['authid'] . '&amp;author=' . urlencode($row['authorname']) . '">' . $row['authorname'] . '</a> ';
		echo '</div>';
	}
}
else
{
	echo '<span class="sml">ಇಲ್ಲಿ \'' . $letter . '\' ಅಕ್ಷರದಿಂದ ಪ್ರಾರಂಭವಾಗುವ ಹೆಸರಿನ ಲೇಖಕರಿಲ್ಲ';
}

if($result){$result->free();}
$db->close();

?>
			</div> <!-- cd-container -->
		</div> <!-- cd-scrolling-bg -->
	</main> <!-- cd-main-content -->
<?php include("include_footer.php");?>
