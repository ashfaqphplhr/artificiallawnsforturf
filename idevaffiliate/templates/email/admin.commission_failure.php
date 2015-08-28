<?PHP

// FILE INCLUDE VALIDATION
if (!$EmailAuth) { exit(); }
// -------------------------------------------------------------------------------------------------

$edata=mysql_query("select admin_fail_subject, admin_fail_body from idevaff_email_english");
$indv_data=mysql_fetch_array($edata);
$sub=$indv_data['admin_fail_subject'];
$sub=preg_replace("/Sitename/",$sitename,$sub);
$con=$indv_data['admin_fail_body'];
$con=preg_replace("/Sitename/",$sitename,$con);

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
$content = nl2br($con) . "<br /><br />--------<br />Message Auto-Sent By iDevAffiliate " . $version;
} else {
$mail->isHTML(false);
$content = $con . "\n\n--------\nMessage Auto-Sent By iDevAffiliate " . $version;
}

$mail->Subject = "$sub";
$mail->From = "$address";
$mail->FromName = "iDevAffiliate Mailbox";
$mail->AddAddress("$address","iDevAffiliate Mailbox");
if($cc_email == true) { $mail->AddCC("$cc_email_address","iDevAffiliate Mailbox"); }
$mail->Body = "$content";

$mail->Send();
$mail->ClearAddresses();


?>