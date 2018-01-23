<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);
$year = intval($_GET["year"]);
$month = intval($_GET["month"]);
$day = intval($_GET["day"]);

if (empty($teacher_id)) exit();
if (empty($year) || empty($month) || empty($day)) exit();
$year = (int) $year;
$month = (int) $month;
$day = (int) $day;

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["CALENDAR"]["POST"]);

if (!checkdate($month, $day, $year)){
	echo("<script language=javascript>");
	echo("alert('你所輸入的日期不是有效的日期，請重新選擇日期。');");
	echo("history.back();");
	echo("</script>");
	exit();
}

?>
<HTML>
<HEAD>
<TITLE><? echo($homepage_title); ?> → 行事曆 → 張貼記事</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">

<? function_bar($homepage_theme, 0); ?>
<TABLE border="0" cellspacing="1" cellpadding="2" width="100%">
<TR>
	<TD width="100%"><font color="#FFFFFF">張 . 貼 . 記 . 事</font></TD>
	<TD>
	<a href="Calendar.php?teacher_id=<? echo($teacher_id); ?>&year=<? echo($year); ?>&month=<? echo($month); ?>"><IMG SRC="Images/CalendarReturnButton.gif" BORDER=0 ALT="回行事曆"></a></TD>
</TR>
</TABLE>
<? function_bar($homepage_theme, 1); ?>

<FORM METHOD=POST ACTION="CalendarPostDB.php">
<TABLE border="0" width="100%" bgcolor="<? echo($HOMEPAGE[$homepage_theme]["BGCOLOR1"]); ?>">
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top" width="100%">在 <U><? echo($year); ?> 年 <? echo($month); ?> 月 <? echo($day); ?> 日</U> 新增活動、記事或聯絡事項。</TD>
</TR>
</TABLE>
<TABLE border="0">
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">張貼的人：</TD>
	<TD><INPUT TYPE="text" NAME="author" size="40" value="<? echo($login_user); ?>"></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">記事內容：</TD>
	<TD><TEXTAREA NAME="content" ROWS="8" COLS="40"></TEXTAREA></TD>
</TR>
<TR>
	<TD></TD>
	<TD>
	<INPUT TYPE="hidden" NAME="year" value="<? echo($year); ?>">
	<INPUT TYPE="hidden" NAME="month" value="<? echo($month); ?>">
	<INPUT TYPE="hidden" NAME="day" value="<? echo($day); ?>">
	<INPUT TYPE="hidden" name="teacher_id" value="<? echo($teacher_id); ?>">
	</TD>
	<TD><INPUT TYPE="submit" value="送出"><INPUT TYPE="reset" value="清除"></TD>
</TR>
</TABLE>
</FORM>

</BODY>
</HTML>