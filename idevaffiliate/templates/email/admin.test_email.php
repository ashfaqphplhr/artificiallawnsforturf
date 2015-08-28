<?PHP

// FILE INCLUDE VALIDATION
if (!$EmailAuth) { exit(); }
// -------------------------------------------------------------------------------------------------

include_once($path . "/templates/email/class.phpmailer.php");
include_once($path . "/templates/email/class.smtp.php");
$mail = new PHPMailer();

if ($email_smtp_delivery == true) {
$mail->IsSMTP();
$mail->SMTPAuth = $smtp_auth;
$mail->SMTPSecure = "$smtp_security";
$mail->Host = "$smtp_host";
$mail->Port = $smtp_port;
$mail->Username = "$smtp_user";
$mail->Password = "$smtp_pass"; }
$mail->CharSet = "$smtp_char_set";

if ($email_html_delivery == true) {
$mail->isHTML(true);
$sendBody = "Dear Admin,<br /><br />If you're reading this email, your email settings are correct.<br /><br />" . nl2br($signature);
} else {
$mail->isHTML(false);
$sendBody = "Dear Admin,\n\nIf you're reading this email, your email settings are correct.\n\n$signature";
}

$mail->Subject = "iDevAffiliate Test Email";
$mail->From = "$address";
$mail->FromName = $from_name;
$mail->AddAddress("$address","iDevAffiliate Admin");
if($cc_email == true) { $mail->AddCC("$cc_email_address","iDevAffiliate Admin"); }
$mail->Body = $sendBody;

$mail->Send();
$mail->ClearAddresses();

?>