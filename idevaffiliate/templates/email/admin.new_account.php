<?PHP

// FILE INCLUDE VALIDATION
if (!$EmailAuth) { exit(); }
// -------------------------------------------------------------------------------------------------

// ----------------------------------------------------------
// SANITIZE AND ASSIGN THE VARIABLE
// ----------------------------------------------------------
   $username = check_type('username');
// ----------------------------------------------------------

$adata=mysql_query("select id, username, password, f_name, l_name, email from idevaff_affiliates where username = '$username'");
$indv_data=mysql_fetch_array($adata);
$id=$indv_data['id'];
$name=$indv_data['username'];
$pass=$indv_data['password'];
$fname=$indv_data['f_name'];
$lname=$indv_data['l_name'];
$e=$indv_data['email'];
// ------------------------------------------------
$edata=mysql_query("select admin_acct_subject, admin_acct_body from idevaff_email_english");
$indv_data=mysql_fetch_array($edata);
$sub=$indv_data['admin_acct_subject'];
$sub=preg_replace("/Sitename/",$sitename,$sub);
$con=$indv_data['admin_acct_body'];
$con=preg_replace("/Sitename/",$sitename,$con);
// ------------------------------------------------
$con = preg_replace("/_id_/", "$id", $con);
$con = preg_replace("/_username_/", "$name", $con);
$con = preg_replace("/_password_/", "$pass", $con);
$con = preg_replace("/_firstname_/", "$fname", $con);
$con = preg_replace("/_lastname_/", "$lname", $con);
$con = preg_replace("/_email_/", "$e", $con);
$con = preg_replace("/_webhome_/", "$siteurl", $con);
$con = preg_replace("/_affhome_/", "$base_url/index.php", $con);
$con = preg_replace("/_loginpage_/", "$base_url/login.php", $con);
$con = preg_replace("/_afftestimonials_/", "$base_url/testimonials.php", $con);

if ($link_style == 1) {
$con = preg_replace("/_afflink_/", "$base_url/$filename.php?id=$id", $con);
} elseif ($link_style == 2) {
$con = preg_replace("/_afflink_/", "$siteurl{$id}.html", $con); }

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
$mail->Body = $content;

$mail->Send();
$mail->ClearAddresses();

?>