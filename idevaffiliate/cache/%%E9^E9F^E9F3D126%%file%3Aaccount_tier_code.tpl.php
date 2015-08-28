<?php /* Smarty version 2.6.14, created on 2013-09-30 04:27:33
         compiled from file:account_tier_code.tpl */ ?>

<?php if (isset ( $this->_tpl_vars['tier_enabled'] )): ?>

<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0">
<tr>
<td width="100%">
<table border="0" cellpadding="2" cellspacing="1" width="100%">
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['tlinks_title']; ?>
</font></b>
</td>
</tr>

<?php if (isset ( $this->_tpl_vars['forced_links'] )): ?>

<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="center">
<table border="0" cellpadding="0" cellspacing="0" width="98%">
<tr><td width="100%" height="10"></td></tr>
<tr><td width="100%"><?php echo $this->_tpl_vars['tlinks_forced_two']; ?>
</td></tr>
<tr><td width="100%" height="10"></td></tr>
</table>
</td>
</tr>


<tr><td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="center"><br />

  <table border="0" cellspacing="1" width="95%">
    <tr height="25">
      <td width="100%" align="center" colspan="2" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
"><textarea rows="2" cols="73">
<?php if (isset ( $this->_tpl_vars['seo_links'] )): ?>
<a href="<?php echo $this->_tpl_vars['seo_url']; ?>
signup-<?php echo $this->_tpl_vars['textads_link'];  echo $this->_tpl_vars['textads_link_html_added']; ?>
"><?php echo $this->_tpl_vars['tlinks_forced_money']; ?>
</a>
<?php else: ?>
<a href="<?php echo $this->_tpl_vars['base_url']; ?>
/index.php?ref=<?php echo $this->_tpl_vars['link_id']; ?>
"><?php echo $this->_tpl_vars['tlinks_forced_money']; ?>
</a>
<?php endif; ?>
</textarea></font></td>
    </tr>
    <tr height="25">
      <td width="100%" colspan="2" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<font color="#CC0000"><?php echo $this->_tpl_vars['tlinks_forced_paste']; ?>
</font></td>
    </tr>
    <tr height="25">
      <td width="35%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<b><?php echo $this->_tpl_vars['tlinks_active']; ?>
</b></td>
      <td width="65%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['tier_numbers']; ?>
</td>
    </tr>
  </table>
  
<br /></td></tr>

<?php else: ?>

<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="center">
<table border="0" cellpadding="0" cellspacing="0" width="98%">
<tr><td width="100%" height="10"></td></tr>
<tr><td width="100%"><?php echo $this->_tpl_vars['tlinks_embedded_two']; ?>
</td></tr>
<tr><td width="100%" height="10"></td></tr>
</table>
</td>
</tr>


<tr><td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="center"><br />

  <table border="0" cellspacing="1" width="95%">
    <tr height="25">
      <td width="35%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<b><?php echo $this->_tpl_vars['tlinks_forced_code']; ?>
</b></td>
      <td width="65%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<font color="#707070"><?php echo $this->_tpl_vars['tlinks_embedded_one']; ?>
</font></td>
    </tr>
    <tr height="25">
      <td width="35%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<b><?php echo $this->_tpl_vars['tlinks_active']; ?>
</b></td>
      <td width="65%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['tier_numbers']; ?>
</td>
    </tr>

  </table>
  
<br /></td></tr>


<?php endif; ?>

</table>
</td>
</tr>
</table>

<br />

<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0">
<tr>
<td width="100%">
<table border="0" cellpadding="2" cellspacing="1" width="100%">
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['tlinks_payout_structure']; ?>
</font></b></td>
</tr>

<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="center">
<table border="0" cellpadding="0" cellspacing="1" width="95%">
<tr><td width="100%" colspan="2" height="10"></td></tr>

<?php if (isset ( $this->_tpl_vars['tier_1_active'] )): ?>
    <tr height="25">
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<b><?php echo $this->_tpl_vars['tlinks_level']; ?>
 1</b></td>
      <td width="75%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['tier_1_amount'];  echo $this->_tpl_vars['tier_1_type']; ?>
</td>
    </tr>
<?php endif;  if (isset ( $this->_tpl_vars['tier_2_active'] )): ?>
    <tr height="25">
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<b><?php echo $this->_tpl_vars['tlinks_level']; ?>
 2</b></td>
      <td width="75%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['tier_2_amount'];  echo $this->_tpl_vars['tier_2_type']; ?>
</td>
    </tr>
<?php endif;  if (isset ( $this->_tpl_vars['tier_3_active'] )): ?>
    <tr height="25">
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<b><?php echo $this->_tpl_vars['tlinks_level']; ?>
 3</b></td>
      <td width="75%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['tier_3_amount'];  echo $this->_tpl_vars['tier_3_type']; ?>
</td>
    </tr>
<?php endif;  if (isset ( $this->_tpl_vars['tier_4_active'] )): ?>
    <tr height="25">
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<b><?php echo $this->_tpl_vars['tlinks_level']; ?>
 4</b></td>
      <td width="75%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['tier_4_amount'];  echo $this->_tpl_vars['tier_4_type']; ?>
</td>
    </tr>
<?php endif;  if (isset ( $this->_tpl_vars['tier_5_active'] )): ?>
    <tr height="25">
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<b><?php echo $this->_tpl_vars['tlinks_level']; ?>
 5</b></td>
      <td width="75%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['tier_5_amount'];  echo $this->_tpl_vars['tier_5_type']; ?>
</td>
    </tr>
<?php endif;  if (isset ( $this->_tpl_vars['tier_6_active'] )): ?>
    <tr height="25">
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<b><?php echo $this->_tpl_vars['tlinks_level']; ?>
 6</b></td>
      <td width="75%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['tier_6_amount'];  echo $this->_tpl_vars['tier_6_type']; ?>
</td>
    </tr>
<?php endif;  if (isset ( $this->_tpl_vars['tier_7_active'] )): ?>
    <tr height="25">
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<b><?php echo $this->_tpl_vars['tlinks_level']; ?>
 7</b></td>
      <td width="75%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['tier_7_amount'];  echo $this->_tpl_vars['tier_7_type']; ?>
</td>
    </tr>
<?php endif;  if (isset ( $this->_tpl_vars['tier_8_active'] )): ?>
    <tr height="25">
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<b><?php echo $this->_tpl_vars['tlinks_level']; ?>
 8</b></td>
      <td width="75%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['tier_8_amount'];  echo $this->_tpl_vars['tier_8_type']; ?>
</td>
    </tr>
<?php endif;  if (isset ( $this->_tpl_vars['tier_9_active'] )): ?>
    <tr height="25">
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<b><?php echo $this->_tpl_vars['tlinks_level']; ?>
 9</b></td>
      <td width="75%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['tier_9_amount'];  echo $this->_tpl_vars['tier_9_type']; ?>
</td>
    </tr>
<?php endif;  if (isset ( $this->_tpl_vars['tier_10_active'] )): ?>
    <tr height="25">
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<b><?php echo $this->_tpl_vars['tlinks_level']; ?>
 10</b></td>
      <td width="75%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['tier_10_amount'];  echo $this->_tpl_vars['tier_10_type']; ?>
</td>
    </tr>
<?php endif; ?>
<tr><td width="100%" colspan="2" height="10"></td></tr>
</table>
</td>
</tr>



</table>
</td>
</tr>
</table>


<?php endif; ?>

<BR />