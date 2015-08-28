<?php /* Smarty version 2.6.14, created on 2013-09-22 22:57:33
         compiled from account.tpl */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if (isset ( $this->_tpl_vars['re_accept'] )):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:tandc_re-accept.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  else: ?>

<table align="<?php echo $this->_tpl_vars['page_align']; ?>
" border="0" cellspacing="0" width="<?php echo $this->_tpl_vars['panel_width'];  echo $this->_tpl_vars['joinperc']; ?>
" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
">
<tr>
<td>
<table border="0" cellpadding="4" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">
<tr>
<td width="100%">

<table border="0" cellspacing="1" width="100%" cellpadding="2">
<tr>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<?php echo $this->_tpl_vars['account_total_transactions']; ?>
</td>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['light_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['total_transactions']; ?>
</td>
<td width="50%" rowspan="5" valign="middle" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="center">
<?php if ($this->_tpl_vars['linking_code'] == 'available'): ?>
<b><?php echo $this->_tpl_vars['account_standard_linking_code']; ?>
</b></BR ><textarea rows="2" cols="40"><?php echo $this->_tpl_vars['box_code']; ?>
</textarea><BR /><?php echo $this->_tpl_vars['account_copy_paste']; ?>

<?php elseif ($this->_tpl_vars['linking_code'] == 'pending_approval'): ?>
<b><font color="<?php echo $this->_tpl_vars['red_text']; ?>
"><?php echo $this->_tpl_vars['account_not_approved']; ?>
</font></b>
<?php elseif ($this->_tpl_vars['linking_code'] == 'account_suspended'): ?>
<b><font color="<?php echo $this->_tpl_vars['red_text']; ?>
"><?php echo $this->_tpl_vars['account_suspended']; ?>
</font></b>
<?php endif; ?>
</td>
</tr>

<tr>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<?php echo $this->_tpl_vars['account_standard_earnings']; ?>
</td>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['light_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['standard_amount_earnings']; ?>
 <?php if (isset ( $this->_tpl_vars['insert_bonus'] )):  echo $this->_tpl_vars['account_inc_bonus'];  endif; ?></td>
</tr>
<tr>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<?php echo $this->_tpl_vars['account_second_tier']; ?>
</td>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['light_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['tier_amount_earned']; ?>
</td>
</tr>
<tr>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<?php echo $this->_tpl_vars['account_recurring']; ?>
</td>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['light_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['recurring_amount_earned']; ?>
</td>
</tr>
<tr>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><?php echo $this->_tpl_vars['account_earned_todate']; ?>
</b></td>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['light_cells']; ?>
"><b>&nbsp;<?php echo $this->_tpl_vars['total_amount_earned']; ?>
</b></td>
</tr>
</table>

<div align="center">
<table border="0" cellspacing="1" cellpadding="1" width="100%">
<tr>
<td width="25%" valign="top" bgcolor="<?php echo $this->_tpl_vars['light_cells']; ?>
"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_menu.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
<td width="75%" valign="top">


<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr><td width="100%" align="center">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:menu_items.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</td></tr>
</table>



<div align="center"><table border="0" cellspacing="0" width="100%" cellpadding="0">
<tr><td width="100%" height="10"></td></tr><tr><td width="100%"><div align="center">
<table border="0" cellpadding="0" cellspacing="0" width="98%"><tr><td width="100%" align="center">

<?php if (isset ( $this->_tpl_vars['page_not_authorized'] )):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_pending_approval.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php elseif (isset ( $this->_tpl_vars['affiliate_suspended'] )):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_suspended.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php else: ?>

<?php if ($this->_tpl_vars['internal_page'] == 1):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_general_stats.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 2):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_tier_stats.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 3):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_payment_history.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 4):  if (isset ( $this->_tpl_vars['sub_affiliates_enabled'] )):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_commission_list_subs.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  else:  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_commission_list.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif;  elseif ($this->_tpl_vars['internal_page'] == 5):  if (isset ( $this->_tpl_vars['sub_affiliates_enabled'] )):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_recurring_commissions_subs.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  else:  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_recurring_commissions.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif;  elseif ($this->_tpl_vars['internal_page'] == 6):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_traffic_log.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 7):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_banners.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 8):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_text_ads.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 9):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_text_links.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 10):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_email_links.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 11):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_offline_marketing.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 12):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_tier_code.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 13):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_email_friends.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 14):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_keyword_links.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 15):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_commission_alert.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 16):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_commission_stats.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 17):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_edit.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 18):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_change_password.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 19):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_change_commission.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 21):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_faq.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 22):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_commission_details.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 23):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_html_ads.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 24):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_pdf_marketing.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 25):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_pdf_training.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 26):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_sub_affiliates.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 27):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_upload_logo.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 28):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_email_templates.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 29):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_sub_affiliates_test.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 30):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:custom/30.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 31):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:custom/31.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 32):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:custom/32.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 33):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:custom/33.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 34):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:custom/34.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 35):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_alternate_page_links.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 36):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_custom_reports.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 37):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_page_peels.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 38):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_lightboxes.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 39):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:training_videos.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 40):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_direct_links.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  elseif ($this->_tpl_vars['internal_page'] == 41):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_testimonials.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>

<?php endif; ?>

</td></tr></table></div></td></tr> </table></div> </td></tr></table></div>



</td></tr></table></td></tr></table></center>

<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
