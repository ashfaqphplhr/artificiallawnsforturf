<?php /* Smarty version 2.6.14, created on 2013-09-22 22:57:25
         compiled from file:signup_terms.tpl */ ?>

<tr>
<td width="100%" colspan="4" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><b><?php echo $this->_tpl_vars['signup_terms_title']; ?>
</b></font></td>
</tr>
<tr>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" rowspan="2" align="center"><img border="0" src="images/cp_terms.gif" width="32" height="32"></td>
<td width="75%" colspan="3" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<textarea rows="5" name="terms" cols="50" readonly><?php echo $this->_tpl_vars['terms_t']; ?>
</textarea></td>
</tr>
<?php if (isset ( $this->_tpl_vars['terms_required'] )): ?>
<tr>
<td width="75%" colspan="3" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
"><input type="checkbox" name="accepted" value="1"<?php echo $this->_tpl_vars['terms_checked']; ?>
>&nbsp;<?php echo $this->_tpl_vars['signup_terms_agree']; ?>
</font></td>
</tr>
<?php else: ?>
<tr><td width="75%" colspan="3" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" height="1"></td></tr>
<?php endif; ?>
<tr><td width="100%" colspan="4" height="5"></td></tr>

