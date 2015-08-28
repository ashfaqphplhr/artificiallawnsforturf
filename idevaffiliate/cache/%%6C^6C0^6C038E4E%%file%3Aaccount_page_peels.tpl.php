<?php /* Smarty version 2.6.14, created on 2013-09-30 04:25:49
         compiled from file:account_page_peels.tpl */ ?>
<?php if (isset ( $this->_tpl_vars['one_click_delivery'] )): ?>

<?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['peel_link_results']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">
<table border="0" cellpadding="2" cellspacing="1" width="100%">
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['marketing_group']; ?>
: <?php echo $this->_tpl_vars['peel_link_results'][$this->_sections['nr']['index']]['peel_group_name']; ?>
</b></td>
</tr>
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="center">

<?php echo '
<script type="text/javascript">
function openpopup(popurl){
var winpops=window.open(popurl,"","width=100%,height=100%,directories,status,scrollbars,resizable") }
</script>
'; ?>


<BR />
<table border="0" cellpadding="0" cellspacing="0" width="98%">
<tr><td width="100%" colspan="2" height="20">

<b><?php echo $this->_tpl_vars['peels_title']; ?>
</b>: <?php echo $this->_tpl_vars['peel_link_results'][$this->_sections['nr']['index']]['peel_link_name']; ?>
<BR />
<b><?php echo $this->_tpl_vars['peels_description']; ?>
</b>: <?php echo $this->_tpl_vars['peel_link_results'][$this->_sections['nr']['index']]['peel_description']; ?>
<BR />
<b><?php echo $this->_tpl_vars['marketing_target_url']; ?>
</b>: <a href="<?php echo $this->_tpl_vars['peel_link_results'][$this->_sections['nr']['index']]['peel_target_url']; ?>
" target="_blank"><?php echo $this->_tpl_vars['peel_link_results'][$this->_sections['nr']['index']]['peel_target_url']; ?>
</a><BR /><BR />
<a href="<?php echo $this->_tpl_vars['peel_link_results'][$this->_sections['nr']['index']]['peel_sample_url']; ?>
" title="<?php echo $this->_tpl_vars['peels_title']; ?>
: <?php echo $this->_tpl_vars['peel_link_results'][$this->_sections['nr']['index']]['peel_link_name']; ?>
" rel="gb_page_center[650, 650]"><?php echo $this->_tpl_vars['peels_view']; ?>
</a>
<BR /><?php echo $this->_tpl_vars['marketing_source_code']; ?>
<BR />
<textarea rows="3" cols="56"><script language="JavaScript1.2" type="text/javascript" src="<?php echo $this->_tpl_vars['peel_link_results'][$this->_sections['nr']['index']]['peel_link_url']; ?>
"></script></textarea>
<BR /><BR />
</td></tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>

<BR />

<?php endfor; endif; ?>

<?php else: ?>


<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">
<table border="0" cellpadding="2" cellspacing="1" width="100%">

<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['menu_page_peels']; ?>
</font></b></td>
</tr>

<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">

<table border="0" cellpadding="0" cellspacing="0" width="100%">
<form method="POST" action="account.php">
<input type="hidden" name="page" value="37">
<tr height="30">
<td width="22%" align="right"><b><?php echo $this->_tpl_vars['marketing_group_title']; ?>
:&nbsp;&nbsp;</b></td>
<td width="43%">
<select size="1" name="peels_picked">
<?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['peels_results']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<option value="<?php echo $this->_tpl_vars['peels_results'][$this->_sections['nr']['index']]['peels_group_id']; ?>
"><?php echo $this->_tpl_vars['peels_results'][$this->_sections['nr']['index']]['peels_group_name']; ?>
</option>
<?php endfor; endif; ?>
</select>
</td>
<td width="35%" align="right"><input type="submit" value="<?php echo $this->_tpl_vars['marketing_button']; ?>
 <?php echo $this->_tpl_vars['menu_page_peels']; ?>
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

<?php if (isset ( $this->_tpl_vars['peels_group_chosen'] )): ?>

<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">
<table border="0" cellpadding="2" cellspacing="1" width="100%">
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['marketing_group_title']; ?>
:</font> <font color="<?php echo $this->_tpl_vars['red_text']; ?>
"><?php echo $this->_tpl_vars['peels_chosen_group_name']; ?>
</font></b></td>
</tr>
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="center">

<?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['peels_link_results']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

<BR />
<table border="0" cellpadding="0" cellspacing="0" width="98%">
<tr>
<td width="100%" colspan="2" height="20">

<b><?php echo $this->_tpl_vars['peels_title']; ?>
</b>: <?php echo $this->_tpl_vars['peels_link_results'][$this->_sections['nr']['index']]['peels_link_name']; ?>
<BR />
<b><?php echo $this->_tpl_vars['peels_description']; ?>
</b>: <?php echo $this->_tpl_vars['peels_link_results'][$this->_sections['nr']['index']]['peels_description']; ?>
<BR />
<b><?php echo $this->_tpl_vars['marketing_target_url']; ?>
</b>: <a href="<?php echo $this->_tpl_vars['peels_link_results'][$this->_sections['nr']['index']]['peels_target_url']; ?>
" target="_blank"><?php echo $this->_tpl_vars['peels_link_results'][$this->_sections['nr']['index']]['peels_target_url']; ?>
</a><BR /><BR />
<a href="<?php echo $this->_tpl_vars['peels_link_results'][$this->_sections['nr']['index']]['peels_sample_url']; ?>
" title="<?php echo $this->_tpl_vars['peels_title']; ?>
: <?php echo $this->_tpl_vars['peels_link_results'][$this->_sections['nr']['index']]['peels_link_name']; ?>
" rel="gb_page_center[650, 650]"><?php echo $this->_tpl_vars['peels_view']; ?>
</a>
<br /><?php echo $this->_tpl_vars['marketing_source_code']; ?>
<BR />
<textarea rows="3" cols="56"><script language="JavaScript1.2" type="text/javascript" src="<?php echo $this->_tpl_vars['peels_link_results'][$this->_sections['nr']['index']]['peels_link_url']; ?>
"></script></textarea><BR /><BR />
<hr noshade color="<?php echo $this->_tpl_vars['table_top']; ?>
" size="1">
</td>
</tr>
</table>

<?php endfor; endif; ?>

</td>
</tr>
</table>
</td>
</tr>
</table>

<BR />

<?php else: ?>

<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">
<table border="0" cellpadding="2" cellspacing="1" width="100%">
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['marketing_no_group']; ?>
</font></b></td>
</tr>
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="center"><BR /><BR /><b><?php echo $this->_tpl_vars['marketing_choose']; ?>
</b><BR /><BR /><font color="<?php echo $this->_tpl_vars['red_text']; ?>
"><?php echo $this->_tpl_vars['marketing_notice']; ?>
</font><BR /><BR /><BR /></td>
</tr>
</table>
</td>
</tr>
</table>

<BR />

<?php endif; ?>

<?php endif; ?>