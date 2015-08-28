<?php /* Smarty version 2.6.14, created on 2013-08-21 09:10:44
         compiled from file:header.tpl */ ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->_tpl_vars['char_set']; ?>
">
<title><?php echo $this->_tpl_vars['sitename']; ?>
 - <?php echo $this->_tpl_vars['header_title']; ?>
</title>
<link rel="stylesheet" type="text/css" href="templates/style.css">
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="stylesheet" href="lightboxes/source/css/lightbox.css" type="text/css" />
<link rel="stylesheet" href="templates/greybox/css/gb_styles.css" type="text/css" media="all" />

<?php echo '

<script type="text/javascript" language="javascript1.2" src="lightboxes/source/js/prototype.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript1.2" src="lightboxes/source/js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" language="javascript1.2" src="lightboxes/source/js/lightbox.js" type="text/javascript"></script>

<script type="text/javascript" language="javascript1.2">
	var fileLoadingImage = "lightboxes/source/images/loading.gif";	
	var fileBottomNavCloseImage = "lightboxes/source/images/closelabel.gif";
</script>

<script type="text/javascript">var dmWorkPath = "templates/menus/";</script>
<script type="text/javascript" src="templates/menus/menu.js"></script>

<script type="text/javascript">
GB_myShow = function(caption, url, /* optional */ height, width, callback_fn) {
    var options = {
        caption: \'iDevAffiliate Video Training\',
        height: height || 520,
        width: width || 660,
	  center_win:true,
        fullscreen: false,
        show_loading: false,
        callback_fn: callback_fn
    }
    var win = new GB_Window(options);
    return win.show(url);
}
</script>

    <script type="text/javascript" language="javascript1.2">
        var GB_ROOT_DIR = "templates/greybox/";
    </script>

    <script type="text/javascript" language="javascript1.2" src="templates/greybox/AJS.js"></script>
    <script type="text/javascript" language="javascript1.2" src="templates/greybox/AJS_fx.js"></script>
    <script type="text/javascript" language="javascript1.2" src="templates/greybox/gb_scripts.js"></script>

<script language="JavaScript" type="text/javascript">
function textCounter(field,cntfield,maxlimit) {
if (field.value.length > maxlimit)
field.value = field.value.substring(0, maxlimit);
else
cntfield.value = maxlimit - field.value.length; }
</script>
'; ?>


</head>
<body bgcolor="<?php echo $this->_tpl_vars['page_back']; ?>
" background="<?php echo $this->_tpl_vars['page_bkg_image']; ?>
">


<table align="<?php echo $this->_tpl_vars['page_align']; ?>
" border="0" cellpadding="4" cellspacing="0" width="<?php echo $this->_tpl_vars['panel_width'];  echo $this->_tpl_vars['joinperc']; ?>
">
<form method="POST" action="<?php echo $this->_tpl_vars['localserver']; ?>
">
<tr>
<td width="100%"><img border="0" src="<?php echo $this->_tpl_vars['main_logo']; ?>
" alt="<?php echo $this->_tpl_vars['sitename']; ?>
 - <?php echo $this->_tpl_vars['header_title']; ?>
"></td>
</tr>
</table>

<table align="<?php echo $this->_tpl_vars['page_align']; ?>
" border="0" cellpadding="4" cellspacing="0" width="<?php echo $this->_tpl_vars['panel_width'];  echo $this->_tpl_vars['joinperc']; ?>
">


<tr>

<td width="60%" class="nomargins" bgcolor="<?php echo $this->_tpl_vars['cp_head_back']; ?>
"><a href="index.php"><font color="<?php echo $this->_tpl_vars['top_bot_links']; ?>
"><b><?php echo $this->_tpl_vars['header_indexLink']; ?>
</b></font></a><font color="<?php echo $this->_tpl_vars['top_bot_links']; ?>
"> :: </font><a href="signup.php"><font color="<?php echo $this->_tpl_vars['top_bot_links']; ?>
"><b><?php echo $this->_tpl_vars['header_signupLink']; ?>
</b></font></a><font color="<?php echo $this->_tpl_vars['top_bot_links']; ?>
"> :: </font><a href="account.php"><font color="<?php echo $this->_tpl_vars['top_bot_links']; ?>
"><b><?php echo $this->_tpl_vars['header_accountLink']; ?>
</b></font></a><font color="<?php echo $this->_tpl_vars['top_bot_links']; ?>
"> :: </font><a href="contact.php"><font color="<?php echo $this->_tpl_vars['top_bot_links']; ?>
"><b><?php echo $this->_tpl_vars['header_emailLink']; ?>
</b></font></a><?php if (isset ( $this->_tpl_vars['use_faq'] ) && ( $this->_tpl_vars['faq_location'] == 1 )): ?><font color="<?php echo $this->_tpl_vars['top_bot_links']; ?>
"> :: </font><a href="faq.php"><font color="<?php echo $this->_tpl_vars['top_bot_links']; ?>
"><b>FAQ</b></font></a><?php endif;  if (isset ( $this->_tpl_vars['testimonials'] ) && ( isset ( $this->_tpl_vars['testimonials_active'] ) )): ?><font color="<?php echo $this->_tpl_vars['top_bot_links']; ?>
"> :: </font><a href="testimonials.php"><font color="<?php echo $this->_tpl_vars['top_bot_links']; ?>
"><b><?php echo $this->_tpl_vars['header_testimonials']; ?>
</b></font></a><?php endif; ?></td>
<td width="25%" class="nomargins" bgcolor="<?php echo $this->_tpl_vars['cp_head_back']; ?>
"><b><font color="<?php echo $this->_tpl_vars['top_bot_text']; ?>
"><?php echo $this->_tpl_vars['header_greeting']; ?>
, <?php if (isset ( $this->_tpl_vars['affiliateUsername'] )):  echo $this->_tpl_vars['affiliateUsername']; ?>
 - </font></b><a href="logout.php"><font color="<?php echo $this->_tpl_vars['alt_links']; ?>
"><b><?php echo $this->_tpl_vars['header_logout']; ?>
</b></font></a><?php else:  echo $this->_tpl_vars['header_nonLogged']; ?>
!</font></b><?php endif; ?></td>
<td width="15%" class="nomargins" bgcolor="<?php echo $this->_tpl_vars['cp_head_back']; ?>
" align="right">
<select size="1" name="idev_language" onchange='this.form.submit()'>
<?php 
$get_lang_packs = mysql_query("select name from idevaff_language_packs where status = '1' ORDER BY name");
if (mysql_num_rows($get_lang_packs)) {
while ($pack = mysql_fetch_array($get_lang_packs)) {
$pack_value = $pack[name];
$pack_name = ucwords($pack[name]);
echo "<option value='$pack_value'";
if ($_SESSION['idev_language'] == $pack_value) {
echo " selected"; }
echo ">$pack_name</option>\n"; } }
 ?></select></td></form>

</tr>

</table>

