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

$login_user = login($PAGE_AUTHENTICATE_USER["DISCUSS"]["POST"]);
?>
<HTML>
<HEAD>
<TITLE><? echo($homepage_title); ?> �� �Q�װ� �� �i�K�D�D</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">

<? function_bar($homepage_theme, 0); ?>
<TABLE border="0" cellspacing="1" cellpadding="2" width="100%">
<TR>
	<TD width="100%"><font color="#FFFFFF">�i . �K . �D . �D</font></TD>
	<TD>
	<a href="Discuss.php?teacher_id=<? echo($teacher_id); ?>"><IMG SRC="Images/DiscussReturnButton.gif" BORDER=0 ALT="�^�Q�װ�"></a></TD>
</TR>
</TABLE>
<? function_bar($homepage_theme, 1); ?>

<form action="DiscussPostDB.php" method="POST">

<TABLE border="0">
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">�m�@�@�W�G</TD>
	<TD><input type="text" name="subject_author" size="40" value="<? echo($login_user); ?>"></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">�q�l�l��G</TD>
	<TD><INPUT TYPE="text" NAME="subject_email" size="40"></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">�N��H���G</TD>
	<TD>
		<input type="radio" checked name="subject_picture" value="DiscussPicture01.gif"><img src="Images/DiscussPicture01.gif">
		�@�@<input type="radio" name="subject_picture" value="DiscussPicture02.gif"><img src="Images/DiscussPicture02.gif">
		�@�@<input type="radio" name="subject_picture" value="DiscussPicture03.gif"><img src="Images/DiscussPicture03.gif">
		�@�@<input type="radio" name="subject_picture" value="DiscussPicture04.gif"><img src="Images/DiscussPicture04.gif">
		<BR>
		<input type="radio" name="subject_picture" value="DiscussPicture05.gif"><img src="Images/DiscussPicture05.gif">
		�@�@<input type="radio" name="subject_picture" value="DiscussPicture06.gif"><img src="Images/DiscussPicture06.gif">
		�@�@<input type="radio" name="subject_picture" value="DiscussPicture07.gif"><img src="Images/DiscussPicture07.gif">
		�@�@<input type="radio" name="subject_picture" value="DiscussPicture08.gif"><img src="Images/DiscussPicture08.gif">
	</TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">�Q�ץD�D�G</TD>
	<TD><INPUT TYPE="text" NAME="subject_title" size="40"></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">�Q�פ��e�G</TD>
	<TD><TEXTAREA NAME="subject_content" ROWS="8" COLS="40"></TEXTAREA></TD>
</TR>
<TR>
	<TD></TD>
	<TD>
	<INPUT TYPE="hidden" name="teacher_id" value="<? echo($teacher_id); ?>">
	</TD>
	<TD><INPUT TYPE="submit" value="�e�X"><INPUT TYPE="reset" value="�M��"></TD>
</TR>
</TABLE>

</form>
</body>
</html>
