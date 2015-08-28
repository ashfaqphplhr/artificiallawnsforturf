<?php /* Smarty version 2.6.14, created on 2013-08-21 09:35:30
         compiled from login.tpl */ ?>

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
<td width="100%">
<table border="0" cellspacing="0" width="100%" cellpadding="4" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">
<tr>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['left_column']; ?>
" align="center" valign="top"><BR />
<table border="0" cellpadding="0" cellspacing="0" width="96%">
<tr>
<td width="100%"><img border="0" src="images/login.gif" width="32" height="32"><BR /><BR /><b><?php echo $this->_tpl_vars['login_left_column_title']; ?>
</b><br /><?php echo $this->_tpl_vars['login_left_column_text']; ?>
</td>
</tr>
</table>
</td>
<td width="75%" align="center" valign="top">
<br />
<table border="0" cellspacing="0" width="95%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
" cellpadding="0">
<tr>
<td width="100%">
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['login_title']; ?>
</font></b></td>
</tr>
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">
<table border="0" cellpadding="0" cellspacing="0" width="95%">
<tr><td width="100%" colspan="2" height="15"></td></tr>
<form method="POST" action="login.php">
<tr>
<td width="40%" align="right"><?php echo $this->_tpl_vars['login_username']; ?>
:&nbsp;&nbsp;</td>
<td width="60%"><input type="text" name="userid" size="20"></td>
</tr>
<tr>
<td width="40%" align="right"><?php echo $this->_tpl_vars['login_password']; ?>
:&nbsp;&nbsp;</td>
<td width="60%"><input type="password" name="password" size="20" autocomplete="off"></td>
</tr>

<?php if (isset ( $this->_tpl_vars['login_invalid'] )): ?>
<tr>
<td width="40%" align="right"></td>
<td width="60%"><font color="#CC0000"><?php echo $this->_tpl_vars['login_invalid']; ?>
</font></td>
</tr>
<?php endif; ?>

<tr><td width="100%" colspan="2" height="15"></td></tr>
<tr>
<td width="40%" align="right"></td><td width="60%"><input type="submit" value="<?php echo $this->_tpl_vars['login_now']; ?>
">
</td>
</tr>
</form>
<tr><td width="100%" colspan="2" height="30"></td></tr>

<form method="POST" action="login.php">

<tr>
<td width="40%" align="right"></td>
<td width="60%"><b><?php echo $this->_tpl_vars['login_send_title']; ?>
</b></td>
</tr>
<tr>
<td width="40%" align="right"><?php echo $this->_tpl_vars['login_send_username']; ?>
:&nbsp;&nbsp;</td>
<td width="60%"><input type="text" name="sendpass" size="20"></td>
</tr>

<?php if (isset ( $this->_tpl_vars['login_details'] )): ?>
<tr>
<td width="40%" align="right"></td>
<td width="60%"><font color="#CC0000"><?php echo $this->_tpl_vars['login_details']; ?>
</font></td>
</tr>
<?php endif; ?>

<tr><td width="100%" colspan="2" height="15"></td></tr>
<tr>
<td width="40%"></td>
<td width="60%"><input type="submit" value="<?php echo $this->_tpl_vars['login_send_pass']; ?>
"></td>
</tr>
</form>
<tr><td width="100%" colspan="2" height="15"></td></tr>
</table>
</td></tr></table></td></tr></table></form><BR />
</td>
</tr>
</table>
</td>
</tr>
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>