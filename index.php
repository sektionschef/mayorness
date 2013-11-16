<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Mayorness</title>
<meta name="copyright" content="">
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8">
<meta http-equiv="content-style-type" content="text/css">
<meta http-equiv="expires" content="0">
<link href="./files/design.css" rel="stylesheet" type="text/css"/>
</head>
<body>

//start

<pre>
<?php
// load credentials
require ("config/config.php");

//which venue is needed, what is the subdomain?
$urlParts = explode('.', $_SERVER['HTTP_HOST']);
// print subdomain
//echo $urlParts[0];

//venue from hand
//$subdomain = "ambuzzador";

//venue from subdomain
$subdomain = $urlParts[0];

if($subdomain == "ambuzzador")
   {
   $venue_id = $ambuzzador;
   } elseif($subdomain == "werkzeug") 
   {
   $venue_id = $werkzeug;   
	}
	elseif($subdomain == "eissalon") 
   {
   $venue_id = $eissalon;   
	}
	elseif($subdomain == "tofuchilli") 
   {
   $venue_id = $tofuchilli;   
	}
	elseif($subdomain == "mqwien") 
   {
   $venue_id = $mqwien;   
	}
	elseif($subdomain == "wintermq") 
   {
   $venue_id = $wintermq;   
	}

// curl
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, "https://api.foursquare.com/v2/venues/$venue_id?oauth_token=$oauth_token"); 
curl_setopt($ch, CURLOPT_HEADER, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$json = curl_exec($ch); 
curl_close($ch); 

$diggensack = json_decode($json, true);

// print json;
// print_r($diggensack);

// Abfrage nach Bild vom Mayor
//print_r($diggensack['venue']['stats']['mayor']['user']['photo']); 

?>
</pre>

<?php
// Thumbnail vom Mayor
// <img src="<?php print_r($diggensack['venue']['stats']['mayor']['user']['photo']); close_php " alt="Mayor" </img>

?>
<?php 

$curl_venue_name = $diggensack['response']['venue']['name'];
$curl_mayor_name = $diggensack['response']['venue']['mayor']['user']['firstName'];
$zeichenkette = $diggensack['response']['venue']['mayor']['user']['photo'];
$suchmuster = '/_thumbs/';
$ersetzung = '';

$nothumb = preg_replace($suchmuster, $ersetzung, $zeichenkette);
?>


<!-- This is the beef -->
<div id="floater">
	<div id="passe">
		<div id="image">
			<img id="mayor-image" src="<?php echo $nothumb; ?>" alt="Mayor">
		</div>
		<div id="label">
			<div id="first_line">
				<?php echo $curl_mayor_name;?><br />
			</div>
			<div id="second_line"><img src="./files/foursquare_logo.png" alt="foursquare logo" align="middle"> Mayor of <?php echo $curl_venue_name; ?>
			</div>
<!--			<img src="./files/label.png" alt="Our current foursquare Mayor">-->
		</div>
	</div>
</div>


</body>
</html>

