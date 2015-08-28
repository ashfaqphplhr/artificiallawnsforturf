<?php /* Smarty version 2.6.14, created on 2013-09-30 04:26:44
         compiled from file:account_email_links.tpl */ ?>

<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">
<table border="0" cellpadding="2" cellspacing="1" width="100%">
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['email_title']; ?>
</font></b></td>
</tr>
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<form method="POST" action="account.php">
<input type="hidden" name="page" value="10">
<tr height="30">
<td width="22%" align="right"><b><?php echo $this->_tpl_vars['email_group']; ?>
:&nbsp;&nbsp;</b></td>
<td width="43%">
<select size="1" name="email_picked">
<?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['email_results']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<option value="<?php echo $this->_tpl_vars['email_results'][$this->_sections['nr']['index']]['email_group_id']; ?>
"><?php echo $this->_tpl_vars['email_results'][$this->_sections['nr']['index']]['email_group_name']; ?>
</option>
<?php endfor; endif; ?>
</select>
</td>
<td width="35%" align="right"><input type="submit" value="<?php echo $this->_tpl_vars['email_button']; ?>
">&nbsp;</td></form>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>

<BR />

<?php if (isset ( $this->_tpl_vars['email_group_chosen'] )): ?>

<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">
<table border="0" cellpadding="2" cellspacing="1" width="100%">
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['email_group']; ?>
:</font> <font color="<?php echo $this->_tpl_vars['red_text']; ?>
"><?php echo $this->_tpl_vars['email_chosen_group_name']; ?>
</font></b></td>
</tr>
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">
<BR />&nbsp;
<?php echo $this->_tpl_vars['email_ascii']; ?>

<BR />&nbsp;
<textarea rows="3" cols="56"><?php echo $this->_tpl_vars['email_chosen_url']; ?>
</textarea>
<BR />&nbsp;
<?php echo $this->_tpl_vars['email_source']; ?>

<BR /><BR />&nbsp;
<?php echo $this->_tpl_vars['email_html']; ?>

<BR />&nbsp;
<textarea rows="3" cols="56"><a href="<?php echo $this->_tpl_vars['email_chosen_url'];  echo $this->_tpl_vars['rel_values']; ?>
"><?php echo $this->_tpl_vars['email_chosen_group_name']; ?>
</a></textarea>
<BR />&nbsp;
<?php echo $this->_tpl_vars['email_source']; ?>

<BR /><BR />&nbsp;
<b><?php echo $this->_tpl_vars['email_test']; ?>
</b>: <a href="<?php echo $this->_tpl_vars['email_chosen_url'];  echo $this->_tpl_vars['rel_values']; ?>
" target="_blank"><?php echo $this->_tpl_vars['email_chosen_display_tag']; ?>
</a>
<BR />&nbsp;
<?php echo $this->_tpl_vars['email_test_info']; ?>

<BR />
<BR />
</td>
</tr>
</table>
</td>
</tr>
</table>

<?php else: ?>

<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">
<table border="0" cellpadding="2" cellspacing="1" width="100%">
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['email_no_group']; ?>
</font></b></td>
</tr>
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="center"><BR /><BR /><b><?php echo $this->_tpl_vars['email_choose']; ?>
</b><BR /><BR /><font color="<?php echo $this->_tpl_vars['red_text']; ?>
"><?php echo $this->_tpl_vars['email_notice']; ?>
</font><BR /><BR /><BR /></td>
</tr>
</table>
</td>
</tr>
</table>

<?php endif; ?>

<BR />