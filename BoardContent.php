<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);
$board_id = intval($_GET["board_id"]);

if (empty($teacher_id)) exit();
if (empty($board_id)) exit();

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$str = "Select author, title, content, date_time From board Where teacher_id = '" . $teacher_id . "' And board_id = '" . $board_id . "'";
$result = QueryDatabase($str);
if (!(list($author, $title, $content, $date_time) = mysql_fetch_row($result))) exit();
$author = htmlspecialchars($author);
$title = htmlspecialchars($title);
$content = nl2br(htmlspecialchars($content));
?>
<HTML>
<HEAD>
<TITLE><? echo($homepage_title); ?> �� ���i�� �� ���i�ƶ�</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">

<? function_bar($homepage_theme, 0); ?>

				<TABLE border="0" cellspacing="1" cellpadding="2">
				<TR>
					<TD width="100%"><font color="#FFFFFF">�� . �i . �� . ��</font></TD>
					<TD><a href="Board.php?teacher_id=<? echo($teacher_id); ?>"><IMG SRC="Images/BoardBackButton.gif" BORDER=0 ALT="�^���i��"></a></TD>
					<TD><a href="BoardDelete.php?teacher_id=<? echo($teacher_id); ?>&board_id=<? echo($board_id); ?>"><IMG SRC="Images/BoardDeleteButton.gif" BORDER=0 ALT="�R�����i"></a></TD>
					<TD><a href="BoardEdit.php?teacher_id=<? echo($teacher_id); ?>&board_id=<? echo($board_id); ?>"><IMG SRC="Images/BoardEditButton.gif" BORDER=0 ALT="�s�褽�i"></a></TD>
				</TR>
				</TABLE>

<? function_bar($homepage_theme, 1); ?>

<TABLE border="0">
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top"><img src="Images/PublicBlankSpace.gif" border="0" width="65" height="0"><BR>���i�ƶ��G</TD>
	<TD><? echo($title); ?></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">���i���G</TD>
	<TD><? echo($author); ?></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">���i���e�G</TD>
	<TD><? echo($content); ?></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">���i����G</TD>
	<TD><? echo($date_time); ?></TD>
</TR>
</TABLE>

</BODY>
</HTML>