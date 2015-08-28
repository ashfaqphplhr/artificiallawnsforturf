<?php /* Smarty version 2.6.14, created on 2013-11-26 11:43:47
         compiled from file:account_commission_alert.tpl */ ?>

<table border="0" cellspacing="0" width="95%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['commissionalert_title']; ?>
</font></b></td>
</tr>
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" colspan="2" align="center">
<table border="0" cellpadding="0" cellspacing="0" width="98%">
<tr>
<td width="100%"><br /><?php echo $this->_tpl_vars['commissionalert_info']; ?>
</td>
</tr>
</table>

<BR />

  <table border="0" cellspacing="1" width="95%">
    <tr>
      <td width="100%" colspan=3>&nbsp;<b><?php echo $this->_tpl_vars['commissionalert_hint']; ?>
</b></td>
    </tr>
    <tr>
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['commissionalert_profile']; ?>
:</td>
      <td width="35%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<input type="text" size="20" value="<?php echo $this->_tpl_vars['sitename']; ?>
"></td>
      <td width="40%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
" rowspan="4" align="center"><img border="0" src="images/ca1.gif" width="148" height="59"></td>
    </tr>
    <tr>
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['commissionalert_username']; ?>
:</td>
      <td width="35%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<input type="text" size="20" value="<?php echo $this->_tpl_vars['username']; ?>
"></td>
    </tr>
    <tr height="25">
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['commissionalert_password']; ?>
:</td>
      <td width="35%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<font color="#707070">[<?php echo $this->_tpl_vars['account_hidden']; ?>
]</font></td>
    </tr>
    <tr>
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['commissionalert_id']; ?>
:</td>
      <td width="35%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<input type="text" size="20" value="<?php echo $this->_tpl_vars['link_id']; ?>
"></td>
    </tr>
    <tr>
      <td width="25%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['commissionalert_source']; ?>
:</td>
      <td width="75%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
" colspan="2">&nbsp;<input type="text" size="50" value="<?php echo $this->_tpl_vars['base_url']; ?>
/"></td>
    </tr>
  </table>

<BR />

</td></tr>
<tr>
<form method="POST" action="commissionalert/download.php">
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
" align="center" height="40" valign="middle">
<input type="hidden" name="affid" value="<?php echo $this->_tpl_vars['link_id']; ?>
">
<input type="submit" value="<?php echo $this->_tpl_vars['commissionalert_download']; ?>
">
</td></form>
</tr>
</table>
</td>
</tr>
</table>

<BR />