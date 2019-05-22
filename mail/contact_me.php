<?php
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['lastname'])  ||
   empty($_POST['email']) 		||
   empty($_POST['topic']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }

   function getUserIP(){
       $clientIp  = @$_SERVER['HTTP_CLIENT_IP'];
       $forwardIp = @$_SERVER['HTTP_X_FORWARDED_FOR'];
       $remoteIp  = $_SERVER['REMOTE_ADDR'];

       if(filter_var($clientIp, FILTER_VALIDATE_IP))
       {
           $ip = $clientIp;
       }
       elseif(filter_var($forwardIp, FILTER_VALIDATE_IP))
       {
           $ip = $forwardIp;
       }
       else
       {
           $ip = $remoteIp;
       }

       return $ip;
   }

$name = strip_tags(htmlspecialchars($_POST['name']));
$lastname = strip_tags(htmlspecialchars($_POST['lastname']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$topic = strip_tags(htmlspecialchars($_POST['topic']));
$message = strip_tags(htmlspecialchars($_POST['message']));
$uip = getUserIP();

// Create the email and send the message
$to = 'kontakt@kvsky.pl'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Nowa wiadomosc od kvsky.pl:  $name";
$email_body = "Nowa wiadomosc od kvsky.pl!\n\n"."Imie: $name\n\nNazwisko: $lastname\n\nEmail: $email_address\n\nIP: $uip\n\nTemat: $topic\n\nWiadomosc:\n$message";
$headers = "From: kontakt@kvsky.pl\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";
mail($to,$email_subject,$email_body,$headers);
return true;
?>
