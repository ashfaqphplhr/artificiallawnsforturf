<?PHP

// FILE INCLUDE VALIDATION
if (!$EmailAuth) { exit(); }
// -------------------------------------------------------------------------------------------------

// ------------------------------------------------
$adata=mysql_query("select id, username, password, f_name, l_name, email, email_override from idevaff_affiliates where id = '$id'");
$indv_data=mysql_fetch_array($adata);
$id=$indv_data['id'];
$name=$indv_data['username'];
$pass=$indv_data['password'];
$fname=$indv_data['f_name'];
$lname=$indv_data['l_name'];
$e=$indv_data['email'];
$email_override=$indv_data['email_override'];
if ($email_override) { $email_table_extension = $email_override; }
// ------------------------------------------------
$edata=mysql_query("select comm_subject, comm_body from idevaff_email_$email_table_extension");
$indv_data=mysql_fetch_array($edata);
$sub=$indv_data['comm_subject'];
$sub=preg_replace("/Sitename/",$sitename,$sub);
$con=$indv_data['comm_body'];
$con=preg_replace("/Sitename/",$sitename,$con);
// ------------------------------------------------
$con = preg_replace("/_id_/", "$id", $con);
$con = preg_replace("/_username_/", "$name", $con);
$con = preg_replace("/_password_/", "N/A", $con);
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
// ------------------------------------------------

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
$mail->Password = "$smtp_pass";

// ----------------------------------------------------------
// CHECK FOR EMAIL ATTACHMENT
// ----------------------------------------------------------
$get_attachment = mysql_query("select template_id, filename from idevaff_email_attachments where template_id = '5' and enabled = '1'");
if (mysql_num_rows($get_attachment)) {
$attachment_data = mysql_fetch_array($get_attachment);
$attachment_filename = $attachment_data['filename'];
if (file_exists($path . "/docs/" . $attachment_filename)) {
$mail->AddAttachment($path . "/docs/" . $attachment_filename, $attachment_filename); } }
// ----------------------------------------------------------

}
$mail->CharSet = "$smtp_char_set";

if ($email_html_delivery == true) {
$mail->isHTML(true);
$content = nl2br($con) . "<br /><br />" . nl2br($signature);
} else {
$mail->isHTML(false);
$content = $con . "\n\n" . $signature;
}

$mail->Subject = "$sub";
$mail->From = "$address";
$mail->FromName = "$from_name";
$mail->AddAddress("$e","$name");
$mail->Body = $content;

$mail->Send();
$mail->ClearAddresses();

?>