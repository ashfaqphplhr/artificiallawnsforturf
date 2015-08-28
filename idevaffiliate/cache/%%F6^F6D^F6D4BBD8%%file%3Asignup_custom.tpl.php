<?php /* Smarty version 2.6.14, created on 2013-09-22 22:57:25
         compiled from file:signup_custom.tpl */ ?>

<tr><td width="100%" colspan="4" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><b><?php echo $this->_tpl_vars['custom_fields_title']; ?>
</b></font></td></tr>

<?php 

$getcellcolor = mysql_query("select lighter_cells from idevaff_colors");
$lighter_cells = mysql_fetch_array($getcellcolor);
$lighter_cells = $lighter_cells[lighter_cells];
$getcustomrows = mysql_query("select name, title, def_value from idevaff_form_fields_custom order by sort");
if (mysql_num_rows($getcustomrows)) {
while ($qry = mysql_fetch_array($getcustomrows)) {
$custom_title = $qry['title'];
$custom_name = $qry['name'];
$custom_value = $qry['def_value'];
if ($_POST[$custom_name]) { $custom_value = quote_smart($_POST[$custom_name]); } else { $custom_value = "$custom_value"; }
echo "<tr>";
echo "<td width='25%' bgcolor='{$lighter_cells}'>&nbsp;{$custom_title}</td>";
echo "<td width='75%' bgcolor='{$lighter_cells}' colspan='3'>&nbsp;<input type='text' name='{$custom_name}' size='20' value='{$custom_value}' style='width:250px'></td>";
echo "</tr>"; } }

 ?>

<tr><td width="100%" colspan="4" height="5"></td></tr>