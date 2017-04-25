	<?php
	require '../PHPMailerAutoload.php';
	//SMTP needs accurate times, and the PHP time zone MUST be set
	//This should be done in your php.ini, but this is how to do it if you don't have access to that
	date_default_timezone_set('Etc/UTC');

	// require '../PHPMailer/PHPMailerAutoload.php';

	//Create a new PHPMailer instance
	$mail = new PHPMailer();

	//Tell PHPMailer to use SMTP
	$mail -> isSMTP();

	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail -> SMTPDebug = 2;

	//Ask for HTML-friendly debug output
	$mail -> Debugoutput = 'html';

	//Set the hostname of the mail server
	$mail -> Host = 'smtp.gmail.com';

	//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
	$mail -> Port = 587;

	//Set the encryption system to use - ssl (deprecated) or tls
	$mail -> SMTPSecure = 'tls';

	//Whether to use SMTP authentication
	$mail -> SMTPAuth = true;

	//Username to use for SMTP authentication - use full email address for gmail
	$mail -> Username = "useraccount@nalosolutions.com";

	//Password to use for SMTP authentication
	$mail -> Password = "nalosol1234";

	//Set who the message is to be sent from
	$mail -> setFrom('sbentil@nalosolutions.com', 'sbentil@nalosolutions.com');

	//Set an alternative reply-to address
	$mail -> addReplyTo('sbentil@nalosolutions.com', 'sbentil@nalosolutions.com');

	$mail -> AddCC($cc, $cc);

	$mail -> AddCC('noc@nalosolutions.com', 'NALO NOC');

	//Set who the message is to be sent to
	$mail -> addAddress('sbentil@nalosolutions.com', 'sbentil@nalosolutions.com');

	//Set the subject line
	$mail -> Subject = 'test mail';

	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	// $mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

	$mail -> Body = 'hello this is a test';

	//Replace the plain text body with one created manually
	$mail -> AltBody = 'hello this is a test';

	//Attach an image file
	// $mail->addAttachment('logo_teksol.png');

	//send the message, check for errors
	if (!$mail -> send()) {
		"Mailer Error: " . $mail -> ErrorInfo;
	} else {
		"Message sent!";
	}

?>