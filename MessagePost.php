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

$login_user = login($PAGE_AUTHENTICATE_USER["MESSAGE"]["POST"]);

$message_pass = substr(md5($MESSAGE_NOSPAMMER_VALUE . date("Y") . date("m") . date("d")), 0, 6);
?>
<HTML>
<HEAD>
<TITLE><? echo($homepage_title); ?> �� �d���� �� �i�K�d��</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">

<? function_bar($homepage_theme, 0); ?>

				<TABLE border="0" cellspacing="1" cellpadding="2">
				<TR>
					<TD width="100%"><font color="#FFFFFF">�i . �K . �d . ��</font></TD>
					<TD>
					<a href="Message.php?teacher_id=<? echo($teacher_id); ?>"><IMG SRC="Images/MessageReturnButton.gif" BORDER=0 ALT="�^�d����"></a></TD>
				</TR>
				</TABLE>

<? function_bar($homepage_theme, 1); ?>

<FORM METHOD=POST ACTION="MessagePostDB.php">
<TABLE border="0">
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">�m�@�@�W�G</TD>
	<TD><INPUT TYPE="text" NAME="message_author" size="40" value="<? echo($login_user); ?>"></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">�q�l�l��G</TD>
	<TD><INPUT TYPE="text" NAME="message_email" size="40"></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">�d�����֡H</TD>
	<TD><INPUT TYPE="text" NAME="message_to" size="40" value="�j�a"></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">�N��H���G</TD>
	<TD>
		<input type="radio" checked name="message_picture" value="MessagePicture01.gif"><img src="Images/MessagePicture01.gif">
		�@�@<input type="radio" name="message_picture" value="MessagePicture02.gif"><img src="Images/MessagePicture02.gif">
		�@�@<input type="radio" name="message_picture" value="MessagePicture03.gif"><img src="Images/MessagePicture03.gif">
		�@�@<input type="radio" name="message_picture" value="MessagePicture04.gif"><img src="Images/MessagePicture04.gif">
		<BR>
		<input type="radio" name="message_picture" value="MessagePicture05.gif"><img src="Images/MessagePicture05.gif">
		�@�@<input type="radio" name="message_picture" value="MessagePicture06.gif"><img src="Images/MessagePicture06.gif">
		�@�@<input type="radio" name="message_picture" value="MessagePicture07.gif"><img src="Images/MessagePicture07.gif">
		�@�@<input type="radio" name="message_picture" value="MessagePicture08.gif"><img src="Images/MessagePicture08.gif">
	</TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">�d�@�@���G</TD>
	<TD><TEXTAREA NAME="message_content" ROWS="8" COLS="40"></TEXTAREA></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">���Ҥ�r�G</TD>
	<TD>�п�J���Ҥ�r�G<? echo($message_pass) ?><br /><INPUT TYPE="text" NAME="message_pass" size="40" value=""></TD>
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