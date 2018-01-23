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

$list_all = TRUE;
?>
<HTML>
<HEAD><meta http-equiv="content-type" content="text/html; charset=BIG5" />
<TITLE><? echo($homepage_title); ?> → 公告區</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">
<? require("BoardList.php"); ?>
</BODY>
</HTML>