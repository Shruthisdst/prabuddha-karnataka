#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$sth11=$dbh->prepare("drop table if exists testocr");;
$sth11->execute();
$sth11->finish();

$sth11=$dbh->prepare("CREATE TABLE testocr(volume varchar(3),
part varchar(6),
cur_page varchar(10),
text varchar(5000)) ENGINE=MyISAM");

$sth11->execute();
$sth11->finish(); 
@volumes = `ls Text`;

for($i1=0;$i1<@volumes;$i1++)
{
	print $volumes[$i1];
	chop($volumes[$i1]);
	
	@part = `ls Text/$volumes[$i1]/`;

	for($i2=0;$i2<@part;$i2++)
	{
		chop($part[$i2]);

		@files = `ls Text/$volumes[$i1]/$part[$i2]/`;
		
		for($i3=0;$i3<@files;$i3++)
		{
			chop($files[$i3]);
			if($files[$i3] =~ /\.txt/)
			{
				$vol = $volumes[$i1];
				$prt = $part[$i2];
				$cur_page = $files[$i3];
				
				open(DATA,"Text/$vol/$prt/$cur_page")or die ("cannot open Text/$vol/$prt/$cur_page");
				
				$cur_page =~ s/\.txt//g;
				
				$line=<DATA>;
				$line =~ s/'/\\'/g;
				
				$sth1=$dbh->prepare("insert into testocr values ('$vol','$prt','$cur_page','$line')");
				$sth1->execute();
				$sth1->finish();
				
				close(DATA);
			}
		}
	}
}
