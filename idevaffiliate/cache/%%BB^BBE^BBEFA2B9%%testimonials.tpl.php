<?php /* Smarty version 2.6.14, created on 2013-08-23 07:21:31
         compiled from testimonials.tpl */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table align="<?php echo $this->_tpl_vars['page_align']; ?>
" border="0" cellspacing="0" width="<?php echo $this->_tpl_vars['panel_width'];  echo $this->_tpl_vars['joinperc']; ?>
" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
">
<tr>
<td>
<table border="0" cellpadding="4" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">

<?php if (isset ( $this->_tpl_vars['testimonials'] ) && ( isset ( $this->_tpl_vars['testimonials_active'] ) )): ?>

<tr>
<td width="100%">

<?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['testi_results']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

<table border="0" cellpadding="15" cellspacing="4" width="100%">
<tr <?php if ((1 & $this->_sections['nr']['iteration'])): ?> bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
"<?php else: ?>bgcolor="<?php echo $this->_tpl_vars['light_cells']; ?>
"<?php endif; ?>>
<td width="100%">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr><td width="100%">"<i><?php echo $this->_tpl_vars['testi_results'][$this->_sections['nr']['index']]['testimonial']; ?>
</i>"</td></tr>
<tr><td width="100%" height="10"></td></tr>
<tr><td width="100%" align="right"><?php echo $this->_tpl_vars['testi_results'][$this->_sections['nr']['index']]['affiliate_name'];  if (isset ( $this->_tpl_vars['show_testimonials_link'] )): ?> - <a href="<?php echo $this->_tpl_vars['testi_results'][$this->_sections['nr']['index']]['website_url']; ?>
" target="_blank"><?php echo $this->_tpl_vars['testi_visit']; ?>
</a><?php endif; ?></td></tr>
</table>
</td>
</tr>
</table>

<?php endfor; endif; ?>

</td>
</tr>


<tr>
<td width="100%">

  <table border="0" cellpadding="10" cellspacing="10" width="100%">
    <tr>
      <td width="37%" align="right"><a href="login.php"><img border="0" src="images/affiliate_login.gif" width="188" height="56"></a></td>
      <td width="26%" align="center"><a href="signup.php"><img border="0" src="images/affiliate_signup.gif" width="188" height="56"></a></td>
      <td width="37%"><a href="contact.php"><img border="0" src="images/affiliate_contact.gif" width="188" height="56"></a></td>
    </tr>
  </table>

  </td>
</tr>

<?php else: ?>

<tr>
<td width="100%"><center><br /><br /><?php echo $this->_tpl_vars['testi_na']; ?>
<br /><br /><br /></td>
</tr>

<?php endif; ?>

</table>
</td>
</tr>
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
