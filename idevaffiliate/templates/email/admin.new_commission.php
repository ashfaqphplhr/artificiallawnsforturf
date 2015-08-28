<?PHP

// FILE INCLUDE VALIDATION
if (!$EmailAuth) { exit(); }
// -------------------------------------------------------------------------------------------------

$adata=mysql_query("select id, username, password, f_name, l_name, email from idevaff_affiliates where id = '$idev'");
$indv_data=mysql_fetch_array($adata);
$id=$indv_data['id'];
$name=$indv_data['username'];
$pass=$indv_data['password'];
$fname=$indv_data['f_name'];
$lname=$indv_data['l_name'];
$e=$indv_data['email'];

$edata=mysql_query("select admin_sale_subject, admin_sale_body from idevaff_email_english");
$indv_data=mysql_fetch_array($edata);
$sub=$indv_data['admin_sale_subject'];
$sub=preg_replace("/Sitename/",$sitename,$sub);
$con=$indv_data['admin_sale_body'];
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


$getname=mysql_query("select username from idevaff_affiliates where id = '$idev'");
$name=mysql_fetch_array($getname);
$uname=$name['username'];

// ADD TIER DATA
function GetTierUsername($value) {
$tier_username = mysql_query("select username from idevaff_affiliates where id = '$value'");
$tier_username = mysql_fetch_array($tier_username);
return $tier_username['username']; }
if ($email_html_delivery == true) { $new_line = "<br />"; }
if ($email_html_delivery == false) { $new_line = "\n"; }
$tier_add = null;
if (isset($t1_account)) { $tier_add .= "Tier Affiliate 1: " . GetTierUsername($texist) . $new_line; }
if (isset($t2_account)) { $tier_add .= "Tier Affiliate 2: " . GetTierUsername($idev_tier_2) . $new_line; }
if (isset($t3_account)) { $tier_add .= "Tier Affiliate 3: " . GetTierUsername($idev_tier_3) . $new_line; }
if (isset($t4_account)) { $tier_add .= "Tier Affiliate 4: " . GetTierUsername($idev_tier_4) . $new_line; }
if (isset($t5_account)) { $tier_add .= "Tier Affiliate 5: " . GetTierUsername($idev_tier_5) . $new_line; }
if (isset($t6_account)) { $tier_add .= "Tier Affiliate 6: " . GetTierUsername($idev_tier_6) . $new_line; }
if (isset($t7_account)) { $tier_add .= "Tier Affiliate 7: " . GetTierUsername($idev_tier_7) . $new_line; }
if (isset($t8_account)) { $tier_add .= "Tier Affiliate 8: " . GetTierUsername($idev_tier_8) . $new_line; }
if (isset($t9_account)) { $tier_add .= "Tier Affiliate 9: " . GetTierUsername($idev_tier_9) . $new_line; }
if (isset($t10_account)) { $tier_add .= "Tier Affiliate 10: " . GetTierUsername($idev_tier_10) . $new_line; }

// ADD OVERRIDE DATA







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
$content = nl2br($con) . "<br /><br />Affiliate: " . $uname . "<br />" . $tier_add . "<br /><br />--------<br />Message Auto-Sent By iDevAffiliate " . $version;
} else {
$mail->isHTML(false);
$content = $con . "\n\nAffiliate: " . $uname . "\n" . $tier_add . "\n\n--------\nMessage Auto-Sent By iDevAffiliate " . $version;
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