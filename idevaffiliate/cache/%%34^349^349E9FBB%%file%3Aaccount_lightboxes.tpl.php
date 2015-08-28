<?php /* Smarty version 2.6.14, created on 2013-09-30 04:26:02
         compiled from file:account_lightboxes.tpl */ ?>
<?php if (isset ( $this->_tpl_vars['one_click_delivery'] )): ?>

<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['cp_head_back']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">
<table border="0" cellpadding="2" cellspacing="1" width="100%">
<tr><td width="100%" bgcolor="<?php echo $this->_tpl_vars['cp_head_back']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['lb_head_title']; ?>
</font></b></td></tr>
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="center">
<table border="0" cellpadding="0" cellspacing="0" width="98%">
<tr><td width="100%" height="10"></td></tr>
<tr><td width="100%"><?php echo $this->_tpl_vars['lb_head_description']; ?>
</td></tr>
<tr><td width="100%" height="10"></td></tr>
<tr><td width="100%"><?php echo $this->_tpl_vars['lb_head_source_code']; ?>
<BR />
<textarea rows="3" cols="65"><link rel="stylesheet" href="<?php echo $this->_tpl_vars['install_url']; ?>
/lightboxes/source/css/lightbox.css" type="text/css" />
<script type="text/javascript" language="javascript1.2" src="<?php echo $this->_tpl_vars['install_url']; ?>
/lightboxes/source/js/prototype.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript1.2" src="<?php echo $this->_tpl_vars['install_url']; ?>
/lightboxes/source/js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" language="javascript1.2" src="<?php echo $this->_tpl_vars['install_url']; ?>
/lightboxes/source/js/lightbox.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript1.2">
	var fileLoadingImage = "<?php echo $this->_tpl_vars['install_url']; ?>
/lightboxes/source/images/loading.gif";	
	var fileBottomNavCloseImage = "<?php echo $this->_tpl_vars['install_url']; ?>
/lightboxes/source/images/closelabel.gif";
</script></textarea><BR />
<?php echo $this->_tpl_vars['lb_head_code_notes']; ?>

</td></tr>
<tr><td width="100%" height="10"></td></tr>
<tr><td width="100%"><a href="http://www.idevlibrary.com/docs/Lightboxes.pdf" target="_blank"><b><?php echo $this->_tpl_vars['lb_head_tutorial']; ?>
</b></a></td></tr>
<tr><td width="100%" height="10"></td></tr>
</table>
</td></tr>
</table>
</td>
</tr>
</table>


<br />

<?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['lightbox_link_results']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
: <?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_group_name']; ?>
</b></td>
</tr>
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="center">
<BR />
<table border="0" cellpadding="0" cellspacing="0" width="98%">
<tr><td width="100%" colspan="2" height="20">
<b><?php echo $this->_tpl_vars['lb_body_title']; ?>
</b>: <?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_link_name']; ?>
<BR />
<b><?php echo $this->_tpl_vars['lb_body_description']; ?>
</b>: <?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_description']; ?>
<BR />
<b><?php echo $this->_tpl_vars['marketing_target_url']; ?>
</b>: <a href="<?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_target_url']; ?>
" target="_blank"><?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_target_url']; ?>
</a><BR /><BR />
<a href="lightboxes/<?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_image']; ?>
" width="<?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_main_width']; ?>
" height="<?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_main_height']; ?>
" title="<?php echo $this->_tpl_vars['lightbox_link_text']; ?>
" rev="<?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_link']; ?>
" rel="<?php echo $this->_tpl_vars['lb_rel_values']; ?>
lightbox">
<img src="lightboxes/<?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_thumbnail']; ?>
" width="<?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_thumb_width']; ?>
" height="<?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_thumb_height']; ?>
" border="0" /></a><BR />
<?php echo $this->_tpl_vars['lb_body_click']; ?>
<BR /><BR />
<?php echo $this->_tpl_vars['lb_body_source_code']; ?>
<BR />
<textarea rows="5" cols="65"><?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_code']; ?>
</textarea>
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
"><?php echo $this->_tpl_vars['menu_lightboxes']; ?>
</font></b></td>
</tr>

<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">

<table border="0" cellpadding="0" cellspacing="0" width="100%">
<form method="POST" action="account.php">
<input type="hidden" name="page" value="38">
<tr height="30">
<td width="22%" align="right"><b><?php echo $this->_tpl_vars['marketing_group_title']; ?>
:&nbsp;&nbsp;</b></td>
<td width="43%">
<select size="1" name="lb_picked">
<?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['lb_results']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<option value="<?php echo $this->_tpl_vars['lb_results'][$this->_sections['nr']['index']]['lb_group_id']; ?>
"><?php echo $this->_tpl_vars['lb_results'][$this->_sections['nr']['index']]['lb_group_name']; ?>
</option>
<?php endfor; endif; ?>
</select>
</td>
<td width="35%" align="right"><input type="submit" value="<?php echo $this->_tpl_vars['marketing_button']; ?>
 <?php echo $this->_tpl_vars['menu_lightboxes']; ?>
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

<?php if (isset ( $this->_tpl_vars['lb_group_chosen'] )): ?>

<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['cp_head_back']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">
<table border="0" cellpadding="2" cellspacing="1" width="100%">
<tr><td width="100%" bgcolor="<?php echo $this->_tpl_vars['cp_head_back']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['lb_head_title']; ?>
</font></b></td></tr>
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="center">
<table border="0" cellpadding="0" cellspacing="0" width="98%">
<tr><td width="100%" height="10"></td></tr>
<tr><td width="100%"><?php echo $this->_tpl_vars['lb_head_description']; ?>
</td></tr>
<tr><td width="100%" height="10"></td></tr>
<tr><td width="100%"><?php echo $this->_tpl_vars['lb_head_source_code']; ?>
<BR />
<textarea rows="3" cols="65"><link rel="stylesheet" href="<?php echo $this->_tpl_vars['install_url']; ?>
/lightboxes/source/css/lightbox.css" type="text/css" />
<script type="text/javascript" language="javascript1.2" src="<?php echo $this->_tpl_vars['install_url']; ?>
/lightboxes/source/js/prototype.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript1.2" src="<?php echo $this->_tpl_vars['install_url']; ?>
/lightboxes/source/js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" language="javascript1.2" src="<?php echo $this->_tpl_vars['install_url']; ?>
/lightboxes/source/js/lightbox.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript1.2">
	var fileLoadingImage = "<?php echo $this->_tpl_vars['install_url']; ?>
/lightboxes/source/images/loading.gif";	
	var fileBottomNavCloseImage = "<?php echo $this->_tpl_vars['install_url']; ?>
/lightboxes/source/images/closelabel.gif";
</script></textarea><BR />
<?php echo $this->_tpl_vars['lb_head_code_notes']; ?>

</td></tr>
<tr><td width="100%" height="10"></td></tr>
<tr><td width="100%"><a href="http://www.idevlibrary.com/docs/Lightboxes.pdf" target="_blank"><b><?php echo $this->_tpl_vars['lb_head_tutorial']; ?>
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
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['marketing_group_title']; ?>
:</font> <font color="<?php echo $this->_tpl_vars['red_text']; ?>
"><?php echo $this->_tpl_vars['lb_chosen_group_name']; ?>
</font></b></td>
</tr>
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="center">

<?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['lightbox_link_results']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<b><?php echo $this->_tpl_vars['lb_body_title']; ?>
</b>: <?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_link_name']; ?>
<BR />
<b><?php echo $this->_tpl_vars['lb_body_description']; ?>
</b>: <?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_description']; ?>
<BR />
<b><?php echo $this->_tpl_vars['marketing_target_url']; ?>
</b>: <a href="<?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_target_url']; ?>
" target="_blank"><?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_target_url']; ?>
</a><BR /><BR />
<a href="lightboxes/<?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_image']; ?>
" width="<?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_main_width']; ?>
" height="<?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_main_height']; ?>
" title="<?php echo $this->_tpl_vars['lightbox_link_text']; ?>
" rev="<?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_link']; ?>
" rel="<?php echo $this->_tpl_vars['lb_rel_values']; ?>
lightbox">
<img src="lightboxes/<?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_thumbnail']; ?>
" width="<?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_thumb_width']; ?>
" height="<?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_thumb_height']; ?>
" border="0" /></a><BR />
<?php echo $this->_tpl_vars['lb_body_click']; ?>
<BR /><BR />
<?php echo $this->_tpl_vars['lb_body_source_code']; ?>
<BR />
<textarea rows="5" cols="65"><?php echo $this->_tpl_vars['lightbox_link_results'][$this->_sections['nr']['index']]['lightbox_code']; ?>
</textarea><BR /><BR />
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