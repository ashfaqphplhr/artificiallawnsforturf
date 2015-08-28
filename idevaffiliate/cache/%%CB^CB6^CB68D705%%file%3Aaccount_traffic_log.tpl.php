<?php /* Smarty version 2.6.14, created on 2013-11-26 11:30:58
         compiled from file:account_traffic_log.tpl */ ?>

<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['traffic_title']; ?>
</font></b></td>
</tr>
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<form method="POST" action="account.php">
<input type="hidden" name="page" value="6">
<tr height="30">
	<td width="70%" align="right"><b><?php echo $this->_tpl_vars['traffic_display']; ?>
</b>&nbsp; 
	<select size="1" name="cut">
        <option value="10"<?php echo $this->_tpl_vars['cut_10']; ?>
>10</option>
        <option value="25"<?php echo $this->_tpl_vars['cut_25']; ?>
>25</option>
        <option value="50"<?php echo $this->_tpl_vars['cut_50']; ?>
>50</option>
        <option value="100"<?php echo $this->_tpl_vars['cut_100']; ?>
>100</option>
	  <option value="250"<?php echo $this->_tpl_vars['cut_250']; ?>
>250</option>
	  <option value="500"<?php echo $this->_tpl_vars['cut_500']; ?>
>500</option>
	</select>&nbsp; <b><?php echo $this->_tpl_vars['traffic_display_visitors']; ?>
</b>
</td>
<td width="30%" align="right"><input type="submit" value="<?php echo $this->_tpl_vars['traffic_button']; ?>
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

<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%" colspan="4">
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<tr>
<td width="100%" colspan="4" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['traffic_title_details']; ?>
</font></b></td>
</tr>

<?php if (isset ( $this->_tpl_vars['traffic_logs_exist'] )): ?>

<tr>
<td width="18%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
"><b>&nbsp;<?php echo $this->_tpl_vars['traffic_ip']; ?>
</b></td>
<td width="54%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
"><b>&nbsp;<?php echo $this->_tpl_vars['traffic_refer']; ?>
</b></td>
<td width="14%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
"><b>&nbsp;<?php echo $this->_tpl_vars['traffic_date']; ?>
</b></td>
<td width="14%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
"><b>&nbsp;<?php echo $this->_tpl_vars['traffic_time']; ?>
&nbsp; </b></td>
</tr>

<?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['traffic_results']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

<tr <?php if (!(1 & $this->_sections['nr']['iteration'])): ?> bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
"<?php else: ?>bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
"<?php endif; ?>>
<td width="18%">&nbsp;<?php echo $this->_tpl_vars['traffic_results'][$this->_sections['nr']['index']]['traffic_ip']; ?>
</td>
<td width="54%">&nbsp;<?php echo $this->_tpl_vars['traffic_results'][$this->_sections['nr']['index']]['traffic_refer']; ?>
</td>
<td width="14%">&nbsp;<?php echo $this->_tpl_vars['traffic_results'][$this->_sections['nr']['index']]['traffic_date']; ?>
</td>
<td width="14%">&nbsp;<?php echo $this->_tpl_vars['traffic_results'][$this->_sections['nr']['index']]['traffic_time']; ?>
</td>

</tr>

<?php endfor; endif; ?>

<tr>
<td width="100%" colspan="4" align="center" height="35" bgcolor="<?php echo $this->_tpl_vars['light_cells']; ?>
"><b><?php echo $this->_tpl_vars['traffic_bottom_tag_one']; ?>
 <?php echo $this->_tpl_vars['search_limit']; ?>
 <?php echo $this->_tpl_vars['traffic_bottom_tag_two']; ?>
 <?php echo $this->_tpl_vars['search_total']; ?>
 <?php echo $this->_tpl_vars['traffic_bottom_tag_three']; ?>
</b></td>
</tr>

<?php else: ?>

<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['traffic_none']; ?>
<BR /><BR /></td>
</tr>

<?php endif; ?>

</table>
</td>
</tr>
</table>

<BR />