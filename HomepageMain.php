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

$str = "Select homepage_theme, homepage_title, teacher_name, teacher_email, grade, class_number, homepage_image, homepage_image_flash, homepage_describe From teacher Where teacher_id = '" . $teacher_id . "'";
$result = QueryDatabase($str);
if (!(list($homepage_theme, $homepage_title, $teacher_name, $teacher_email, $grade, $class_number, $homepage_image, $homepage_image_flash, $homepage_describe) = mysql_fetch_row($result))) exit();
$homepage_title = htmlspecialchars($homepage_title);
$teacher_name = htmlspecialchars($teacher_name);
$teacher_email = htmlspecialchars($teacher_email);
$homepage_describe = nl2br(htmlspecialchars($homepage_describe));
$grade_class = GetGradeClass($grade, $class_number);
?>
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<TITLE><? echo($homepage_title); ?></TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">

<P><CENTER>
<font size="4" color="#000080"><U><B><? echo($homepage_title); ?></B></U></font><BR>
<font size="2" color="#008080"><? echo($grade_class . "������"); ?></font>
</CENTER>

<?
if (!empty($homepage_image) && file_exists("UploadHomepage/" . $homepage_image)){
	$homepage_image_url = rawurlencode($homepage_image);
	if ($homepage_image_flash == "1"){
		echo("<P><CENTER><EMBED SRC=\"UploadHomepage/" . $homepage_image_url . "\"></CENTER>");
	}else{
		echo("<P><CENTER><IMG SRC=\"UploadHomepage/" . $homepage_image_url . "\" BORDER=0 ALT=�����Ϥ�></CENTER>");
	}
}
?>

<P><CENTER><? echo($homepage_describe); ?></CENTER>

<? if (!empty($teacher_email)) echo("<P><CENTER><IMG SRC=Images/HomepageMainMailIcon.gif BORDER=0 ALT=mail align=middle>�H�H��<a href=\"mailto:" . $teacher_email . "\"><U>" . $teacher_name . "</U></a>�Ѯv</CENTER>"); ?>

<form name="srhform" method="get" action="http://dir.yam.com/bin/search" target="_blank">
<? function_bar($homepage_theme, 0); ?>
<TABLE border="0" cellspacing="1" cellpadding="2" width="100%">
<TR>
	<TD width="100%"><font color="#FFFFFF">�� . �� . �� . �j . �M . �� . ��</font></TD>
	<TD><input type="text" maxlength="30" name="k" size="20"></TD>
	<TD>
	<input type="hidden" name="dest" value="http://dir.yam.com/bin/search">
	<select name="t">
	<option value="site" selected>����</option>
	<option value="google">����</option>
	<option value="news">�s�D</option>
	<option value="stock">�ѥ�</option>
	<option value="yambbs">BBS</option>
	<option value="shop">�ӫ~</option>
	<option value="events">����</option>
	</select></TD>
	<TD>
	<input type="submit" value="�j�M"></TD>
</TR>
</TABLE>
<? function_bar($homepage_theme, 1); ?>
</form>

<? require("BoardList.php"); ?>

</BODY>
</HTML>
