<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);
$message_id = intval($_GET["message_id"]);

if (empty($teacher_id)) exit();
if (empty($message_id)) exit();

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["MESSAGE"]["REPLY"]);

$str = "Select message_author, message_to, message_content, message_time From message Where teacher_id = '" . $teacher_id . "' And message_id = '" . $message_id . "'";
$result = QueryDatabase($str);

if (!(list($message_author, $message_to, $message_content, $message_time) = mysql_fetch_row($result))) exit();
$message_author = htmlspecialchars($message_author);
$message_to = htmlspecialchars($message_to);
$message_content = nl2br(htmlspecialchars($message_content));
?>
<HTML>
<HEAD>
<TITLE><? echo($homepage_title); ?> �� �d���� �� �^�Яd��</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">

<? function_bar($homepage_theme, 0); ?>

				<TABLE border="0" cellspacing="1" cellpadding="2">
				<TR>
					<TD width="100%"><font color="#FFFFFF">�^ . �� . �d . ��</font></TD>
					<TD>
					<a href="Message.php?teacher_id=<? echo($teacher_id); ?>"><IMG SRC="Images/MessageReturnButton.gif" BORDER=0 ALT="�^�d����"></a></TD>
				</TR>
				</TABLE>

<? function_bar($homepage_theme, 1); ?>

<FORM METHOD=POST ACTION="MessageReplyDB.php">
<TABLE width="100%" border="0">
<TR>
	<TD><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD>��l�d���G</TD>
</TR>
<TR>
	<TD></TD>
	<TD width="100%">
		<U><? echo($message_author); ?></U>�d����<U><? echo($message_to); ?></U>
		<BR>�i�K�� <? echo($message_time); ?>
	</TD>
</TR>
<TR>
	<TD></TD>
	<TD bgcolor="<? echo($HOMEPAGE[$homepage_theme]["BGCOLOR1"]); ?>">
		<? echo($message_content); ?>
	</TD>
</TR>
</TABLE>
<TABLE border="0">
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">�m�W�G</TD>
	<TD><INPUT TYPE="text" NAME="reply_author" size="40" value="<? echo($login_user); ?>"></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">�^�СG</TD>
	<TD><TEXTAREA NAME="reply_content" ROWS="8" COLS="40"></TEXTAREA></TD>
</TR>
<TR>
	<TD></TD>
	<TD>
	<INPUT TYPE="hidden" name="message_id" value="<? echo($message_id); ?>">
	<INPUT TYPE="hidden" name="teacher_id" value="<? echo($teacher_id); ?>">
	</TD>
	<TD><INPUT TYPE="submit" value="�e�X"><INPUT TYPE="reset" value="�M��"></TD>
</TR>
</TABLE>
</FORM>

</BODY>
</HTML>