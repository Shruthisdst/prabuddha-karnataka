<?php
	exec('find ../ReadWrite/ -mmin +10 -type f -name "*.pdf" -exec rm {} \;');
	$downloadURL = '../index.php';
	$titleid = $_GET['titleid'];
	if(isset($_GET['titleid']) && $_GET['titleid'] != "")
	{
		include("connect.php");
		$vars = explode('_', $titleid);
		$volume = $vars[1];
		$part = $vars[2];
		$page_start = $vars[3];
		$page_end = $vars[4];
		$str = '';
		$page = $page_start . "_" . $page_end;
		$pdfList = '';
		$query1 = "select cur_page from testocr where volume = '$volume' and part = '$part' and cur_page between '$page_start' and '$page_end'";
		$result1 = $db->query($query1) or die("query problem"); 
		
		while($row = $result1->fetch_assoc())
		{
			$pdfList .= '../Volumes/pdf/' . $volume . '/' . $part . '/' . $row["cur_page"] . '.pdf ';
		}
		//~ $temp = '../ReadWrite/Shankara_Krupa_' . time() . '_' . rand(1,9999) . '.pdf'; 
		
		$downloadURL = '../ReadWrite/Tattvaloka_' . $volume . '_' . $part . '_' . $page . '.pdf';
		system ('pdftk ' . $pdfList . ' cat output ' . $downloadURL);
		//~ system ('pdfopt ' . $temp . ' ' . $downloadURL);
	}
	@header("Location: $downloadURL");
?>

