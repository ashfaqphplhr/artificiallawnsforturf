<?php /* Smarty version 2.6.14, created on 2013-09-30 03:56:40
         compiled from file:account_commission_list.tpl */ ?>

<?php if (isset ( $this->_tpl_vars['commission_group_chosen'] )): ?>

<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">
<table border="0" cellpadding="2" cellspacing="1" width="100%">
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
" colspan="4">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['commission_group_name']; ?>
</font></b></td>
</tr>

<?php if (isset ( $this->_tpl_vars['commission_results_exist'] )): ?>

<tr>
<td width="20%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
"><b>&nbsp;<?php echo $this->_tpl_vars['details_date']; ?>
</b></td>
<td width="40%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
"><b>&nbsp;<?php echo $this->_tpl_vars['details_status']; ?>
</b></td>
<td width="20%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
"><b>&nbsp;<?php echo $this->_tpl_vars['details_commission']; ?>
</b></td>
<td width="20%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="right"><b><?php echo $this->_tpl_vars['details_details']; ?>
&nbsp; </b></td>
</tr>

<?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['commission_group_results']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<td width="20%">&nbsp;<?php echo $this->_tpl_vars['commission_group_results'][$this->_sections['nr']['index']]['commission_results_date']; ?>
</td>
<td width="40%">&nbsp;<?php echo $this->_tpl_vars['commission_group_results'][$this->_sections['nr']['index']]['commission_results_type']; ?>
</td>
<td width="20%">&nbsp;<?php if ($this->_tpl_vars['cur_sym_location'] == 1):  echo $this->_tpl_vars['cur_sym'];  endif;  echo $this->_tpl_vars['commission_group_results'][$this->_sections['nr']['index']]['commission_results_amount'];  if ($this->_tpl_vars['cur_sym_location'] == 2): ?> <?php echo $this->_tpl_vars['cur_sym'];  endif; ?> <?php echo $this->_tpl_vars['currency']; ?>
</td>
<td width="20%" align="right"><a href=account.php?page=22&type=<?php echo $this->_tpl_vars['commission_group_results'][$this->_sections['nr']['index']]['commission_results_record_type']; ?>
&id=<?php echo $this->_tpl_vars['commission_group_results'][$this->_sections['nr']['index']]['commission_results_record_id']; ?>
><?php echo $this->_tpl_vars['details_details']; ?>
</a>&nbsp; </td>
</tr>

<?php endfor; endif; ?>

<?php else: ?>

<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['details_none']; ?>
<BR /><BR /></td>
</tr>

<?php endif; ?>

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
"><?php echo $this->_tpl_vars['details_no_group']; ?>
</font></b></td>
</tr>
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="center"><BR /><BR /><b><?php echo $this->_tpl_vars['details_choose']; ?>
</b><BR /><BR /><BR /></td>
</tr>
</table>
</td>
</tr>
</table>

<?php endif; ?>

<BR />