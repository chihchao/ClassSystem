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

$login_user = login($PAGE_AUTHENTICATE_USER["BOARD"]["EDIT"]);

$str = "Select author, title, content From board Where teacher_id = '" . $teacher_id . "' And board_id = '" . $board_id . "'";
$result = QueryDatabase($str);
if (!(list($author, $title, $content) = mysql_fetch_row($result))) exit();
?>
<HTML>
<HEAD>
<TITLE><? echo($homepage_title); ?> → 公告區 → 編輯公告</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">

<? function_bar($homepage_theme, 0); ?>

				<TABLE border="0" cellspacing="1" cellpadding="2">
				<TR>
					<TD width="100%"><font color="#FFFFFF">編 . 輯 . 公 . 告</font></TD>
					<TD>
					<a href="Board.php?teacher_id=<? echo($teacher_id); ?>"><IMG SRC="Images/BoardBackButton.gif" BORDER=0 ALT="回公告區"></a></TD>
				</TR>
				</TABLE>

<? function_bar($homepage_theme, 1); ?>

<FORM METHOD=POST ACTION="BoardEditDB.php">
<TABLE border="0">
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">公告單位：</TD>
	<TD><INPUT TYPE="text" NAME="author" size="40" value="<? echo($login_user); ?>"></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">公告事項：</TD>
	<TD><INPUT TYPE="text" NAME="title" size="40" value="<? echo($title); ?>"></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">公告內容：</TD>
	<TD><TEXTAREA NAME="content" ROWS="8" COLS="40"><? echo($content); ?></TEXTAREA></TD>
</TR>
<TR>
	<TD></TD>
	<TD>
	<INPUT TYPE="hidden" name="teacher_id" value="<? echo($teacher_id); ?>">
	<INPUT TYPE="hidden" name="board_id" value="<? echo($board_id); ?>">
	</TD>
	<TD><INPUT TYPE="submit" value="送出"><INPUT TYPE="reset" value="重置"></TD>
</TR>
</TABLE>
</FORM>

</BODY>
</HTML>