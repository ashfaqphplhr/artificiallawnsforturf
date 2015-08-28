<?php /* Smarty version 2.6.14, created on 2013-10-22 02:13:36
         compiled from file:account_html_ads.tpl */ ?>
<?php if (isset ( $this->_tpl_vars['one_click_delivery'] )): ?>

<?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['html_link_results']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
: <?php echo $this->_tpl_vars['html_link_results'][$this->_sections['nr']['index']]['html_group_name']; ?>
</b></td>
</tr>
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="center">
<BR />
<table border="0" cellpadding="0" cellspacing="0" width="98%">
<tr>
<td width="100%" colspan="2" height="20">
<b><?php echo $this->_tpl_vars['html_name']; ?>
</b>: <?php echo $this->_tpl_vars['html_link_results'][$this->_sections['nr']['index']]['html_link_name']; ?>
<BR />
<b><?php echo $this->_tpl_vars['marketing_target_url']; ?>
</b>: <a href="<?php echo $this->_tpl_vars['html_link_results'][$this->_sections['nr']['index']]['html_target_url']; ?>
" target="_blank"><?php echo $this->_tpl_vars['html_link_results'][$this->_sections['nr']['index']]['html_target_url']; ?>
</a><BR /><BR />
<a href="<?php echo $this->_tpl_vars['base_url']; ?>
/adview.php?id=<?php echo $this->_tpl_vars['html_link_results'][$this->_sections['nr']['index']]['html_link_id']; ?>
" target="_blank"><?php echo $this->_tpl_vars['html_view_link']; ?>
</a><BR />
<?php echo $this->_tpl_vars['marketing_source_code']; ?>
<BR />
<textarea rows="3" cols="56"><?php echo $this->_tpl_vars['html_link_results'][$this->_sections['nr']['index']]['html_link_url']; ?>
</textarea><BR /><BR />
</td>
</tr>
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

<table border="0" cellspacing="0" width="95%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">
<table border="0" cellpadding="2" cellspacing="1" width="100%">
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['menu_html_links']; ?>
</font></b></td>
</tr>
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<form method="POST" action="account.php">
<input type="hidden" name="page" value="23">
<tr height="30">
<td width="22%" align="right"><b><?php echo $this->_tpl_vars['marketing_group_title']; ?>
:&nbsp;&nbsp;</b></td>
<td width="43%">
<select size="1" name="html_picked">
<?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['htmlad_results']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<option value="<?php echo $this->_tpl_vars['htmlad_results'][$this->_sections['nr']['index']]['htmlad_group_id']; ?>
"><?php echo $this->_tpl_vars['htmlad_results'][$this->_sections['nr']['index']]['htmlad_group_name']; ?>
</option>
<?php endfor; endif; ?>
</select>
</td>
<td width="35%" align="right"><input type="submit" value="<?php echo $this->_tpl_vars['marketing_button']; ?>
 <?php echo $this->_tpl_vars['menu_html_links']; ?>
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

<?php if (isset ( $this->_tpl_vars['html_group_chosen'] )): ?>

<table border="0" cellspacing="0" width="95%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">
<table border="0" cellpadding="2" cellspacing="1" width="100%">
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['marketing_group_title']; ?>
:</font> <font color="<?php echo $this->_tpl_vars['red_text']; ?>
"><?php echo $this->_tpl_vars['html_chosen_group_name']; ?>
</font></b></td>
</tr>
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="center">

<?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['html_link_results']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 echo '
<script type="text/javascript">
function openpopup(popurl){
var winpops=window.open(popurl,"","width=100%,height=100%,directories,status,scrollbars,resizable") }
</script>
'; ?>


<BR />
<table border="0" cellpadding="0" cellspacing="0" width="98%">
<tr>
<td width="100%" colspan="2" height="20">
<b><?php echo $this->_tpl_vars['html_link_results'][$this->_sections['nr']['index']]['html_link_name']; ?>
</b><BR />
<a href="<?php echo $this->_tpl_vars['base_url']; ?>
/adview.php?id=<?php echo $this->_tpl_vars['html_link_results'][$this->_sections['nr']['index']]['html_link_id']; ?>
" target="_blank"><?php echo $this->_tpl_vars['html_view_link']; ?>
</a><BR /><BR />
<?php echo $this->_tpl_vars['marketing_source_code']; ?>
<BR />
<textarea rows="3" cols="56"><?php echo $this->_tpl_vars['html_link_results'][$this->_sections['nr']['index']]['html_link_url']; ?>
</textarea><BR /><BR />
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

<table border="0" cellspacing="0" width="95%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
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