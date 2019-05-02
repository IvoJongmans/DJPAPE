<?php
/*
This first bit sets the email address that you want the form to be submitted to.
You will need to change this value to a valid email address that you can access.
*/
$webmaster_email = "info@djpape.nl";

/*
This bit sets the URLs of the supporting pages.
If you change the names of any of the pages, you will need to change the values here.
*/
$feedback_page = "boekons.html";
$error_page = "error_message.html";
$thankyou_page = "boeking_succes.html";

/*
This next bit loads the form field data into variables.
If you add a form field, you will need to add it here.
*/



$artistlist = array();

foreach($_POST['artist_list'] as $artist) {
	$artistlist[] = $artist;
   }
   
$artistlist_implode = implode("\n", $artistlist);
   

$naam = $_REQUEST['naam'] ;
$email_address = $_REQUEST['email'] ;
$straat = $_REQUEST['straat'] ; 
$huisnummer = $_REQUEST['huisnummer'] ;
$postcode = $_REQUEST['postcode'] ;
$plaats = $_REQUEST['plaats'] ;
$telefoon = $_REQUEST['telefoon'] ;
$personen_locatie = $_REQUEST['personen_locatie'] ;
$soort_locatie = $_REQUEST['soort_locatie'] ;
$locatie_locatie = $_REQUEST['locatie_locatie'] ;
$apparatuur = $_POST['apparatuur'];
$extra_apparatuur = $_REQUEST['extra_apparatuur'];
$perfecte_avond = $_REQUEST['perfecte_avond'];
$gewenste_muziek = $_REQUEST['gewenste_muziek'];
$ongewenste_muziek = $_REQUEST['ongewenste_muziek'];
$openingsnummer = $_REQUEST['openingsnummer'];
$aansluitingen = $_REQUEST['aansluitingen'];
$nummer1 = $_REQUEST['nummer1'];
$nummer2 = $_REQUEST['nummer2'];
$nummer3 = $_REQUEST['nummer3'];
$nummer4 = $_REQUEST['nummer4'];
$nummer5 = $_REQUEST['nummer5'];
$nummer6 = $_REQUEST['nummer6'];
$nummer7 = $_REQUEST['nummer7'];
$nummer8 = $_REQUEST['nummer8'];
$nummer9 = $_REQUEST['nummer9'];
$nummer10 = $_REQUEST['nummer10'];


  
    


$msg = 
"Persoonsgegevens" .  "\r\n" .
"Naam: " . $naam . "\r\n" . 
"Email: " . $email_address . "\r\n" . 
"Straat: " . $straat . "\r\n" .
"Huisnummer: " . $huisnummer .  "\r\n" .
"Postcode: " . $postcode .  "\r\n" .
"Plaats: " . $plaats .  "\r\n" . 
"Telefoon: " . $telefoon .  "\r\n" . 
"Aantal personen: " . $personen_locatie .  "\r\n" . 
"Feestsoort: " . $soort_locatie .  "\r\n" . 
"Locatie Feest: " . $locatie_locatie .  "\r\n" . 
"Artiesten:" . "\r\n" . 
$artistlist_implode . "\r\n" . 
"Apparatuur: " . $apparatuur . "\r\n" .
"Extra apparatuur: " . $extra_apparatuur . "\r\n" . 
"Perfecte avond: " . $perfecte_avond . "\r\n" . 
"Gewenste muziek: " . $gewenste_muziek . "\r\n" . 
"Ongewenste muziek: " . $ongewenste_muziek . "\r\n" . 
"Openingsnummer: " . $openingsnummer . "\r\n" . 
"Extra info muziek: " . $aansluitingen . "\r\n" . 
"Top 10: " . "\r\n" .
"1.:" . $nummer1 . "\r\n" .
"2.:" . $nummer2 . "\r\n" .
"3.:" . $nummer3 . "\r\n" .
"4.:" . $nummer4 . "\r\n" .
"5.:" . $nummer5 . "\r\n" .
"6.:" . $nummer6 . "\r\n" .
"7.:" . $nummer7 . "\r\n" .
"8.:" . $nummer8 . "\r\n" .
"9.:" . $nummer9 . "\r\n" .
"10.:" . $nummer10;




/*
The following function checks for email injection.
Specifically, it checks for carriage returns - typically used by spammers to inject a CC list.
*/
function isInjected($str) {
	$injections = array('(\n+)',
	'(\r+)',
	'(\t+)',
	'(%0A+)',
	'(%0D+)',
	'(%08+)',
	'(%09+)'
	);
	$inject = join('|', $injections);
	$inject = "/$inject/i";
	if(preg_match($inject,$str)) {
		return true;
	}
	else {
		return false;
	}
}

// If the user tries to access this script directly, redirect them to the feedback form,
if (!isset($_REQUEST['email'])) {
header( "Location: $feedback_page" );
}

// If the form fields are empty, redirect to the error page.
elseif (empty($naam) || empty($email_address)) {
header( "Location: $error_page" );
}

/* 
If email injection is detected, redirect to the error page.
If you add a form field, you should add it here.
*/
elseif ( isInjected($email_address) || isInjected($naam) ) {
header( "Location: $error_page" );
}

// If we passed all previous tests, send the email then redirect to the thank you page.
else {

	mail( "$webmaster_email", "Boekingsaanvraag", $msg );

	header( "Location: $thankyou_page" );
}
?>