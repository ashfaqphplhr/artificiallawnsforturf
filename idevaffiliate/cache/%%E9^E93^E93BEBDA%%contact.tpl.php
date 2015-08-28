<?php /* Smarty version 2.6.14, created on 2013-09-30 03:47:52
         compiled from contact.tpl */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table align="<?php echo $this->_tpl_vars['page_align']; ?>
" border="0" cellspacing="0" width="<?php echo $this->_tpl_vars['panel_width'];  echo $this->_tpl_vars['joinperc']; ?>
" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
">
<tr>
<td width="100%"><table border="0" cellspacing="0" width="100%" cellpadding="4" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">
<tr>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['left_column']; ?>
" align="center" valign="top"><BR />
<table border="0" cellpadding="0" cellspacing="0" width="96%">
<td width="100%"><img border="0" src="images/contact.gif" width="32" height="32"><BR /><BR /><b><?php echo $this->_tpl_vars['contact_left_column_title']; ?>
</b><br /><?php echo $this->_tpl_vars['contact_left_column_text']; ?>
</td></tr>
<tr><td width="100%"></td></tr>
</table>
</td>
<td width="75%" align="center" valign="top">
<br />
<div align="center">
<center>
<table border="0" cellspacing="0" width="95%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
" cellpadding="0">
<tr><td width="100%">
<div align="center">
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['contact_title_display']; ?>
</font></b></td>
</tr>
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">
<div align="center"><table border="0" cellpadding="0" cellspacing="0" width="95%">
<form name="contact_form" method="POST" action="contact.php">
<input type="hidden" name="email_contact" value="1">
<tr><td width="100%" colspan="2" height="15"></td></tr>

<?php if (isset ( $this->_tpl_vars['display_contact_errors'] )): ?>
<tr><td width="100%" colspan="3"><font color="<?php echo $this->_tpl_vars['red_text']; ?>
"><b><?php echo $this->_tpl_vars['error_title']; ?>
</b></font><br /><?php echo $this->_tpl_vars['error_list']; ?>
<br /></td></tr>
<?php endif; ?>

<tr height="25">
<td width="25%"><?php echo $this->_tpl_vars['contact_name_display']; ?>
:</td>
<td width="75%" colspan="2"><input type="text" name="name" size="30" value="<?php echo $this->_tpl_vars['contact_name']; ?>
"></td>
</tr>
<tr height="25">
<td width="25%"><?php echo $this->_tpl_vars['contact_email_display']; ?>
:</td>
<td width="75%" colspan="2"><input type="text" name="email" size="30" value="<?php echo $this->_tpl_vars['contact_email']; ?>
"></td>
</tr>
<tr>
<td width="25%"><?php echo $this->_tpl_vars['contact_message_display']; ?>
:</td>
<td width="75%" colspan="2"><textarea name="message" wrap="physical" cols="40" rows="5"
onKeyDown="textCounter(document.contact_form.message,document.contact_form.remLen,250)"
onKeyUp="textCounter(document.contact_form.message,document.contact_form.remLen,250)"><?php echo $this->_tpl_vars['contact_message']; ?>
</textarea>
<br />
<input readonly type="text" name="remLen" size="3" maxlength="3" value="250">
<?php echo $this->_tpl_vars['contact_chars_display']; ?>
</td>
</tr>
<?php if (isset ( $this->_tpl_vars['security_required'] )): ?>
<tr>
<td width="25%"><?php echo $this->_tpl_vars['signup_security_code']; ?>
:</td>
<td width="25%"><input id="security_code" name="security_code" type="text" /></td>
<td width="50%" colspan="2">&nbsp;<img src="includes/security_image.php?width=100&height=30&characters=6" alt="Account Verification" /></td>
</tr>
<?php endif; ?>
<tr><td width="100%" colspan="3" height="15"></td></tr>

<?php if (isset ( $this->_tpl_vars['contact_email_received'] )): ?>
<tr>
<td width="25%"></td>
<td width="75%" colspan="2"><font color="<?php echo $this->_tpl_vars['red_text']; ?>
"><?php echo $this->_tpl_vars['contact_received_display']; ?>
</font></td>
</tr>

<?php else: ?>

<tr>
<td width="25%"></td>
<td width="75%" colspan="2"><input type="submit" value="<?php echo $this->_tpl_vars['contact_button_display']; ?>
"></td></form>
</tr>

<?php endif; ?>

<tr><td width="100%" colspan="2" height="15"></td></tr>
</table></div></td></tr></table></div></td></tr></table></center></div><BR />
</td></tr></table>
</td></tr></table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>