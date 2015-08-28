<?php /* Smarty version 2.6.14, created on 2013-09-23 00:04:15
         compiled from file:account_general_stats.tpl */ ?>

<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">
<table border="0" cellpadding="2" cellspacing="1" width="100%">
<tr>
<td width="55%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
" colspan="2">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['general_title']; ?>
</font></b></td>
<td width="45%" align="center" rowspan="11" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
" valign="top">
<?php if (isset ( $this->_tpl_vars['traffic_exists'] )):  
include_once("templates/fusion/Includes/FusionCharts_Gen.php");
  echo '
<SCRIPT LANGUAGE="Javascript" SRC="templates/fusion/FusionCharts/FusionCharts.js"></SCRIPT>'; ?>

<?php 

$checkappforcharts=mysql_query("select id from idevaff_affiliates where username = '" . $_SESSION['idev_LoggedUsername'] . "'");
$resforcharts=mysql_fetch_array($checkappforcharts);
$linkidforcharts=$resforcharts['id'];

$chart_traffic = mysql_query("select COUNT(DISTINCT ip) from idevaff_iptracking where acct_id = '$linkidforcharts'");
$chart_traffic = mysql_fetch_row($chart_traffic);
$chart_traffic = $chart_traffic[0];

$chart_approved = mysql_query("select COUNT(*) from idevaff_sales where approved = '1' and bonus = '0' and id = '$linkidforcharts'");
$chart_approved = mysql_fetch_row($chart_approved);
$chart_approved = $chart_approved[0];

$chart_paid = mysql_query("select COUNT(*) from idevaff_archive where bonus = '0' and id = '$linkidforcharts'");
$chart_paid = mysql_fetch_row($chart_paid);
$chart_paid = $chart_paid[0];

$chart_commissions = $chart_approved + $chart_paid;

$chart_traffic_tag = "Unique Hits";
$chart_commissions_tag = "Total Sales";

	 $FC = new FusionCharts("Column2D","280","180"); 
	 $FC->setSWFPath("templates/fusion/FusionCharts/");
	 
	 $strParam="showDivLineValue=0;canvasBorderColor=FFFFFF;formatNumberScale=0;formatNumber=1;animation=1;decimalPrecision=0;canvasBorderThickness=0;canvasBgColor=FFFFFF;canvasBaseColor=5c5c5c;canvasBaseDepth=1;baseFont=arial;baseFontSize=11;outCnvBaseFont=arial;outCnvBaseFontSze=11;showLegend=1";
	 $FC->setChartParams($strParam);

	 $FC->addChartData($chart_traffic,"name=$chart_traffic_tag");
	 $FC->addChartData($chart_commissions, "name=$chart_commissions_tag");

	 $FC->renderChart();
  endif; ?></td>
</tr>
<tr>
<td width="30%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['general_transactions']; ?>
</td>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['current_transactions']; ?>
</td>

</tr>
<tr>
<td width="30%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['general_standard_earnings']; ?>
</td>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['current_approved_commissions']; ?>

</td>
</tr>
<tr>
<td width="30%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['account_second_tier']; ?>
</td>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['current_tier_commissions']; ?>
</td>
</tr>
<tr>
<td width="30%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['account_recurring']; ?>
</td>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['current_recurring_commissions']; ?>
</td>
</tr>
<tr>
<td width="30%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
"><b>&nbsp;<?php echo $this->_tpl_vars['general_current_earnings']; ?>
</b></td>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
"><b>&nbsp;<?php echo $this->_tpl_vars['current_total_commissions']; ?>
</b></td>
</tr>
<tr>
<td width="55%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
" colspan="2">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['general_traffic_title']; ?>
</font></b></td>
</tr>
<tr>
<td width="30%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['general_traffic_visitors']; ?>
</td>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['hin']; ?>
</td>
</tr>
<tr>
<td width="30%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['general_traffic_unique']; ?>
</td>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['unchits']; ?>
</td>
</tr>
<tr>
<td width="30%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['general_traffic_sales']; ?>
</td>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['white_back']; ?>
">&nbsp;<?php echo $this->_tpl_vars['salenum']; ?>
</td>
</tr>
<tr>
<td width="30%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['general_traffic_ratio']; ?>
</td>
<td width="25%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['perc']; ?>
%</td>
</tr>
</table>
</td>
</tr>
</table>

<BR />

<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">
<table border="0" cellpadding="2" cellspacing="1" width="100%">
<tr>
<td width="30%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['general_traffic_pay_type']; ?>
</font></b></td>
<td width="70%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['general_traffic_pay_level']; ?>
</font></b></td>
</tr>
<tr>
<td width="30%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['current_style']; ?>
</td>
<td width="70%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
">&nbsp;<?php echo $this->_tpl_vars['current_level']; ?>
</td>
</tr>
</table>
</td>
</tr>
</table>

<BR />

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'file:account_notes.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>