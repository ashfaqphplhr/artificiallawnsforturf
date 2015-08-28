<?php /* Smarty version 2.6.14, created on 2013-09-30 04:25:05
         compiled from file:account_pdf_marketing.tpl */ ?>


<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">
<table border="0" cellpadding="1" cellspacing="1" width="100%">

<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['pdf_title']; ?>
 <?php echo $this->_tpl_vars['pdf_marketing']; ?>
</font></b></td>
</tr>
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">
<table border="0" cellpadding="0" cellspacing="0" width="100%">

<tr><td width="100%" height="5" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
"></td></tr>

<tr><td width="100%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">

  <table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
  <td width="75%">&nbsp;<?php echo $this->_tpl_vars['pdf_description_1']; ?>
</td>
  <td width="25%" rowspan="2" align="center"><a target="_blank" href="http://www.adobe.com/products/acrobat/readstep2.html"><img border="0" src="images/get_adobe_reader.gif" width="112" height="33"></a></td>
  </tr>
  <tr>
  <td width="75%">&nbsp;<?php echo $this->_tpl_vars['pdf_description_2']; ?>
</td>
  </tr>
  </table>

</td></tr>
<tr><td width="100%" height="5" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
"></td></tr>

<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
" height="20">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td width="5%"></td>
        <td width="25%"><b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['pdf_file_name']; ?>
</font></b></td>
        <td width="20%"><b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['pdf_file_size']; ?>
</font></b></td>
        <td width="50%"><b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['pdf_file_description']; ?>
</font></b></td>
      </tr>
    </table>
</td>
</tr>

<tr><td width="100%">

<?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['pdf_results']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

<table border="0" cellpadding="2" cellspacing="0" width="100%">

<tr <?php if ((1 & $this->_sections['nr']['iteration'])): ?> bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
"<?php else: ?>bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
"<?php endif; ?>>
<td width="100%">

  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td width="5%" align="center" valign="middle"><img border="0" src="images/pdficon_small.gif" width="17" height="17"></td>
      <td width="25%"><a href="docs/<?php echo $this->_tpl_vars['pdf_results'][$this->_sections['nr']['index']]['pdf_filename']; ?>
" target="_blank"><?php echo $this->_tpl_vars['pdf_results'][$this->_sections['nr']['index']]['pdf_filename']; ?>
</a></td>
      <td width="20%"><?php echo $this->_tpl_vars['pdf_results'][$this->_sections['nr']['index']]['pdf_size']; ?>
 <?php echo $this->_tpl_vars['pdf_bytes']; ?>
</td>
      <td width="50%"><?php echo $this->_tpl_vars['pdf_results'][$this->_sections['nr']['index']]['pdf_desc']; ?>
</td>

    </tr>
  </table>

</td>
</tr>
</table>

<?php endfor; endif; ?>

</td></tr>

</table>
</td>
</tr>
</table>
</td>
</tr>
</table>






<BR />