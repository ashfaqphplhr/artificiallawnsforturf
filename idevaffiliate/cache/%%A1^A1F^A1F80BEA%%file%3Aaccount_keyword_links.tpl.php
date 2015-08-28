<?php /* Smarty version 2.6.14, created on 2013-09-30 04:26:20
         compiled from file:account_keyword_links.tpl */ ?>

<?php if (isset ( $this->_tpl_vars['custom_links_enabled'] )): ?>

<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">
<table border="0" cellpadding="2" cellspacing="1" width="100%">
<tr><td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['keyword_title']; ?>
</font></b></td></tr>
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="center">
<table border="0" cellpadding="0" cellspacing="0" width="98%">
<tr><td width="100%" height="10"></td></tr>
<tr><td width="100%"><?php echo $this->_tpl_vars['keyword_info']; ?>
</td></tr>
<tr><td width="100%" height="10"></td></tr>
<tr><td width="100%"><b><?php echo $this->_tpl_vars['keyword_heading']; ?>
</b></td></tr>
<tr><td width="100%" height="5"></td></tr>
<tr><td width="100%"><?php echo $this->_tpl_vars['keyword_tracking']; ?>
 1: <font color="#CC0000">tid1</font></td></tr>
<tr><td width="100%"><?php echo $this->_tpl_vars['keyword_tracking']; ?>
 2: <font color="#CC0000">tid2</font></td></tr>
<tr><td width="100%"><?php echo $this->_tpl_vars['keyword_tracking']; ?>
 3: <font color="#CC0000">tid3</font></td></tr>
<tr><td width="100%"><?php echo $this->_tpl_vars['keyword_tracking']; ?>
 4: <font color="#CC0000">tid4</font></td></tr>
<tr><td width="100%" height="10"></td></tr>
<tr><td width="100%"><?php echo $this->_tpl_vars['keyword_build']; ?>
</td></tr>
<tr><td width="100%"><input type="text" name="sub_link" value="<?php echo $this->_tpl_vars['custom_keyword_linkurl']; ?>
" size="95" /></td></tr>
<tr><td width="100%" height="10"></td></tr>
<tr><td width="100%"><?php echo $this->_tpl_vars['keyword_example']; ?>
: <?php echo $this->_tpl_vars['custom_keyword_linkurl']; ?>
<font color="#CC0000">&tid1=<b>google</b></font></td></tr>
<tr><td width="100%" height="10"></td></tr>
<tr><td width="100%"><a href="http://www.idevlibrary.com/docs/Custom_Links.pdf" target="_blank"><b><?php echo $this->_tpl_vars['keyword_tutorial']; ?>
</b></a></td></tr>
<tr><td width="100%" height="10"></td></tr>
</table>
</td></tr>
</table>
</td>
</tr>
</table>

<?php endif; ?>

<br />