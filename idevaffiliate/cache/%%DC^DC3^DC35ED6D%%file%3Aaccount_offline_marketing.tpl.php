<?php /* Smarty version 2.6.14, created on 2013-09-30 04:27:52
         compiled from file:account_offline_marketing.tpl */ ?>

<?php if (isset ( $this->_tpl_vars['offline_enabled'] )): ?>

<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">
<table border="0" cellpadding="2" cellspacing="1" width="100%">
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['offline_title']; ?>
</font></b></td>
</tr>
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="center">
<table border="0" cellpadding="0" cellspacing="0" width="95%">
<tr>
<td width="100%"><BR /><?php echo $this->_tpl_vars['offline_paragraph_one']; ?>
<BR /><BR />
<table border="0" cellpadding="0" cellspacing="0" width="95%">
<tr>
<td width="30%">&nbsp;&nbsp;<b><?php echo $this->_tpl_vars['offline_tag']; ?>
:</b></td>
<td width="70%">&nbsp;&nbsp;<b><font color="<?php echo $this->_tpl_vars['red_text']; ?>
"><?php echo $this->_tpl_vars['link_id']; ?>
</font></b></td>
</tr>
<tr><td height="6"></td></tr>
<tr>
<td width="30%">&nbsp;&nbsp;<b><?php echo $this->_tpl_vars['offline_send']; ?>
:</b></td>
<td width="70%">&nbsp;&nbsp;<?php echo $this->_tpl_vars['offline_location']; ?>
</td>
</tr>
<tr>
<td width="30%">&nbsp;&nbsp;</td>
<td width="70%">&nbsp;&nbsp;(<a href="<?php echo $this->_tpl_vars['offline_location']; ?>
" target="_blank"><?php echo $this->_tpl_vars['offline_page_link']; ?>
</a>)</td>
</tr>
</table>
<BR /><?php echo $this->_tpl_vars['offline_paragraph_two']; ?>
<BR /><BR />
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>

<?php endif; ?>

<br />