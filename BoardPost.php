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

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["BOARD"]["POST"]);

?>
<HTML>
<HEAD>
<TITLE><? echo($homepage_title); ?> �� ���i�� �� �i�K���i</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">

<? function_bar($homepage_theme, 0); ?>

				<TABLE border="0" cellspacing="1" cellpadding="2">
				<TR>
					<TD width="100%"><font color="#FFFFFF">�i . �K . �� . �i</font></TD>
					<TD>
					<a href="Board.php?teacher_id=<? echo($teacher_id); ?>"><IMG SRC="Images/BoardBackButton.gif" BORDER=0 ALT="�^���i��"></a></TD>
				</TR>
				</TABLE>

<? function_bar($homepage_theme, 1); ?>

<FORM METHOD=POST ACTION="BoardPostDB.php">
<TABLE border="0">
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">���i���G</TD>
	<TD><INPUT TYPE="text" NAME="author" size="40" value="<? echo($login_user); ?>"></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">���i�ƶ��G</TD>
	<TD><INPUT TYPE="text" NAME="title" size="40"></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">���i���e�G</TD>
	<TD><TEXTAREA NAME="content" ROWS="8" COLS="40"></TEXTAREA></TD>
</TR>
<TR>
	<TD></TD>
	<TD>
	<INPUT TYPE="hidden" name="teacher_id" value="<? echo($teacher_id); ?>">
	</TD>
	<TD><INPUT TYPE="submit" value="�e�X"><INPUT TYPE="reset" value="�M��"></TD>
</TR>
</TABLE>
</FORM>

</BODY>
</HTML>