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

$edata=mysql_query("select admin_max_comm_exceeded_sub, admin_max_comm_exceeded_body from idevaff_email_english");
$indv_data=mysql_fetch_array($edata);
$sub=$indv_data['admin_max_comm_exceeded_sub'];
$sub=preg_replace("/Sitename/",$sitename,$sub);
$con=$indv_data['admin_max_comm_exceeded_body'];
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

$avar_email=number_format($avar,$decimal_symbols);
if($cur_sym_location == 1) { $avar_email = $cur_sym . $avar_email; }
if($cur_sym_location == 2) { $avar_email = $avar_email . " " . $cur_sym; }
$avar_email = $avar_email . " " . $currency;

$payout_email=number_format($payout,$decimal_symbols);
if($cur_sym_location == 1) { $payout_email = $cur_sym . $payout_email; }
if($cur_sym_location == 2) { $payout_email = $payout_email . " " . $cur_sym; }
$payout_email = $payout_email . " " . $currency;

$max_comm_amt_email=number_format($max_comm_amt,$decimal_symbols);
if($cur_sym_location == 1) { $max_comm_amt_email = $cur_sym . $max_comm_amt_email; }
if($cur_sym_location == 2) { $max_comm_amt_email = $max_comm_amt_email . " " . $cur_sym; }
$max_comm_amt_email = $max_comm_amt_email . " " . $currency;

$exceeded_amt = $payout - $max_comm_amt;
$exceeded_amt=number_format($exceeded_amt,$decimal_symbols);
if($cur_sym_location == 1) { $exceeded_amt = $cur_sym . $exceeded_amt; }
if($cur_sym_location == 2) { $exceeded_amt = $exceeded_amt . " " . $cur_sym; }
$exceeded_amt = $exceeded_amt . " " . $currency;

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
$content = nl2br($con) . "<br />------------------------------------------------<br />Affiliate: " . $name . "<br />Affiliate Email: " . $e . "<br />Order Number: " . $idev_ordernum . "<br />Customer IP: " . $ip_addr . "<br />Sale Amount: " . $avar_email . "<br />Commission Amount: " . $payout_email . "<br />------------------------------------------------<br />Max Commission Amount Allowed: " . $max_comm_amt_email . "<br />Commission Amount Exceeded By: " . $exceeded_amt . "<br /><br />--------<br />Message Auto-Sent By iDevAffiliate " . $version;
} else {
$mail->isHTML(false);
$content = $con . "\n------------------------------------------------\nAffiliate: " . $name . "\nAffiliate Email: " . $e . "\nOrder Number: " . $idev_ordernum . "\nCustomer IP: " . $ip_addr . "\nSale Amount: " . $avar_email . "\nCommission Amount: " . $payout_email . "\n------------------------------------------------\nMax Commission Amount Allowed: " . $max_comm_amt_email . "\n\nCommission Amount Exceeded By: " . $exceeded_amt . "\n\n--------\nMessage Auto-Sent By iDevAffiliate " . $version;
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