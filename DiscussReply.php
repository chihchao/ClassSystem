<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);
$subject_id = intval($_GET["subject_id"]);
$page_number = intval($_GET["page_number"]);

if (empty($teacher_id)) exit();
if (empty($subject_id)) header("location:Discuss.php?teacher_id=" . $teacher_id);
if (empty($page_number) || $page_number < 0) $page_number = 0;

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["DISCUSS"]["REPLY"]);
?>
<HTML>
<HEAD>
<TITLE><? echo($homepage_title); ?> → 討論區 → 討論主題 → 張貼回應</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">

<? function_bar($homepage_theme, 0); ?>
<TABLE border="0" cellspacing="1" cellpadding="2" width="100%">
<TR>
	<TD width="100%"><font color="#FFFFFF">張 . 貼 . 回 . 應</font></TD>
	<TD>
	<a href="Discuss.php?teacher_id=<? echo($teacher_id); ?>"><IMG SRC="Images/DiscussReturnButton.gif" BORDER=0 ALT="回討論區"></a></TD>
	<TD>
	<a href="DiscussSubject.php?teacher_id=<? echo($teacher_id); ?>&subject_id=<? echo($subject_id); ?>&page_number=<? echo($page_number); ?>"><IMG SRC="Images/DiscussSubjectReturnButton.gif" BORDER=0 ALT="回討論主題"></a></TD>
</TR>
</TABLE>
<? function_bar($homepage_theme, 1); ?>

<form action="DiscussReplyDB.php" method="POST">

<TABLE border="0">
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">姓　　名：</TD>
	<TD><input type="text" name="reply_author" size="40" value="<? echo($login_user); ?>"></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">電子郵件：</TD>
	<TD><INPUT TYPE="text" NAME="reply_email" size="40"></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">代表人物：</TD>
	<TD>
		<input type="radio" checked name="reply_picture" value="DiscussPicture01.gif"><img src="Images/DiscussPicture01.gif">
		　　<input type="radio" name="reply_picture" value="DiscussPicture02.gif"><img src="Images/DiscussPicture02.gif">
		　　<input type="radio" name="reply_picture" value="DiscussPicture03.gif"><img src="Images/DiscussPicture03.gif">
		　　<input type="radio" name="reply_picture" value="DiscussPicture04.gif"><img src="Images/DiscussPicture04.gif">
		<BR>
		<input type="radio" name="reply_picture" value="DiscussPicture05.gif"><img src="Images/DiscussPicture05.gif">
		　　<input type="radio" name="reply_picture" value="DiscussPicture06.gif"><img src="Images/DiscussPicture06.gif">
		　　<input type="radio" name="reply_picture" value="DiscussPicture07.gif"><img src="Images/DiscussPicture07.gif">
		　　<input type="radio" name="reply_picture" value="DiscussPicture08.gif"><img src="Images/DiscussPicture08.gif">
	</TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">討論內容：</TD>
	<TD><TEXTAREA NAME="reply_content" ROWS="8" COLS="40"></TEXTAREA></TD>
</TR>
<TR>
	<TD></TD>
	<TD>
	<input type="hidden" name="page_number" value="<? echo($page_number); ?>">
	<input type="hidden" name="subject_id" value="<? echo($subject_id); ?>">
	<INPUT TYPE="hidden" name="teacher_id" value="<? echo($teacher_id); ?>">
	</TD>
	<TD><INPUT TYPE="submit" value="送出"><INPUT TYPE="reset" value="清除"></TD>
</TR>
</TABLE>

</form>
</body>
</html>
