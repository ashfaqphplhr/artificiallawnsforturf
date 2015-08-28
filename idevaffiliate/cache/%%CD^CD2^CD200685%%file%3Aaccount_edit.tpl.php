<?php /* Smarty version 2.6.14, created on 2013-10-22 02:42:24
         compiled from file:account_edit.tpl */ ?>

<?php if (isset ( $this->_tpl_vars['display_edit_errors'] )): ?>
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<tr><td width="100%"><font color="<?php echo $this->_tpl_vars['red_text']; ?>
"><b><?php echo $this->_tpl_vars['error_title']; ?>
</b></font><br /><?php echo $this->_tpl_vars['error_list']; ?>
</td></tr>
</table>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_edit_custom.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form method="POST" action="account.php">
<input type="hidden" name="edit" value="1">
<input type="hidden" name="page" value="17">

<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
">General Preferences</font></b></td>
</tr>
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr><td width="100%" colspan="2" height="10"></td></tr>
    <tr>
      <td width="25%">&nbsp;Language To Receive Email</td><td width="75%"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_edit_email_preferences.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
    </tr>
<tr><td width="100%" colspan="2" height="10"></td></tr>
</table>
</table>
</td>
</tr>
</table>
<BR />

<?php if (isset ( $this->_tpl_vars['optionals_used'] )): ?>
<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
" colspan="2">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td width="50%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['edit_standard_title']; ?>
</font></b></td>
<?php if (isset ( $this->_tpl_vars['update_notice'] )): ?>
<td width="50%" bgcolor="<?php echo $this->_tpl_vars['red_text']; ?>
" align="right"><b><font color="white"><?php echo $this->_tpl_vars['edit_success']; ?>
</font></b>&nbsp; </td>
<?php elseif (isset ( $this->_tpl_vars['update_warning'] )): ?>
<td width="50%" bgcolor="<?php echo $this->_tpl_vars['tag_color']; ?>
" align="right"><b><font color="white"><?php echo $this->_tpl_vars['edit_failed']; ?>
</font></b>&nbsp; </td>
<?php else: ?>
<td width="50%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
"></td>
<?php endif; ?>
</tr>
</table>
</td>
</tr>
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr><td width="100%" colspan="2" height="10"></td></tr>
<?php if (isset ( $this->_tpl_vars['row_email'] )): ?>
<tr><td width="25%">&nbsp;<?php echo $this->_tpl_vars['edit_standard_email']; ?>
</td><td width="75%" colspan="2"><input type="text" name="email" size="30" value="<?php echo $this->_tpl_vars['postemail']; ?>
" style="width:200px;" tabindex="4"></td></tr>
<?php endif;  if (isset ( $this->_tpl_vars['row_company'] )): ?>
<tr><td width="25%">&nbsp;<?php echo $this->_tpl_vars['edit_standard_company']; ?>
</td><td width="75%" colspan="2"><input type="text" name="company" size="30" value="<?php echo $this->_tpl_vars['postcompany']; ?>
" style="width:200px;" tabindex="5"></td></tr>
<?php endif;  if (isset ( $this->_tpl_vars['row_checks'] )): ?>
<tr><td width="25%">&nbsp;<?php echo $this->_tpl_vars['edit_standard_checkspayable']; ?>
</td><td width="75%" colspan="2"><input type="text" name="payable" size="30" value="<?php echo $this->_tpl_vars['postchecks']; ?>
" style="width:200px;" tabindex="6"></td></tr>
<?php endif;  if (isset ( $this->_tpl_vars['row_website'] )): ?>
<tr><td width="25%">&nbsp;<?php echo $this->_tpl_vars['edit_standard_weburl']; ?>
</td><td width="75%" colspan="2"><input type="text" name="url" size="30" value="<?php echo $this->_tpl_vars['postwebsite']; ?>
" style="width:200px;" tabindex="7"></td></tr>
<?php endif;  if (isset ( $this->_tpl_vars['row_taxinfo'] )): ?>
<tr><td width="25%">&nbsp;<?php echo $this->_tpl_vars['edit_standard_taxinfo']; ?>
</td><td width="75%" colspan="2"><input type="text" name="tax_id_ssn" size="30" value="<?php echo $this->_tpl_vars['posttax']; ?>
" style="width:200px;" tabindex="8"></td></tr>
<?php endif; ?>
<tr><td width="100%" colspan="2" height="10"></td></tr>
</table>
</table>
</td>
</tr>
</table>
<BR />
<?php endif; ?>

<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['edit_personal_title']; ?>
</font></b></td>
</tr>
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr><td width="100%" colspan="4" height="10"></td></tr>
    <tr>
      <td width="20%">&nbsp;<?php echo $this->_tpl_vars['edit_personal_fname']; ?>
</td><td width="30%"><input type="text" name="f_name" size="20" value="<?php echo $this->_tpl_vars['postfname']; ?>
" style="width:140px;" tabindex="9"></td>
      <td width="20%"><?php echo $this->_tpl_vars['edit_personal_state']; ?>
</td><td width="30%"><input type="text" name="state" size="20" value="<?php echo $this->_tpl_vars['poststate']; ?>
" style="width:140px;" tabindex="14"></td>
    </tr>
    <tr>
      <td width="20%">&nbsp;<?php echo $this->_tpl_vars['edit_personal_lname']; ?>
</td><td width="30%"><input type="text" name="l_name" size="20" value="<?php echo $this->_tpl_vars['postlname']; ?>
" style="width:140px;" tabindex="10"></td>
      <td width="20%"><?php echo $this->_tpl_vars['edit_personal_phone']; ?>
</td><td width="30%"><input type="text" name="phone" size="20" value="<?php echo $this->_tpl_vars['postphone']; ?>
" style="width:140px;" tabindex="15"></td>
    </tr>
    <tr>
      <td width="20%">&nbsp;<?php echo $this->_tpl_vars['edit_personal_addr1']; ?>
</td><td width="30%"><input type="text" name="address_one" size="20" value="<?php echo $this->_tpl_vars['postaddr1']; ?>
" style="width:140px;" tabindex="11"></td>
      <td width="20%"><?php echo $this->_tpl_vars['edit_personal_fax']; ?>
</td><td width="30%"><input type="text" name="fax" size="20" value="<?php echo $this->_tpl_vars['postfaxnm']; ?>
" style="width:140px;" tabindex="16"></td>
    </tr>
    <tr>
      <td width="20%">&nbsp;<?php echo $this->_tpl_vars['edit_personal_addr2']; ?>
</td><td width="30%"><input type="text" name="address_two" size="20" value="<?php echo $this->_tpl_vars['postaddr2']; ?>
" style="width:140px;" tabindex="12"></td>
      <td width="20%"><?php echo $this->_tpl_vars['edit_personal_zip']; ?>
</td><td width="30%"><input type="text" name="zip" size="20" value="<?php echo $this->_tpl_vars['postzip']; ?>
" style="width:140px;" tabindex="17"></td>
    </tr>
    <tr>
      <td width="20%">&nbsp;<?php echo $this->_tpl_vars['edit_personal_city']; ?>
</td><td width="30%"><input type="text" name="city" size="20" value="<?php echo $this->_tpl_vars['postcity']; ?>
" style="width:140px;" tabindex="13"></td>
	<td width="20%"><?php echo $this->_tpl_vars['edit_personal_country']; ?>
</td><td width="30%"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_edit_countries.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
    </tr>
<tr><td width="100%" colspan="4" height="10"></td></tr>
</table>
</table>
</td>
</tr>
</table>

<BR/ >

<?php if (isset ( $this->_tpl_vars['paypal_required'] )):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_edit_paypal_required.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>

<?php if (isset ( $this->_tpl_vars['paypal_optional'] )):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_edit_paypal_optional.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>

<BR />

<table border="0" cellpadding="1" cellspacing="1" width="100%">
<td width="100%" colspan="4" align="center"><input type="submit" value="<?php echo $this->_tpl_vars['edit_button']; ?>
"></td></form>
</tr>
</table>

<BR />