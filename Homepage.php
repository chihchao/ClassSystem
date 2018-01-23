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
?>
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<TITLE><? echo($homepage_title); ?></TITLE>
</HEAD>
<FRAMESET ROWS="45,*" frameborder="0" framespacing="1">
	<FRAME NAME="HomepageTop" SRC="HomepageTop.php?teacher_id=<? echo($teacher_id); ?>" SCROLLING="no" noresize>
	<FRAMESET COLS="100,*" frameborder="0" framespacing="1">
		<FRAME NAME="HomepageManu" SRC="HomepageManu.php?teacher_id=<? echo($teacher_id); ?>" SCROLLING="no" noresize>
		<FRAME NAME="HomepageMain" SRC="HomepageMain.php?teacher_id=<? echo($teacher_id); ?>" noresize>
	</FRAMESET>
</FRAMESET>
</HTML>