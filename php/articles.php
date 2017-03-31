<?php include("include_header.php");?>
<main class="cd-main-content">
		<div class="cd-scrolling-bg cd-color-2">
			<div class="cd-container">
				<h1 class="clr1">ಲೇಖನಗಳು</h1>
 				<div class="alphabet gapBelowSmall gapAboveSmall">
					<span class="letter"><a href="articles.php?letter=ಅ">ಅ</a></span>
					<span class="letter"><a href="articles.php?letter=ಆ">ಆ</a></span>
					<span class="letter"><a href="articles.php?letter=ಇ">ಇ</a></span>
					<span class="letter"><a href="articles.php?letter=ಈ">ಈ</a></span>
					<span class="letter"><a href="articles.php?letter=ಉ">ಉ</a></span>
					<span class="letter"><a href="articles.php?letter=ಊ">ಊ</a></span>
					<span class="letter"><a href="articles.php?letter=ಋ">ಋ</a></span>
					<span class="letter"><a href="articles.php?letter=ಎ">ಎ</a></span>
					<span class="letter"><a href="articles.php?letter=ಏ">ಏ</a></span>
					<span class="letter"><a href="articles.php?letter=ಐ">ಐ</a></span>
					<span class="letter"><a href="articles.php?letter=ಒ">ಒ</a></span>
					<span class="letter"><a href="articles.php?letter=ಓ">ಓ</a></span>
					<span class="letter"><a href="articles.php?letter=ಔ">ಔ</a></span>
					<span class="letter"><a href="articles.php?letter=ಕ">ಕ</a></span>
					<span class="letter"><a href="articles.php?letter=ಖ">ಖ</a></span>
					<span class="letter"><a href="articles.php?letter=ಗ">ಗ</a></span>
					<span class="letter"><a href="articles.php?letter=ಘ">ಘ</a></span>
					<span class="letter"><a href="articles.php?letter=ಚ">ಚ</a></span>
					<span class="letter"><a href="articles.php?letter=ಛ">ಛ</a></span>
					<span class="letter"><a href="articles.php?letter=ಜ">ಜ</a></span>
					<span class="letter"><a href="articles.php?letter=ಝ">ಝ</a></span>
					<span class="letter"><a href="articles.php?letter=ಟ">ಟ</a></span>
					<span class="letter"><a href="articles.php?letter=ಠ">ಠ</a></span>
					<span class="letter"><a href="articles.php?letter=ಡ">ಡ</a></span>
					<span class="letter"><a href="articles.php?letter=ಢ">ಢ</a></span>
					<span class="letter"><a href="articles.php?letter=ತ">ತ</a></span>
					<span class="letter"><a href="articles.php?letter=ಥ">ಥ</a></span>
					<span class="letter"><a href="articles.php?letter=ದ">ದ</a></span>
					<span class="letter"><a href="articles.php?letter=ಧ">ಧ</a></span>
					<span class="letter"><a href="articles.php?letter=ನ">ನ</a></span>
					<span class="letter"><a href="articles.php?letter=ಪ">ಪ</a></span>
					<span class="letter"><a href="articles.php?letter=ಫ">ಫ</a></span>
					<span class="letter"><a href="articles.php?letter=ಬ">ಬ</a></span>
					<span class="letter"><a href="articles.php?letter=ಭ">ಭ</a></span>
					<span class="letter"><a href="articles.php?letter=ಮ">ಮ</a></span>
					<span class="letter"><a href="articles.php?letter=ಯ">ಯ</a></span>
					<span class="letter"><a href="articles.php?letter=ರ">ರ</a></span>
					<span class="letter"><a href="articles.php?letter=ಲ">ಲ</a></span>
					<span class="letter"><a href="articles.php?letter=ವ">ವ</a></span>
					<span class="letter"><a href="articles.php?letter=ಶ">ಶ</a></span>
					<span class="letter"><a href="articles.php?letter=ಷ">ಷ</a></span>
					<span class="letter"><a href="articles.php?letter=ಸ">ಸ</a></span>
					<span class="letter"><a href="articles.php?letter=ಹ">ಹ</a></span>
					<span class="letter"><a href="articles.php?letter=ಳ">ಳ</a></span>
					<span class="letter"><a href="articles.php?letter=other">#</a></span>
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
	$query = "SELECT * FROM article WHERE title REGEXP '^[A-Za-z]'";
}
else
{
	$query = "select * from article where title like '$letter%'  union select * from article where title like '`$letter%' union select * from article where title like '``$letter%' union select * from article where title like '\'$letter%' order by TRIM(BOTH '\'' FROM TRIM(BOTH '``' FROM TRIM(BOTH '' FROM title)))";
}

//$query = "SELECT * FROM article ORDER BY TRIM(BEGIN '\"' FROM title)";
//$query = "SELECT * FROM article ORDER BY TRIM(BOTH '\'' FROM TRIM(BOTH '\"' FROM title))";


$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		$query3 = 'select feat_name from feature where featid=\'' . $row['featid'] . '\'';
		$result3 = $db->query($query3); 
		$row3 = $result3->fetch_assoc();
		$titleid = $row['titleid'];
		$dpart = preg_replace("/^0/", "", $row['part']);
		$dpart = preg_replace("/\-0/", "-", $dpart);
		$info = '';
		if($row['month'] != '')
		{
			$info = $info . getMonth($row['month']);
		}
		if($row['year'] != '')
		{
			$info = $info . ' <span class="font_size">' . toKannada(intval($row['year'])) . '</span>';
		}
		if($row['info'] != '')
		{
			$info = $info . ', ' . $row['info'];
		}
		
		$info = preg_replace("/^,/", "", $info);
		$info = preg_replace("/^ /", "", $info);
		
		$sumne = preg_split('/-/' , $row['page']);
		$row['page'] = $sumne[0];
		if($result3){$result3->free();}

		echo '<div class="article">';
		echo '<div class="gapBelowSmall">';
		echo ($row3['feat_name'] != '') ? '		<span class="aFeature clr2"><a href="feat.php?feature=' . urlencode($row3['feat_name']) . '&amp;featid=' . $row['featid'] . '">' . $row3['feat_name'] . '</a></span> | ' : '';
		echo '<span class="aIssue clr5"><a href="toc.php?vol=' . $row['volume'] . '&amp;part=' . $row['part'] . '">ಸಂಪುಟ ' . toKannada(intval($row['volume'])) . ', ಸಂಚಿಕೆ ' . toKannada($dpart);
		if($info != '')
		{
			echo ' <span class="font_resize">(' . $info . ')</span></a></span>';
		}
		else
		{
			echo ' </a></span>';
		}
		echo '</div>';
		//~ echo '	<span class="aTitle"><a target="_blank" href="bookReader.php?volume=' . $row['volume'] . '&amp;part=' . $row['part'] . '&amp;page=' . $row['page'] . '">' . $row['title'] . '</a></span>';
		//~ DJVU link
		echo '	<span class="aTitle"><a target="_blank" href="../Volumes/djvu/' . $row['volume'] . '/' . $row['part'] . '/index.djvu?djvuopts&amp;page=' . $row['page'] . '.djvu&amp;zoom=page">' . $row['title'] . '</a></span>';
		if($row['authid'] != 0) {

			echo '<br /><span class="aAuthor">&nbsp;&nbsp;&mdash;';
			$authids = preg_split('/;/',$row['authid']);
			$authornames = preg_split('/;/',$row['authorname']);
			$a=0;
			foreach ($authids as $aid) {

				echo '<a class="delim" href="auth.php?authid=' . $aid . '&amp;author=' . urlencode($authornames[$a]) . '">' . $authornames[$a] . '</a> ';
				$a++;
			}
			
			echo '	</span>';
		}
		echo '<br/><span class="downloadspan"><a target="_blank" href="downloadPdf.php?titleid='.$titleid.'">ಡೌನ್ಲೋಡ್ ಪಿಡಿಎಫ್</a></span>';
		echo '</div>';
	}
}
else
{
	echo '<span class="sml">ಇಲ್ಲಿ \'' . $letter . '\' ಅಕ್ಷರದಿಂದ ಪ್ರಾರಂಭವಾಗುವ ಲೇಖನಗಳಿಲ್ಲ';
}

if($result){$result->free();}
$db->close();

?>
			</div> <!-- cd-container -->
		</div> <!-- cd-scrolling-bg -->
	</main> <!-- cd-main-content -->
<?php include("include_footer.php");?>
