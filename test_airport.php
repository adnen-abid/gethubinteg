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

if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='192.168.0.229'|| $_SERVER['HTTP_HOST']=='192.168.0.17')
{
$con=mysql_connect('localhost','root','');
mysql_select_db('egspirit');
}
//else
//{
//$con=mysql_connect('localhost','provabte','ProTech%^&');
//mysql_select_db('provabte_triways');
//}
else
{
$con=mysql_connect('holiday2.db.10473537.hostedresource.com','holiday2','Holiday1@');
mysql_select_db('holiday2');
}

//$sql ="SELECT * FROM `flight_city_code` WHERE `airport_name` LIKE '%$input%'";
//$sql="SELECT airport_name FROM flight_city_code WHERE `airport_name` LIKE '$input%' GROUP BY airport_name ORDER BY airport_name ASC";
$sql="SELECT * FROM flight_city_code WHERE airport_name LIKE '%".$_GET['input']."%' OR airport_code LIKE '".$_GET['input']."%'";
$query=mysql_query($sql);

//echo $sql; exit;

$aUsers=array();

while($row=mysql_fetch_array($query))
{
//$city_name= explode('-',$row['airport_name']);
$city_name = $row['airport_name'];
	if(count($city_name)==1)
	{
		$aUsers[]=$city_name;
	}
}

//print_r($aUsers);
	
	$input = strtolower( $_GET['input'] );
	$len = strlen($input);
	
	
	$aResults = array();
	
	if ($len)
	{
		for ($i=0;$i<count($aUsers);$i++)
		{
			// had to use utf_decode, here
			// not necessary if the results are coming from mysql

			//if (strtolower(substr(utf8_decode($aUsers[$i]),0,$len)) == $input)
			//, "info"=>htmlspecialchars($aInfo[$i])
				$aResults[] = array( "id"=>($i+1) ,"value"=>stripslashes($aUsers[$i]) );
			

		}
	}
	
	
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
	header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header ("Pragma: no-cache"); // HTTP/1.0
	
	//print_r($aResults); exit;
	
	
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
