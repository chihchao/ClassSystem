<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_account = StripSlashes($_GET["account"]);

//function===================
function show_teacher($teacher_id){
	global $teacher_array;
	echo("<TR>");
	echo("<TD valign=top><img src=Images/PublicPointer.gif border=0></TD>");
	echo("<TD valign=top>");
	echo("<a href=\"Homepage.php?teacher_id=" . $teacher_id . "\" target=_blank>");
	echo($teacher_array[$teacher_id]["teacher_name"]);
	echo("</a></TD>");
	echo("<TD valign=top>");
	echo($teacher_array[$teacher_id]["grade_class"]);
	echo("</TD>");
	echo("<TD valign=top>");
	echo("http://" . $_SERVER["SERVER_NAME"] . $_SERVER["SCRIPT_NAME"] . "?account=" . $teacher_array[$teacher_id]["teacher_account"]);
	echo("</TD>");
	echo("</TR>");
}

//page=======================
NoCache();

LinkDatabase();

if (!empty($teacher_account)){
	$str = "Select teacher_id From teacher Where teacher_account = '" . func_escape_string($teacher_account) . "'";
	$result = QueryDatabase($str);
	if (list($teacher_id) = mysql_fetch_row($result)) header("location:Homepage.php?teacher_id=" . $teacher_id);
	exit();
}

$teacher_array = array();
$str = "Select teacher_id, teacher_account, teacher_name, grade, class_number From teacher Order By grade, class_number";
$result = QueryDatabase($str);
while (list($teacher_id, $teacher_account, $teacher_name, $grade, $class_number) = mysql_fetch_row($result)){
	$teacher_array[$teacher_id]["teacher_account"] = htmlspecialchars($teacher_account);
	$teacher_array[$teacher_id]["teacher_name"] = htmlspecialchars($teacher_name);
	$teacher_array[$teacher_id]["grade_class"] = htmlspecialchars(GetGradeClass($grade, $class_number));
}


?>
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<TITLE>班級網頁系統</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground0.gif">

<? display_frame(0, 0); ?>

		<TABLE border="0" width="100%">
		<TR>
			<TD width="100%"><font color="#FFFFFF">班 . 級 . 網 . 頁 . 系 . 統</font></TD>
			<TD><a href="Apply.php"><IMG SRC="Images/IndexApplyButton.gif" BORDER=0 ALT="申請班級網頁"></a></TD>
			<TD><a href="System.php"><IMG SRC="Images/IndexSystemButton.gif" BORDER=0 ALT="系統管理"></a></TD>
		</TR>
		</TABLE>

<? display_frame(0, 1); ?>

		<TABLE border="0" cellspacing="5">
		<TR>
			<TD></TD>
			<TD bgcolor="#60CBFF" align="center"><IMG SRC="Images/PublicBlankSpace.gif" BORDER="0" width="55" height="0"><BR>老師</TD>
			<TD bgcolor="#60CBFF" align="center"><IMG SRC="Images/PublicBlankSpace.gif" BORDER="0" width="65" height="0"><BR>班級</TD>
			<TD bgcolor="#60CBFF" width="100%" align="center">班級網頁網址</TD>
		</TR>
		<?
		reset($teacher_array);
		while (list($teacher_id) = each($teacher_array)){
			show_teacher($teacher_id);
		}
		?>
		</TABLE>

<? display_frame(0, 2); ?>
<br>
<CENTER><font size="1" color="#000080">程式：<a href="mailto:atlas@mail.nsysu.edu.tw">高雄市加昌國小許智超</a>　修改：<a href="http://www2.scps.kh.edu.tw/tbird" target="_blank">蔡俊彥</a></font></CENTER>

</BODY>
</HTML>