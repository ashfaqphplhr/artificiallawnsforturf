<?php /* Smarty version 2.6.14, created on 2013-09-30 04:28:45
         compiled from file:account_alternate_page_links.tpl */ ?>

<?php if (isset ( $this->_tpl_vars['alternate_keywords_enabled'] )): ?>

<?php if (isset ( $this->_tpl_vars['display_custom_errors'] )): ?>
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<tr><td width="100%"><font color="<?php echo $this->_tpl_vars['red_text']; ?>
"><b><?php echo $this->_tpl_vars['custom_error_title']; ?>
</b></font><br /><?php echo $this->_tpl_vars['custom_error_list']; ?>
</td></tr>
<tr><td width="100%" height="10"></td></tr>
</table>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['display_custom_success'] )): ?>
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<tr><td width="100%"><font color="<?php echo $this->_tpl_vars['red_text']; ?>
"><b><?php echo $this->_tpl_vars['custom_success_title']; ?>
</b></font><br /><?php echo $this->_tpl_vars['custom_success_message']; ?>
</td></tr>
<tr><td width="100%" height="10"></td></tr>
</table>
<?php endif; ?>

<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">

<table border="0" cellpadding="2" cellspacing="1" width="100%">
<tr>
<td width="50%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['alternate_title']; ?>
</font></b></td>
<td width="50%" align="right" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['alternate_option_1']; ?>
</font></b>&nbsp;</td>
</tr>
<tr>
<td width="100%" colspan="2" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="center">

<table border="0" cellpadding="0" cellspacing="0" width="98%">
<form action="account.php" method="post">
<input type="hidden" name="create_alternate" value="1">
<input type="hidden" name="page" value="35">
<tr><td width="100%" height="10"></td></tr>
<tr><td width="100%"><b><?php echo $this->_tpl_vars['alternate_heading_1']; ?>
</b></td></tr>
<tr><td width="100%"><?php echo $this->_tpl_vars['alternate_info_1']; ?>
</td></tr>
<tr><td width="100%" height="10"></td></tr>

<tr><td width="100%"><input type="text" name="custom_link" value="http://" size="95" /></td></tr>
<tr><td width="100%" height="5"></td></tr>
<tr><td width="100%"><input type="submit" value="<?php echo $this->_tpl_vars['alternate_button']; ?>
" name="<?php echo $this->_tpl_vars['alternate_button']; ?>
"></td></form></tr>
<tr><td width="100%" height="5"></td></tr>

<tr bgcolor="<?php echo $this->_tpl_vars['light_cells']; ?>
"><td width="100%" height="25">&nbsp; <b><?php echo $this->_tpl_vars['alternate_links_heading']; ?>
</b></td></tr>

<tr bgcolor="<?php echo $this->_tpl_vars['light_cells']; ?>
"><td width="100%" align="center">


<table width="95%" border="0" cellpadding="0" cellspacing="0">

<?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['clinks_results']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['nr']['show'] = true;
$this->_sections['nr']['max'] = $this->_sections['nr']['loop'];
$this->_sections['nr']['step'] = 1;
$this->_sections['nr']['start'] = $this->_sections['nr']['step'] > 0 ? 0 : $this->_sections['nr']['loop']-1;
if ($this->_sections['nr']['show']) {
    $this->_sections['nr']['total'] = $this->_sections['nr']['loop'];
    if ($this->_sections['nr']['total'] == 0)
        $this->_sections['nr']['show'] = false;
} else
    $this->_sections['nr']['total'] = 0;
if ($this->_sections['nr']['show']):

            for ($this->_sections['nr']['index'] = $this->_sections['nr']['start'], $this->_sections['nr']['iteration'] = 1;
                 $this->_sections['nr']['iteration'] <= $this->_sections['nr']['total'];
                 $this->_sections['nr']['index'] += $this->_sections['nr']['step'], $this->_sections['nr']['iteration']++):
$this->_sections['nr']['rownum'] = $this->_sections['nr']['iteration'];
$this->_sections['nr']['index_prev'] = $this->_sections['nr']['index'] - $this->_sections['nr']['step'];
$this->_sections['nr']['index_next'] = $this->_sections['nr']['index'] + $this->_sections['nr']['step'];
$this->_sections['nr']['first']      = ($this->_sections['nr']['iteration'] == 1);
$this->_sections['nr']['last']       = ($this->_sections['nr']['iteration'] == $this->_sections['nr']['total']);
?>

<tr><td><font color="#CC0000"><?php echo $this->_tpl_vars['clinks_results'][$this->_sections['nr']['index']]['clink_url']; ?>
</font></td></tr>
<tr><td><input type="text" name="sub_link" value="<?php echo $this->_tpl_vars['clinks_results'][$this->_sections['nr']['index']]['clink_linkurl']; ?>
" size="85" />&nbsp; [<a href="account.php?page=35&custom_remove=<?php echo $this->_tpl_vars['clinks_results'][$this->_sections['nr']['index']]['clink_id']; ?>
"><?php echo $this->_tpl_vars['alternate_links_remove']; ?>
</a>]</td></tr>
<tr><td width="100%" height="5"></td></tr>


<?php endfor; else: ?>

<tr><td width="100%"><?php echo $this->_tpl_vars['alternate_none']; ?>
</td></tr>

<?php endif; ?>

<tr><td width="100%" height="5"></td></tr>
</table>

</td></tr>

<tr><td width="100%" height="10"></td></tr>
<tr><td width="100%"><?php echo $this->_tpl_vars['alternate_links_note']; ?>
</td></tr>
<tr><td width="100%" height="10"></td></tr>
<tr><td width="100%"><a href="http://www.idevlibrary.com/docs/Custom_Links.pdf" target="_blank"><b><?php echo $this->_tpl_vars['alternate_tutorial']; ?>
</b></a></td></tr>
<tr><td width="100%" height="10"></td></tr>
</table>


</td></tr>
</table>
</td>
</tr>
</table>



<br />

<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">

<table border="0" cellpadding="2" cellspacing="1" width="100%">
<tr>
<td width="50%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['alternate_title']; ?>
</font></b></td>
<td width="50%" align="right" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['alternate_option_2']; ?>
</font></b>&nbsp;</td>
</tr>
<tr>
<td width="100%" colspan="2" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="center">

<table border="0" cellpadding="0" cellspacing="0" width="98%">
<tr><td width="100%" height="10"></td></tr>
<tr><td width="100%"><?php echo $this->_tpl_vars['alternate_info_2']; ?>
</td></tr>
<tr><td width="100%" height="10"></td></tr>
<tr><td width="100%"><?php echo $this->_tpl_vars['alternate_variable']; ?>
: <font color="#CC0000">url</font></td></tr>
<tr><td width="100%" height="10"></td></tr>
<tr><td width="100%"><?php echo $this->_tpl_vars['alternate_build']; ?>
</td></tr>
<tr><td width="100%"><input type="text" name="sub_link" value="<?php echo $this->_tpl_vars['alternate_keyword_linkurl']; ?>
" size="95" /></td></tr>
<tr><td width="100%" height="10"></td></tr>
<tr><td width="100%"><?php echo $this->_tpl_vars['alternate_example']; ?>
: <?php echo $this->_tpl_vars['alternate_keyword_linkurl']; ?>
<font color="#CC0000">&url=<b>http://www.yahoo.com</b></font></td></tr>
<tr><td width="100%" height="10"></td></tr>
<tr><td width="100%"><a href="http://www.idevlibrary.com/docs/Custom_Links.pdf" target="_blank"><b><?php echo $this->_tpl_vars['alternate_tutorial']; ?>
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
