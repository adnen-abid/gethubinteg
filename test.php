<?php

/*
note:
this is just a static test version using a hard-coded countries array.
normally you would be populating the array out of a database

the returned xml has the following structure
<results>
	<rs>foo</rs>
	<rs>bar</rs>
</results>
*/
$input = strtolower( $_GET['input'] );

if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='192.168.0.229')
{
$con=mysql_connect('localhost','root','');
mysql_select_db('travel_discount');
}
//else
//{
//$con=mysql_connect('localhost','provabte','ProTech%^&');
//mysql_select_db('provabte_triways');
//}
else
{
$con=mysql_connect('localhost','traveldb_disc','disc!@#$%^');
mysql_select_db('traveldb_discount');
}

//$sql="select * from gta_city_code where `cityName` Like '$input%' group by cityName order by cityName ASC";
//$sql="select * from hotel_city where `City` Like '$input%' order by City ASC";
$sql="SELECT DISTINCT cityName FROM gta_city_code WHERE `cityName` LIKE '$input%' GROUP BY cityName ORDER BY cityName ASC";
$query=mysql_query($sql);

$aUsers=array();

while($row=mysql_fetch_array($query))
{
$city_name= explode('-',$row['cityName']);
	if(count($city_name)==1)
	{
		$aUsers[]=$row['cityName'];
	}
}

	
	$input = strtolower( $_GET['input'] );
	$len = strlen($input);
	
	
	$aResults = array();
	
	if ($len)
	{
		for ($i=0;$i<count($aUsers);$i++)
		{
			// had to use utf_decode, here
			// not necessary if the results are coming from mysql

			if (strtolower(substr(utf8_decode($aUsers[$i]),0,$len)) == $input)
				$aResults[] = array( "id"=>($i+1) ,"value"=>stripslashes($aUsers[$i]), "info"=>htmlspecialchars($aInfo[$i]) );
			

		}
	}
	
	
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
	header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header ("Pragma: no-cache"); // HTTP/1.0
	
	
	
	if (isset($_REQUEST['json']))
	{
		header("Content-Type: application/json");
	
		echo "{\"results\": [";
		$arr = array();
		for ($i=0;$i<count($aResults);$i++)
		{
			$arr[] = "{\"id\": \"".$aResults[$i]['id']."\", \"value\": \"".$aResults[$i]['value']."\", \"info\": \"\"}";
		}
		echo implode(", ", $arr);
		echo "]}";
	}

?>
