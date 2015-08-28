<?php /* Smarty version 2.6.14, created on 2013-08-21 09:10:44
         compiled from index.tpl */ ?>

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
<td>
<table border="0" cellpadding="4" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">
<tr>
<td width="75%"><b><?php echo $this->_tpl_vars['index_heading_1']; ?>
</b><br /><?php echo $this->_tpl_vars['index_paragraph_1']; ?>
<br /></td>
<td width="25%" rowspan="2" valign="top">


<form method="POST" action="login.php">
<table border="0" cellspacing="0" width="95%">
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
">
<table border="0" cellspacing="0" width="100%" cellpadding="2">
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" colspan="2"> <font color="white"><b><?php echo $this->_tpl_vars['index_login_title']; ?>
</b></font></td>
</tr>
<tr>
<td width="40%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
"> <?php echo $this->_tpl_vars['index_login_username']; ?>
:</td>
<td width="60%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
"><input type="text" name="userid" size="10" value="<?php echo $this->_tpl_vars['index_login_username_field']; ?>
" style="width:90px;"></td>
</tr>
<tr>
<td width="40%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
"> <?php echo $this->_tpl_vars['index_login_password']; ?>
:</td>
<td width="60%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
"><input type="password" name="password" size="10" value="<?php echo $this->_tpl_vars['index_login_password_field']; ?>
" autocomplete="off" style="width:90px;"></td>
</tr>
<tr>
<td width="40%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
"> </td>
<td width="60%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
"><input type="submit" value="<?php echo $this->_tpl_vars['index_login_button']; ?>
"></td>
</tr>
</table>
</td>
</tr>
</table>
</form>

<center><a href="signup.php"><font color="<?php echo $this->_tpl_vars['page_links']; ?>
"><b><?php echo $this->_tpl_vars['index_login_signup_link']; ?>
</b></font></a></center>


</td>
</tr>
<tr><td width="75%"><b><?php echo $this->_tpl_vars['index_heading_2']; ?>
</b><br /><?php echo $this->_tpl_vars['index_paragraph_2']; ?>
<br /></td></tr>
<tr><td width="75%"><b><?php echo $this->_tpl_vars['index_heading_3']; ?>
</b><br /><?php echo $this->_tpl_vars['index_paragraph_3']; ?>
</td></tr>

<tr><td width="100%" colspan="2">
<center>
<table border="0" cellpadding="0" cellspacing="1" width="98%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
" colspan=2>&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['index_table_title']; ?>
</font></b></td>
</tr>
<tr><td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
"><b>&nbsp;<?php echo $this->_tpl_vars['index_table_commission_type']; ?>
</b></td>
<td width="75%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['commission_type_info']; ?>

</td>
</tr>

<?php if (isset ( $this->_tpl_vars['choose_percentage_payout'] )): ?>
<tr><td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['index_table_sale']; ?>
:</td><td width="75%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['bot1']; ?>
% <?php echo $this->_tpl_vars['index_table_sale_text']; ?>
</td></tr>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['choose_flatrate_payout'] )): ?>
<tr><td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['index_table_sale']; ?>
:</td><td width="75%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php if ($this->_tpl_vars['cur_sym_location'] == 1):  echo $this->_tpl_vars['cur_sym'];  endif;  echo $this->_tpl_vars['bot2'];  if ($this->_tpl_vars['cur_sym_location'] == 2): ?> <?php echo $this->_tpl_vars['cur_sym'];  endif; ?> <?php echo $this->_tpl_vars['currency']; ?>
 <?php echo $this->_tpl_vars['index_table_sale_text']; ?>
</td></tr>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['choose_perclick_payout'] )): ?>
<tr><td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['index_table_click']; ?>
:</td><td width="75%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php if ($this->_tpl_vars['cur_sym_location'] == 1):  echo $this->_tpl_vars['cur_sym'];  endif;  echo $this->_tpl_vars['bot3'];  if ($this->_tpl_vars['cur_sym_location'] == 2): ?> <?php echo $this->_tpl_vars['cur_sym'];  endif; ?> <?php echo $this->_tpl_vars['currency']; ?>
 <?php echo $this->_tpl_vars['index_table_click_text']; ?>
</td></tr>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['payout_add_small_row'] )): ?>
<tr><td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
" colspan="2" height="2"></td></tr>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['add_balance_row'] )): ?>
<tr><td bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" width="25%"><b>&nbsp;<?php echo $this->_tpl_vars['index_table_initial_deposit']; ?>
</b></td><td width="75%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php if ($this->_tpl_vars['cur_sym_location'] == 1):  echo $this->_tpl_vars['cur_sym'];  endif;  echo $this->_tpl_vars['init_deposit'];  if ($this->_tpl_vars['cur_sym_location'] == 2): ?> <?php echo $this->_tpl_vars['cur_sym'];  endif; ?> <?php echo $this->_tpl_vars['currency']; ?>
 - <font color="#CC0000"><b><?php echo $this->_tpl_vars['index_table_deposit_tag']; ?>
</b></font></td></tr>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['add_requirements_row'] )): ?>
<tr><td bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" width="25%"><b>&nbsp;<?php echo $this->_tpl_vars['index_table_requirements']; ?>
</b></td><td width="75%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php if ($this->_tpl_vars['cur_sym_location'] == 1):  echo $this->_tpl_vars['cur_sym'];  endif;  echo $this->_tpl_vars['init_req'];  if ($this->_tpl_vars['cur_sym_location'] == 2): ?> <?php echo $this->_tpl_vars['cur_sym'];  endif; ?> <?php echo $this->_tpl_vars['currency']; ?>
 - <?php echo $this->_tpl_vars['index_table_requirements_tag']; ?>
</td></tr>
<?php endif; ?>

<tr>
<td bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" width="25%"><b>&nbsp;<?php echo $this->_tpl_vars['index_table_duration']; ?>
</b></td><td width="75%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['index_table_duration_tag']; ?>
</td>
</tr>
</table>
</center>

<BR />

  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td width="33%" align="center"><a href="login.php"><img border="0" src="images/affiliate_login.gif" width="188" height="56"></a></td>
      <td width="34%" align="center"><a href="signup.php"><img border="0" src="images/affiliate_signup.gif" width="188" height="56"></a></td>
      <td width="33%" align="center"><a href="contact.php"><img border="0" src="images/affiliate_contact.gif" width="188" height="56"></a></td>
    </tr>
  </table>

<BR />
</td>
</tr>
</table>
</td></tr>
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>