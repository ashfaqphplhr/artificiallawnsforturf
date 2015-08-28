<?php /* Smarty version 2.6.14, created on 2013-09-22 22:57:33
         compiled from file:account_menu.tpl */ ?>

<table border="0" cellpadding="0" cellspacing="1" width="100%">

	
<?php if (isset ( $this->_tpl_vars['training_materials'] )): ?>
<tr class="menu_text_indent_5">
<td width="100%" height="20" bgcolor="<?php echo $this->_tpl_vars['logged_menu']; ?>
"><b><?php echo $this->_tpl_vars['menu_heading_training_materials']; ?>
</b></td>
</tr>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['training_videos'] )): ?>
<tr class="menu_text_indent_10">
<td width="100%" height="20" bgcolor="<?php echo $this->_tpl_vars['logged_menu']; ?>
"><img border="0" src="images/bullet.gif" width="8" height="8">&nbsp;
<a href="account.php?page=39"><font color="<?php echo $this->_tpl_vars['red_text']; ?>
"><?php echo $this->_tpl_vars['menu_videos']; ?>
</font></a></td>
</tr>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['pdf_training_count'] )): ?>
<tr class="menu_text_indent_10">
<td width="100%" height="20" bgcolor="<?php echo $this->_tpl_vars['logged_menu']; ?>
"><img border="0" src="images/bullet.gif" width="8" height="8">&nbsp;
<a href="account.php?page=25"><font color="<?php echo $this->_tpl_vars['menu_links']; ?>
"><?php echo $this->_tpl_vars['menu_pdf_training']; ?>
</font></a></td>
</tr>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['custom_tracking_enabled'] )): ?>
<tr class="menu_text_indent_10">
<td width="100%" height="20" bgcolor="<?php echo $this->_tpl_vars['logged_menu']; ?>
"><img border="0" src="images/bullet.gif" width="8" height="8">&nbsp;
<a href="http://www.idevlibrary.com/docs/Custom_Links.pdf" target="_blank"><font color="<?php echo $this->_tpl_vars['menu_links']; ?>
"><?php echo $this->_tpl_vars['menu_custom_manual']; ?>
</font></a></td>
</tr>
<?php endif; ?>

	
<tr class="menu_text_indent_5">
<td width="100%" height="20" bgcolor="<?php echo $this->_tpl_vars['logged_menu']; ?>
"><b><?php echo $this->_tpl_vars['menu_heading_marketing']; ?>
</b></td>
</tr>

<?php if (isset ( $this->_tpl_vars['banner_count'] )): ?>
<tr class="menu_text_indent_10">
<td width="85%" height="20" bgcolor="<?php echo $this->_tpl_vars['logged_menu']; ?>
"><img border="0" src="images/bullet_red.gif" width="8" height="8">&nbsp;
<a href="account.php?page=7"><font color="<?php echo $this->_tpl_vars['menu_links']; ?>
"><?php echo $this->_tpl_vars['menu_banners']; ?>
</font></a></td>
</tr>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['page_peel_count'] )): ?>
<tr class="menu_text_indent_10">
<td width="100%" height="20" bgcolor="<?php echo $this->_tpl_vars['logged_menu']; ?>
"><img border="0" src="images/bullet_red.gif" width="8" height="8">&nbsp;
<a href="account.php?page=37"><font color="<?php echo $this->_tpl_vars['menu_links']; ?>
"><?php echo $this->_tpl_vars['menu_page_peels']; ?>
</font></a></td>
</tr>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['lightbox_count'] )): ?>
<tr class="menu_text_indent_10">
<td width="100%" height="20" bgcolor="<?php echo $this->_tpl_vars['logged_menu']; ?>
"><img border="0" src="images/bullet_red.gif" width="8" height="8">&nbsp;
<a href="account.php?page=38"><font color="<?php echo $this->_tpl_vars['menu_links']; ?>
"><?php echo $this->_tpl_vars['menu_lightboxes']; ?>
</font></a></td>
</tr>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['textad_count'] )): ?>
<tr class="menu_text_indent_10">
<td width="100%" height="20" bgcolor="<?php echo $this->_tpl_vars['logged_menu']; ?>
"><img border="0" src="images/bullet_red.gif" width="8" height="8">&nbsp;
<a href="account.php?page=8"><font color="<?php echo $this->_tpl_vars['menu_links']; ?>
"><?php echo $this->_tpl_vars['menu_text_ads']; ?>
</font></a></td>
</tr>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['htmlcount'] )): ?>
<tr class="menu_text_indent_10">
<td width="100%" height="20" bgcolor="<?php echo $this->_tpl_vars['logged_menu']; ?>
"><img border="0" src="images/bullet_red.gif" width="8" height="8">&nbsp;
<a href="account.php?page=23"><font color="<?php echo $this->_tpl_vars['menu_links']; ?>
"><?php echo $this->_tpl_vars['menu_html_links']; ?>
</font></a></td>
</tr>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['textlink_count'] )): ?>
<tr class="menu_text_indent_10">
<td width="100%" height="20" bgcolor="<?php echo $this->_tpl_vars['logged_menu']; ?>
"><img border="0" src="images/bullet_red.gif" width="8" height="8">&nbsp;
<a href="account.php?page=9"><font color="<?php echo $this->_tpl_vars['menu_links']; ?>
"><?php echo $this->_tpl_vars['menu_text_links']; ?>
</font></a></td>
</tr>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['email_links_available'] )): ?>
<tr class="menu_text_indent_10">
<td width="100%" height="20" bgcolor="<?php echo $this->_tpl_vars['logged_menu']; ?>
"><img border="0" src="images/bullet_red.gif" width="8" height="8">&nbsp;
<a href="account.php?page=10"><font color="<?php echo $this->_tpl_vars['menu_links']; ?>
"><?php echo $this->_tpl_vars['menu_email_links']; ?>
</font></a></td>
</tr>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['etemplates_count'] )): ?>
<tr class="menu_text_indent_10">
<td width="100%" height="20" bgcolor="<?php echo $this->_tpl_vars['logged_menu']; ?>
"><img border="0" src="images/bullet_red.gif" width="8" height="8">&nbsp;
<a href="account.php?page=28"><font color="<?php echo $this->_tpl_vars['menu_links']; ?>
"><?php echo $this->_tpl_vars['menu_etemplates']; ?>
</font></a></td>
</tr>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['offline_marketing'] )): ?>
<tr class="menu_text_indent_10">
<td width="100%" height="20" bgcolor="<?php echo $this->_tpl_vars['logged_menu']; ?>
"><img border="0" src="images/bullet_red.gif" width="8" height="8">&nbsp;
<a href="account.php?page=11"><font color="<?php echo $this->_tpl_vars['menu_links']; ?>
"><?php echo $this->_tpl_vars['menu_offline']; ?>
</font></a></td>
</tr>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['second_tier'] )): ?>
<tr class="menu_text_indent_10">
<td width="100%" height="20" bgcolor="<?php echo $this->_tpl_vars['logged_menu']; ?>
"><img border="0" src="images/bullet_red.gif" width="8" height="8">&nbsp;
<a href="account.php?page=12"><font color="<?php echo $this->_tpl_vars['menu_links']; ?>
"><?php echo $this->_tpl_vars['menu_tier_linking_code']; ?>
</font></a></td>
</tr>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['pdf_marketing_count'] )): ?>
<tr class="menu_text_indent_10">
<td width="100%" height="20" bgcolor="<?php echo $this->_tpl_vars['logged_menu']; ?>
"><img border="0" src="images/bullet_red.gif" width="8" height="8">&nbsp;
<a href="account.php?page=24"><font color="<?php echo $this->_tpl_vars['menu_links']; ?>
"><?php echo $this->_tpl_vars['menu_pdf_marketing']; ?>
</font></a></td>
</tr>
<?php endif; ?>


	

<?php if (isset ( $this->_tpl_vars['custom_tracking_enabled'] )): ?>
<tr class="menu_text_indent_5">
<td width="100%" height="20" bgcolor="<?php echo $this->_tpl_vars['logged_menu']; ?>
"><b><?php echo $this->_tpl_vars['menu_heading_custom_links']; ?>
</b>
<?php if (isset ( $this->_tpl_vars['custom_links_enabled'] ) || isset ( $this->_tpl_vars['sub_affiliates_enabled'] )): ?>
[ <a href="account.php?page=36"><font color="<?php echo $this->_tpl_vars['red_text']; ?>
"><?php echo $this->_tpl_vars['menu_custom_reports']; ?>
</font></a> ]
<?php endif; ?>
</td>
</tr>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['custom_links_enabled'] )): ?>
<tr class="menu_text_indent_10">
<td width="100%" height="20" bgcolor="<?php echo $this->_tpl_vars['logged_menu']; ?>
"><img border="0" src="images/bullet_blue.gif" width="8" height="8">&nbsp;
<a href="account.php?page=14"><font color="<?php echo $this->_tpl_vars['menu_links']; ?>
"><?php echo $this->_tpl_vars['menu_keyword_links']; ?>
</font></a></td>
</tr>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['sub_affiliates_enabled'] )): ?>
<tr class="menu_text_indent_10">
<td width="100%" height="20" bgcolor="<?php echo $this->_tpl_vars['logged_menu']; ?>
"><img border="0" src="images/bullet_blue.gif" width="8" height="8">&nbsp;
<a href="account.php?page=26"><font color="<?php echo $this->_tpl_vars['menu_links']; ?>
"><?php echo $this->_tpl_vars['menu_subid_links']; ?>
</font></a></td>
</tr>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['alternate_keywords_enabled'] )): ?>
<tr class="menu_text_indent_10">
<td width="100%" height="20" bgcolor="<?php echo $this->_tpl_vars['logged_menu']; ?>
"><img border="0" src="images/bullet_blue.gif" width="8" height="8">&nbsp;
<a href="account.php?page=35"><font color="<?php echo $this->_tpl_vars['menu_links']; ?>
"><?php echo $this->_tpl_vars['menu_alteranate_links']; ?>
</font></a></td>
</tr>
<?php endif; ?>

	
<?php if (( isset ( $this->_tpl_vars['commission_alert'] ) )): ?>
<tr class="menu_text_indent_5">
<td width="100%" height="20" bgcolor="<?php echo $this->_tpl_vars['logged_menu']; ?>
"><b><?php echo $this->_tpl_vars['menu_heading_additional']; ?>
</b></td>
</tr>

<tr class="menu_text_indent_10">
<td width="100%" height="20" bgcolor="<?php echo $this->_tpl_vars['logged_menu']; ?>
"><img border="0" src="images/bullet_white.gif" width="8" height="8">&nbsp;
<a href="account.php?page=15"><font color="<?php echo $this->_tpl_vars['menu_links']; ?>
"><?php echo $this->_tpl_vars['menu_comalert']; ?>
</font></a>
</td>
</tr>
<?php endif; ?>

</table>