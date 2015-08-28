<?PHP

// FILE INCLUDE VALIDATION
if (!$EmailAuth) { exit(); }
// -------------------------------------------------------------------------------------------------

if (isset($_SESSION['new_password_request'])) {
$password = $_SESSION['new_password_request'];

$con1 = "Below are your admin center login details.  Your password has been reset.";
$con2 = "You can change this password in your admin center by logging into your account and clicking on \"Manage Admins\".";
$con3 = "If you did not request this login information, please consider password protecting the /admin/ folder of your iDevAffiliate installation.  You can do this with .htaccess or in your web hosting control panel.  Consult your web hosting provider for further details.";

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
$content = nl2br($con1) . "<br />" . nl2br($con2) . "<br /><br />--------<br />Username: " . $username . "<br />Password: " . $_SESSION['new_password_request'] . "<br />--------<br /><br />Login Here:<br />" . $base_url . "/admin/setup.php<br /><br />" . nl2br($con3) . "<br /><br />--------<br />Message Auto-Sent By iDevAffiliate " . $version;
} else {
$mail->isHTML(false);
$content = nl2br($con1) . "\n" . nl2br($con2) . "\n\n--------\nUsername: " . $username . "\nPassword: " . $_SESSION['new_password_request'] . "\n--------\n\nLogin Here:\n" . $base_url . "/admin/setup.php\n\n" . nl2br($con3) . "\n\n--------\nMessage Auto-Sent By iDevAffiliate " . $version;
}



$mail->Subject = "iDevAffiliate Admin Center Login";
$mail->From = "$email";
$mail->FromName = "iDevAffiliate Mailbox";
$mail->AddAddress("$email","iDevAffiliate Mailbox");
if($cc_email == true) { $mail->AddCC("$cc_email_address","iDevAffiliate Mailbox"); }
$mail->Body = $content;

$mail->Send();
$mail->ClearAddresses();


unset($_SESSION['new_password_request']);

} else { echo "Exiting..."; }


?>