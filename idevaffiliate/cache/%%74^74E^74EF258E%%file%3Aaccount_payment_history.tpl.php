<?php /* Smarty version 2.6.14, created on 2013-10-22 02:42:29
         compiled from file:account_payment_history.tpl */ ?>

<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">
<table border="0" cellpadding="2" cellspacing="1" width="100%">
<tr>
<td width="100%" colspan="4" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['payment_title']; ?>
</font></b></td>
</tr>

<?php if (isset ( $this->_tpl_vars['payment_history_exists'] )): ?>

<tr>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
"><b>&nbsp;<?php echo $this->_tpl_vars['payment_date']; ?>
</b></td>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="right"><b><?php echo $this->_tpl_vars['payment_commissions']; ?>
</b>&nbsp; </td>
<td width="35%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="right"><b><?php echo $this->_tpl_vars['payment_amount']; ?>
</b>&nbsp; </td>
<td width="15%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
"></td>
</tr>

<?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['payment_results']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<td width="25%">&nbsp;<?php echo $this->_tpl_vars['payment_results'][$this->_sections['nr']['index']]['payment_date']; ?>
</td>
<td width="25%" align="right"><?php echo $this->_tpl_vars['payment_results'][$this->_sections['nr']['index']]['payment_total']; ?>
&nbsp; </td>
<td width="35%" align="right"><?php if ($this->_tpl_vars['cur_sym_location'] == 1):  echo $this->_tpl_vars['cur_sym'];  endif;  echo $this->_tpl_vars['payment_results'][$this->_sections['nr']['index']]['payment_amount'];  if ($this->_tpl_vars['cur_sym_location'] == 2): ?> <?php echo $this->_tpl_vars['cur_sym'];  endif; ?> <?php echo $this->_tpl_vars['currency']; ?>
&nbsp; </td>
<td width="15%" align="center"><form method="post" action="invoice.php" target="_blank">

<?php if ($this->_tpl_vars['invoice_enabled']): ?>
<input type="hidden" name="stamp" value="<?php echo $this->_tpl_vars['payment_results'][$this->_sections['nr']['index']]['payment_stamp']; ?>
">
<input type="submit" value="<?php echo $this->_tpl_vars['invoice_button']; ?>
" name="print_invoice" class="button">&nbsp; 
<?php endif; ?>

</td></form>
</tr>

<?php endfor; endif; ?>

<tr>
<td width="25%" height="25" bgcolor="<?php echo $this->_tpl_vars['light_cells']; ?>
">&nbsp;<b><?php echo $this->_tpl_vars['payment_totals']; ?>
</b></td>
<td width="25%" height="25" bgcolor="<?php echo $this->_tpl_vars['light_cells']; ?>
" align="right"><b><?php echo $this->_tpl_vars['payments_total']; ?>
</b>&nbsp; </td>
<td width="35%" height="25" bgcolor="<?php echo $this->_tpl_vars['light_cells']; ?>
" align="right"><font color="<?php echo $this->_tpl_vars['red_text']; ?>
"><b><?php if ($this->_tpl_vars['cur_sym_location'] == 1):  echo $this->_tpl_vars['cur_sym'];  endif;  echo $this->_tpl_vars['payments_archived'];  if ($this->_tpl_vars['cur_sym_location'] == 2): ?> <?php echo $this->_tpl_vars['cur_sym'];  endif; ?> <?php echo $this->_tpl_vars['currency']; ?>
</b></font>&nbsp; </td>
<td width="15%" height="25" bgcolor="<?php echo $this->_tpl_vars['light_cells']; ?>
"></td>
</tr>

<?php else: ?>

<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['payment_none']; ?>
<BR /><BR /></td>
</tr>

<?php endif; ?>

</table>
</td>
</tr>
</table>

<BR />