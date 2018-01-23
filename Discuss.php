<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);
$page_number = intval($_GET["page_number"]);

if (empty($teacher_id)) exit();
if (empty($page_number) || $page_number < 0) $page_number = 0;

//function===================
function function_bar_for_discuss($header){
	global $teacher_id, $page_number, $total_subject, $PERPAGE_SUBJECT_NUMBER, $HOMEPAGE, $homepage_theme;
	echo("<TABLE cellspacing=0 cellpadding=0 border=0 width=100%>");
	echo("<TR>");
	echo("<TD><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
	echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
	echo("<TD><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
	echo("</TR>");
	echo("<TR>");
	echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
	echo("<TD width=100%>");

	echo("<TABLE cellspacing=0 cellpadding=0 border=0 width=100%>");
	echo("<TR>");
	echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
	echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
	echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
	echo("</TR>");
	echo("<TR>");
	echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
	echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR2"] . " width=100%>");

	echo("<TABLE border=0 cellspacing=1 cellpadding=2>");
	echo("<TR>");
	echo("<TD width=100%>");
	if ($header) echo("<font color=#FFFFFF>討 . 論 . 區</font>");
	echo("</TD>");
	if ($page_number != 0) echo("<TD><a href=\"Discuss.php?teacher_id=" . $teacher_id . "&page_number=" . ($page_number - 1) . "\"><img src=Images/DiscussBackButton.gif border=0 alt=上一頁></a></TD>");
	echo("<TD><a href=\"DiscussPost.php?teacher_id=" . $teacher_id . "\"><IMG SRC=Images/DiscussPostButton.gif BORDER=0 ALT=張貼主題></a></TD>");
	if ($total_subject > $PERPAGE_SUBJECT_NUMBER) echo("<TD><a href=\"Discuss.php?teacher_id=" . $teacher_id . "&page_number=" . ($page_number + 1) . "\"><img src=Images/DiscussNextButton.gif border=0 alt=下一頁></a></TD>");
	echo("</TR>");
	echo("</TABLE>");

	echo("</TD>");
	echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
	echo("</TR>");
	echo("<TR>");
	echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
	echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
	echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
	echo("</TR>");
	echo("</TABLE>");

	echo("<TR>");
	echo("<TD><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
	echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
	echo("<TD><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
	echo("</TR>");
	echo("</TABLE>");
}

function show_subject($subject_id){
	global $teacher_id, $subject_array;
	echo("<TR>");
	echo("<TD valign=top width=1%><img src=Images/PublicPointer.gif border=0></TD>");
	echo("<TD valign=top>");
	echo("<a href=DiscussSubjectRead.php?teacher_id=" . $teacher_id . "&subject_id=" . $subject_id . ">" . $subject_array[$subject_id]["subject_title"] . "</a>");
	echo("</TD>");
	echo("<TD>");
	echo($subject_array[$subject_id]["subject_author"]);
	echo("</TD>");
	echo("<TD align=right>");
	echo($subject_array[$subject_id]["subject_read"]);
	echo("</TD>");
	echo("<TD align=right>");
	echo($subject_array[$subject_id]["reply_number"]);
	echo("</TD>");
	echo("<TD align=center>");
	if ($subject_array[$subject_id]["new_reply_time"] == "0000-00-00 00:00:00"){
		echo("");
	}else{
		echo($subject_array[$subject_id]["new_reply_time"]);
	}
	echo("</TD>");
}

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$begin_subject = $page_number * $PERPAGE_SUBJECT_NUMBER;
$subject_array = array();
$total_subject = 0;
$str = "Select subject_id, subject_title, subject_author, subject_read, reply_number, new_reply_time From discuss_subject Where teacher_id = '" . func_escape_string($teacher_id) . "' Order By subject_time DESC Limit " . $begin_subject .", " . ($PERPAGE_SUBJECT_NUMBER + 1);
$result = QueryDatabase($str);
while (list($subject_id, $subject_title, $subject_author, $subject_read, $reply_number, $new_reply_time) = mysql_fetch_row($result)){
	$subject_array[$subject_id]["subject_title"] = htmlspecialchars($subject_title);
	$subject_array[$subject_id]["subject_author"] = htmlspecialchars($subject_author);
	$subject_array[$subject_id]["subject_read"] = $subject_read;
	$subject_array[$subject_id]["reply_number"] = $reply_number;
	$subject_array[$subject_id]["new_reply_time"] = $new_reply_time;
	$total_subject ++;
}
?>
<HTML>
<HEAD>
<TITLE><? echo($homepage_title); ?> → 討論區</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">
<? function_bar_for_discuss(1); ?>
<TABLE width="100%" border="0" cellpadding="1" cellspacing="5" style="color:#008080">
<TR>
	<TD align="center" bgcolor="<? echo($HOMEPAGE[$homepage_theme]["BGCOLOR1"]); ?>" colspan="2" width="100%"><font color="#000000">討論主題</font></TD>
	<TD align="center" bgcolor="<? echo($HOMEPAGE[$homepage_theme]["BGCOLOR1"]); ?>"><img src="Images/PublicBlankSpace.gif" border="0" width="80" height="0"><BR><font color="#000000">作者</font></TD>
	<TD align="center" bgcolor="<? echo($HOMEPAGE[$homepage_theme]["BGCOLOR1"]); ?>"><img src="Images/PublicBlankSpace.gif" border="0" width="30" height="0"><BR><font color="#000000">點閱</font></TD>
	<TD align="center" bgcolor="<? echo($HOMEPAGE[$homepage_theme]["BGCOLOR1"]); ?>"><img src="Images/PublicBlankSpace.gif" border="0" width="30" height="0"><BR><font color="#000000">回應</font></TD>
	<TD align="center" bgcolor="<? echo($HOMEPAGE[$homepage_theme]["BGCOLOR1"]); ?>"><img src="Images/PublicBlankSpace.gif" border="0" width="125" height="0"><BR><font color="#000000">最新回應時間</font></TD>
</TR>
<?
$counter = 0;
while (list($subject_id) = each($subject_array)){
	if ($counter >= $PERPAGE_SUBJECT_NUMBER) break;
	show_subject($subject_id);
	$counter ++;
}
?>
</TABLE>
<? function_bar_for_discuss(0); ?>
</BODY>
</HTML>
