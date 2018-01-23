<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);

if (empty($teacher_id)){
	$teacher_id = intval($_POST["teacher_id"]);
	if (empty($teacher_id)){
		exit();
	}else{
		$year = intval($_POST["year"]);
		$month = intval($_POST["month"]);
	}
}else{
	$year = intval($_GET["year"]);
	$month = intval($_GET["month"]);
}
//�]�w�p�G�S�����w�~��ɪ��~��
if (empty($year)) $year = date("Y");
$year = (int) $year;
if (empty($month)) $month = date("m");
$month = (int) $month;

//function===================
function show_calendar($day, $calendar_id){
	global $teacher_id, $calendar_array;
	echo("<TABLE border=0 width=100%>");
	echo("<TR>");
	echo("<TD valign=top><IMG SRC=Images/PublicPointer.gif BORDER=0></TD>");
	echo("<TD valign=top><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=40 height=0><BR><U><font color=#008000>");
	echo($calendar_array[$day][$calendar_id]["author"]);
	echo("</font></U></TD>");
	echo("<TD valign=top width=100%>");
	echo($calendar_array[$day][$calendar_id]["content"]);
	echo("</TD>");
	echo("<TD valign=top>");
	echo("<a href=\"CalendarEdit.php?teacher_id=" . $teacher_id . "&calendar_id=" . $calendar_id . "\">");
	echo("<IMG SRC=Images/CalendarEditButton.gif BORDER=0 alt=�s��></a></TD>");
	echo("<TD valign=top>");
	echo("<a href=\"CalendarDelete.php?teacher_id=" . $teacher_id . "&calendar_id=" . $calendar_id . "\">");
	echo("<IMG SRC=Images/CalendarDeleteButton.gif BORDER=0 alt=�R��></a></TD>");
	echo("</TR>");
	echo("</TABLE>");
}

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

//�C��Ѽ�
$month_days = array(1 => 31, 2 => 28, 3 => 31, 4 => 30, 5 => 31, 6 => 30, 7 => 31, 8 => 31, 9 => 30, 10 => 31, 11 => 30, 12 => 31);
if ((($year % 4 == 0) && ($year % 100 != 0)) || ($year % 400 == 0)) $month_days[2] = 29;
$day_numbers = $month_days[$month];
//�C��1��O�ѬP���X�}�l
$day_start = date("w", mktime(0, 0, 0, $month, 1, $year));

$calendar_array = array();
$str = "Select calendar_id, day, author, content From calendar Where teacher_id = '" . func_escape_string($teacher_id) . "' And year = '" . func_escape_string($year) . "' And month = '" . func_escape_string($month) . "'";
$result = QueryDatabase($str);
while (list($calendar_id, $day, $author, $content) = mysql_fetch_row($result)){
	$calendar_array[$day][$calendar_id]["author"] = htmlspecialchars($author);
	$calendar_array[$day][$calendar_id]["content"] = nl2br(htmlspecialchars($content));
}

?>
<HTML>
<HEAD>
<TITLE><? echo($homepage_title); ?> �� ��ƾ�</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">

<? function_bar($homepage_theme, 0); ?>

<TABLE border="0" cellspacing="1" cellpadding="2" width="100%">
<TR>
	<TD width="100%"><font color="#FFFFFF">�� . �� . ��</font></TD>
	<TD align="right">
	<IMG SRC="Images/PublicBlankSpace.gif" BORDER=0 width="80" height="0"><BR><font color="#FFFFFF"><? echo($year); ?> �~ <? echo($month); ?> ��</font></TD>
</TR>
</TABLE>

<? function_bar($homepage_theme, 1); ?>


<TABLE border="0" cellspacing="0" cellpadding="0" width="100%">
<TR><TD><IMG SRC="Images/PublicBlankSpace.gif" BORDER="0" width="190" height="10"></TD><TD><IMG SRC="Images/PublicBlankSpace.gif" BORDER="0" width="10" height="10"></TD><TD width="100%"></TD></TR>
<TR>
	<TD valign="top">

	<? display_frame($homepage_theme, 0); ?>

	<TABLE border="0" width="100%">
	<TR>
		<TD>
		<?
		if ($month == 1){
			$go_month = 12;
			$go_year = $year - 1;
		}else{
			$go_month = $month - 1;
			$go_year = $year;
		}
		?>
		<a href="Calendar.php?teacher_id=<? echo($teacher_id); ?>&year=<? echo($go_year); ?>&month=<? echo($go_month); ?>"><IMG SRC="Images/CalendarBackButton.gif" BORDER=0 ALT="�W�@��"></a></TD>
		<TD width="100%" align="center">
		<font color="#FFFFFF"><? echo($year); ?> �~ <? echo($month); ?> ��</font></TD>
		<TD>
		<?
		if ($month == 12){
			$go_month = 1;
			$go_year = $year + 1;
		}else{
			$go_month = $month + 1;
			$go_year = $year;
		}
		?>
		<a href="Calendar.php?teacher_id=<? echo($teacher_id); ?>&year=<? echo($go_year); ?>&month=<? echo($go_month); ?>"><IMG SRC="Images/CalendarNextButton.gif" BORDER=0 ALT="�U�@��"></a></TD>
	</TR>
	</TABLE>

	<? display_frame($homepage_theme, 1); ?>

	<TABLE border="0" width="100%">
	<TR>
		<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
		<TD valign="top" width="100%">���I�����ӷs�W���ʡB�O�Ʃ��p���ƶ��C</TD>
	</TR>
	</TABLE>

	<table border=1 cellpadding=1 cellspacing=0 bordercolor=#000080 bordercolordark=#000080 bordercolorlight=#000080 width=100%>
	<tr bgcolor=#D3DCE3>
		<td align=center width=15%><font color=#ff0000><B>��</B></font></td>
		<td align=center width=14%><B>�@</B></td>
		<td align=center width=14%><B>�G</B></td>
		<td align=center width=14%><B>�T</B></td>
		<td align=center width=14%><B>�|</B></td>
		<td align=center width=14%><B>��</B></td>
		<td align=center width=15%><font color=#ff0000><B>��</B></font></td>
	</tr>
	<tr>
	<?
	$column = 0;
	//�W�@�Ӥ������Ů�
	for ($i = 0; $i < $day_start; $i ++){
		echo("<td bgcolor=#FFFFFF>�@</td>");
		$column++;
	}
	//�}�l�o�Ӥ몺���
	for ($i = 1; $i <= $day_numbers; $i ++){
		if ($column == 7){
			echo("<tr>");
			$column = 0;
		}
		echo("<td bgcolor=#F5F5F5><CENTER>");
		echo("<a href=\"CalendarPost.php?teacher_id=" . $teacher_id . "&year=" . $year . "&month=" . $month . "&day=" . $i . "\">");
		if ($column == 0 || $column == 6) echo("<font color=#ff0000>");
		echo($i);
		if ($column == 0 || $column == 6) echo("</font>");
		echo("</a>");
		echo("</CENTER></td>");
		if ($column == 6) echo("</tr>");
		$column ++;
	}
	//�U�@�Ӥ������Ů�
	for ($i = 7; $i > $column; $i --){
		echo("<td bgcolor=#FFFFFF>�@</td>");
	}
	?>
	</tr>
	</table>

	<? display_frame($homepage_theme, 2); ?>

	<FORM METHOD=POST ACTION="Calendar.php">
	<CENTER>��
	<select name="year">
	<?
	for ($i = 2002; $i <= 2020; $i ++){
		echo("<option value=" . $i);
		if ($i == $year) echo(" selected");
		echo(">" . $i . "</option>");
	}
	?>
	</select>�~
	<select name="month">
	<?
	for ($i = 1; $i <= 12; $i ++){
		echo("<option value=" . $i);
		if ($i == $month) echo(" selected");
		echo(">" . $i . "</option>");
	}
	?>
	</select>��
	<INPUT TYPE="hidden" name="teacher_id" value="<? echo($teacher_id); ?>">
	<INPUT TYPE="submit" value="GO"></CENTER>
	</FORM>

	</TD>
	<TD valign="top">
	</TD>
	<TD valign="top">

	<TABLE border=1 cellpadding=1 cellspacing=0 bordercolor=#000080 bordercolordark=#000080 bordercolorlight=#000080 width="100%">
	<TR>
		<TD align="center" bgcolor="#D3DCE3" colspan="2"><IMG SRC="Images/PublicBlankSpace.gif" BORDER="0" width="50" height="0"><BR>���</TD>
		<TD align="center" bgcolor="#D3DCE3" width="100%">���ʡB�O�Ƥ��p���ƶ�</TD>
	</TR>
	<?
	$week_str_array = array(0 => "(��)", 1 => "(�@)", 2 => "(�G)", 3 => "(�T)", 4 => "(�|)", 5 => "(��)", 6 => "(��)");
	$week_str = "";
	for ($i = 1; $i <= $day_numbers; $i ++){
		$week = date("w", mktime(0, 0, 0, $month, $i, $year));
		echo("<TR>");
		echo("<TD align=center valign=top bgcolor=#F5F5F5>");
		if ($week == 0 || $week == 6) echo("<font color=#FF0000>");
		echo($i);
		if ($week == 0 || $week == 6) echo("</font>");
		echo("</TD>");
		echo("<TD align=center valign=top bgcolor=#F5F5F5>");
		if ($week == 0 || $week == 6) echo("<font color=#FF0000>");
		echo($week_str_array[$week]);
		if ($week == 0 || $week == 6) echo("</font>");
		echo("</TD>");
		echo("<TD>");
		if (is_array($calendar_array[$i])){
			while (list($calendar_id) = each($calendar_array[$i])){
				show_calendar($i, $calendar_id);
			}
		}else{
			echo("�@");
		}
		echo("</TD>");
		echo("</TR>");
	}
	?>
	</TABLE>

	</TD>
</TR>
</TABLE>

</BODY>
</HTML>