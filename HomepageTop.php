<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);

if (empty($teacher_id)) exit();

//page=======================
NoCache();

LinkDatabase();

$str = "Select homepage_theme, homepage_title, homepage_counter, teacher_name, grade, class_number From teacher Where teacher_id = '" . $teacher_id . "'";
$result = QueryDatabase($str);
if (!(list($homepage_theme, $homepage_title, $homepage_counter, $teacher_name, $grade, $class_number) = mysql_fetch_row($result))) exit();
$homepage_title = htmlspecialchars($homepage_title);
$homepage_name = htmlspecialchars($homepage_name);
$grade_class = GetGradeClass($grade, $class_number);

$str  = "Update teacher Set homepage_counter = homepage_counter + 1 Where teacher_id = '" . $teacher_id . "'";
$result = QueryDatabase($str);
?>
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<TITLE><? echo($homepage_title); ?></TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="<? echo($HOMEPAGE[$homepage_theme]["BGCOLOR3"]); ?>" topmargin="0" leftmargin="0">
<TABLE border="0" width="100%" cellpadding="0" cellspacing="0">
<TR>
	<TD><IMG SRC="Images/HomepageTopTitle.gif" BORDER=0 ALT="�Z�ź���"></TD>
	<TD width="100%">

	<TABLE border="0" align="right">
	<TR>
		<TD><IMG SRC="Images/HomepageTopTeacherIcon.gif" BORDER=0></TD>
		<TD colspan="4"><font face="Arial" color="#FFFFFF">�Z�ŦѮv�G<U><? echo($teacher_name); ?></U>�Ѯv( <? echo($grade_class); ?> )</font></TD>
	</TR>
	<TR>
		<TD><IMG SRC="Images/HomepageTopHomeIcon.gif" BORDER=0></TD>
		<TD><font face="Arial" color="#FFFFFF">�X���H�ơG<? echo($homepage_counter); ?></font></TD>
		<TD><IMG SRC="Images/PublcBlankSpace.gif" BORDER=0 width="15" height="0"></TD>
		<TD><IMG SRC="Images/HomepageTopDateIcon.gif" BORDER=0 ALT="���"></TD>
		<TD><font color="#FFFFFF">
		<?
		$week_array[0] = "��";
		$week_array[1] = "�@";
		$week_array[2] = "�G";
		$week_array[3] = "�T";
		$week_array[4] = "�|";
		$week_array[5] = "��";
		$week_array[6] = "��";
		echo("���� " . (date("Y") - 1911) . "�~ " . date("m") . "�� " . date("d") . "�� �P��" . $week_array[date("w")]);
		?>
		</font></TD>
	</TR>
	</TABLE>
	
	</TD>
</TR>
</TABLE>
</BODY>
</HTML>
