<?php /* Smarty version 2.6.14, created on 2013-09-22 22:57:24
         compiled from signup.tpl */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if (isset ( $this->_tpl_vars['maintenance_mode'] )): ?>
<table align="<?php echo $this->_tpl_vars['page_align']; ?>
" border="0" cellspacing="0" cellpadding="40" width="<?php echo $this->_tpl_vars['panel_width'];  echo $this->_tpl_vars['joinperc']; ?>
" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
">
<div align="center"><center>
    <tr>
      <td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="center"><font size="3"><b><?php echo $this->_tpl_vars['signup_maintenance_heading']; ?>
</b></font><br /><?php echo $this->_tpl_vars['signup_maintenance_info']; ?>
</td>
	</td>
</center></div></table>
<?php else: ?>

<table align="<?php echo $this->_tpl_vars['page_align']; ?>
" border="0" cellspacing="0" width="<?php echo $this->_tpl_vars['panel_width'];  echo $this->_tpl_vars['joinperc']; ?>
" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
">
<tr><td width="100%"><table border="0" cellspacing="0" width="100%" cellpadding="4" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">
<tr><td width="25%" bgcolor="<?php echo $this->_tpl_vars['left_column']; ?>
" align="center" valign="top"> 
<table border="0" cellpadding="0" cellspacing="0" width="96%">

<form method="POST" action="signup.php">
<input type="hidden" name="submit" value="1">
<br /><tr><td width="100%"><img border="0" src="images/signup.gif" width="32" height="32"><BR /><BR /><b><?php echo $this->_tpl_vars['signup_left_column_title']; ?>
</b><br /><?php echo $this->_tpl_vars['signup_left_column_text']; ?>
<br /><br /></td>
</tr><tr><td width="100%" colspan="2"></td></tr>
</table></td>

<td width="75%" align="center" valign="top">


<table border="0" cellspacing="1" width="100%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">
<div align="center"><center>

<?php if (isset ( $this->_tpl_vars['signup_complete'] )): ?>
<BR /><tr><td width="100%" colspan="4"><center>
<font color="<?php echo $this->_tpl_vars['red_text']; ?>
"><b><?php echo $this->_tpl_vars['signup_page_success']; ?>
</b></font><BR /><?php echo $this->_tpl_vars['signup_success_email_comment']; ?>

<br /><br /><a href="account.php"><b><?php echo $this->_tpl_vars['signup_success_login_link']; ?>
</b></a>
</center></td></tr></table></tr></td></table></tr></td></table>
<?php else: ?>

<?php if (isset ( $this->_tpl_vars['display_signup_errors'] )): ?>
<tr><td width="100%" colspan="4"><font color="<?php echo $this->_tpl_vars['red_text']; ?>
"><b><?php echo $this->_tpl_vars['error_title']; ?>
</b></font><br /><?php echo $this->_tpl_vars['error_list']; ?>
<br /></td></tr>
<?php endif; ?>

    <tr>
      <td width="100%" colspan="4" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><b><?php echo $this->_tpl_vars['signup_login_title']; ?>
</b></font></td>
    </tr>
    <tr>
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['signup_login_username']; ?>
</td>
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<input type="text" name="username" size="20" value="<?php if (isset ( $this->_tpl_vars['postuser'] )):  echo $this->_tpl_vars['postuser'];  endif; ?>" style="width:150px;" tabindex="1"></td>
      <td width="50%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" colspan="2">&nbsp;<img src="images/help.gif" title="header=[<?php echo $this->_tpl_vars['signup_login_username']; ?>
 & <?php echo $this->_tpl_vars['signup_login_password']; ?>
] body=[<?php echo $this->_tpl_vars['signup_login_minmax_chars']; ?>
]" style="cursor:pointer;">
	</td>
    </tr>
    <tr>
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['signup_login_password']; ?>
</td>
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<input type="password" name="password" size="20" value="<?php if (isset ( $this->_tpl_vars['postpass'] )):  echo $this->_tpl_vars['postpass'];  endif; ?>" style="width:150px;" tabindex="2"></td>
      <td width="50%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" colspan="2">&nbsp;<img src="images/help.gif" title="header=[<?php echo $this->_tpl_vars['signup_login_username']; ?>
 & <?php echo $this->_tpl_vars['signup_login_password']; ?>
] body=[<?php echo $this->_tpl_vars['signup_login_minmax_chars']; ?>
]" style="cursor:pointer;"></td>
    </tr>
    <tr>
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['signup_login_password_again']; ?>
</td>
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<input type="password" name="password_c" size="20" value="<?php echo $this->_tpl_vars['postpasc']; ?>
" style="width:150px;" tabindex="3"></td>
      <td width="50%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" colspan="2">&nbsp;<img src="images/help.gif" title="header=[<?php echo $this->_tpl_vars['signup_login_password_again']; ?>
] body=[<?php echo $this->_tpl_vars['signup_login_must_match']; ?>
]" style="cursor:pointer;"></td>
    </tr>
<tr><td width="100%" colspan="4" height="5"></td></tr>

<?php if (isset ( $this->_tpl_vars['optionals_used'] )): ?>
<tr><td width="100%" colspan="4" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><b><?php echo $this->_tpl_vars['signup_standard_title']; ?>
</b></font></td></tr>
<?php if (isset ( $this->_tpl_vars['row_email'] )): ?>
<tr>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['signup_standard_email']; ?>
</td>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<input type="text" name="email" size="30" value="<?php echo $this->_tpl_vars['postemail']; ?>
" style="width:150px;" tabindex="4"></td>
<td width="50%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" colspan="2"></td>
</tr>
<?php endif;  if (isset ( $this->_tpl_vars['row_company'] )): ?>
<tr>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['signup_standard_company']; ?>
</td>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<input type="text" name="company" size="30" value="<?php echo $this->_tpl_vars['postcompany']; ?>
" style="width:150px;" tabindex="5"></td>
<td width="50%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" colspan="2"></td>
</tr>
<?php endif;  if (isset ( $this->_tpl_vars['row_checks'] )): ?>
<tr>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['signup_standard_checkspayable']; ?>
</td>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<input type="text" name="payable" size="30" value="<?php echo $this->_tpl_vars['postchecks']; ?>
" style="width:150px;" tabindex="6"></td>
<td width="50%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" colspan="2"></td>
</tr>
<?php endif;  if (isset ( $this->_tpl_vars['row_website'] )): ?>
<tr>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['signup_standard_weburl']; ?>
</td>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<input type="text" name="url" size="30" value="<?php echo $this->_tpl_vars['postwebsite']; ?>
" style="width:150px;" tabindex="7"></td>
<td width="50%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" colspan="2"></td>
</tr>
<?php endif;  if (isset ( $this->_tpl_vars['row_taxinfo'] )): ?>
<tr>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['signup_standard_taxinfo']; ?>
</td>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<input type="text" name="tax_id_ssn" size="30" value="<?php echo $this->_tpl_vars['posttax']; ?>
" style="width:150px;" tabindex="8"></td>
<td width="50%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" colspan="2"></td>
</tr>
<?php endif; ?>
<tr><td width="100%" colspan="4" height="5"></td></tr>
<?php endif; ?>

    <tr>
      <td width="100%" colspan="4" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><b><?php echo $this->_tpl_vars['signup_personal_title']; ?>
</b></font></td>
    </tr>
    <tr>
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['signup_personal_fname']; ?>
</td><td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<input type="text" name="f_name" size="20" value="<?php echo $this->_tpl_vars['postfname']; ?>
" style="width:150px;" tabindex="9"></td>
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['signup_personal_state']; ?>
</td><td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<input type="text" name="state" size="20" value="<?php echo $this->_tpl_vars['poststate']; ?>
" style="width:150px;" tabindex="14"></td>
    </tr>
    <tr>
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['signup_personal_lname']; ?>
</td><td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<input type="text" name="l_name" size="20" value="<?php echo $this->_tpl_vars['postlname']; ?>
" style="width:150px;" tabindex="10"></td>
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['signup_personal_phone']; ?>
</td><td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<input type="text" name="phone" size="20" value="<?php echo $this->_tpl_vars['postphone']; ?>
" style="width:150px;" tabindex="15"></td>
    </tr>
    <tr>
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['signup_personal_addr1']; ?>
</td><td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<input type="text" name="address_one" size="20" value="<?php echo $this->_tpl_vars['postaddr1']; ?>
" style="width:150px;" tabindex="11"></td>
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['signup_personal_fax']; ?>
</td><td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<input type="text" name="fax" size="20" value="<?php echo $this->_tpl_vars['postfaxnm']; ?>
" style="width:150px;" tabindex="16"></td>
    </tr>
    <tr>
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['signup_personal_addr2']; ?>
</td><td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<input type="text" name="address_two" size="20" value="<?php echo $this->_tpl_vars['postaddr2']; ?>
" style="width:150px;" tabindex="12"></td>
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['signup_personal_zip']; ?>
</td><td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<input type="text" name="zip" size="20" value="<?php echo $this->_tpl_vars['postzip']; ?>
" style="width:150px;" tabindex="17"></td>
    </tr>
    <tr>
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['signup_personal_city']; ?>
</td><td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<input type="text" name="city" size="20" value="<?php echo $this->_tpl_vars['postcity']; ?>
" style="width:150px;" tabindex="13"></td>
	<td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['signup_personal_country']; ?>
</td><td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:countries.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
    </tr>
	<tr><td width="100%" colspan="4" height="5"></td></tr>

<?php if (isset ( $this->_tpl_vars['payment_choice_used'] )):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:signup_payment_choices.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>

<?php if (isset ( $this->_tpl_vars['paypal_required'] )):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:signup_paypal_required.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>

<?php if (isset ( $this->_tpl_vars['paypal_optional'] )):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:signup_paypal_optional.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>

<?php if (isset ( $this->_tpl_vars['terms_conditions'] )):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:signup_terms.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>

<?php if (isset ( $this->_tpl_vars['canspam_conditions'] )):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:signup_canspam.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>

<?php if (isset ( $this->_tpl_vars['insert_custom_fields'] )):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:signup_custom.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>

<?php if (isset ( $this->_tpl_vars['security_required'] )):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:signup_security_code.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>

<tr><td width="100%" colspan="4" height="10"></td></tr>
<tr>
<td width="100%" colspan="4" align="center"><hr width="90%"></td>
</tr>
<tr><td width="100%" colspan="4" height="10"></td></tr>
<tr>
<td width="100%" colspan="4" align="center"><input type="submit" value="<?php echo $this->_tpl_vars['signup_page_button']; ?>
"></td></form>
</tr>
<tr><td width="100%" colspan="4" height="10"></td></tr>
</table>
</center>
</div>
</table></table>

<?php endif;  endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>