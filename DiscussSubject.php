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

//function===================
function function_bar_for_discuss(){
	global $teacher_id, $subject_id, $page_number, $total_reply, $PERPAGE_REPLY_NUMBER, $HOMEPAGE, $homepage_theme;
	function_bar($homepage_theme, 0);
	echo("<TABLE width=100% border=0>");
	echo("<TR>");
	echo("<TD width=100%>");
	echo("<font color=#FFFFFF>第 . " . ($page_number + 1) . " . 頁 . 回 . 應</font>");
	echo("</TD>");

	if ($page_number != 0){
		echo("<TD><a href=\"DiscussSubject.php?teacher_id=" . $teacher_id . "&subject_id=" . $subject_id . "&page_number=" . ($page_number - 1) . "\"><img src=Images/DiscussBackButton.gif border=0 alt=上一頁></a></TD>");
	}

	echo("<TD><a href=DiscussReply.php?teacher_id=" . $teacher_id . "&subject_id=" . $subject_id . "&page_number=" . $page_number . "><IMG SRC=Images/DiscussSubjectReplyButton.gif BORDER=0 ALT=加入回應></a></TD>");

	if ($total_reply > $PERPAGE_REPLY_NUMBER){
		echo("<TD><a href=\"DiscussSubject.php?teacher_id=" . $teacher_id . "&subject_id=" . $subject_id . "&page_number=" . ($page_number + 1) . "\"><img src=Images/DiscussNextButton.gif border=0 alt=下一頁></a></TD>");
	}
	echo("</TR>");
	echo("</TABLE>");
	function_bar($homepage_theme, 1);
}

function show_reply($reply_id){
	global $teacher_id, $subject_id, $page_number, $reply_array;
	echo("<TABLE width=100% cellpadding=10 style=color:#008080><TR><TD>");

	echo("<TABLE cellspacing=0 cellpadding=0 border=0 style=color:#804000>");
	echo("<TR><TD rowspan=2>");
	echo("<img src=Images/" . $reply_array[$reply_id]["reply_picture"] . ">");
	echo("</TD><TD>");
	echo("<U>" . $reply_array[$reply_id]["reply_author"] . "</U>");
	if (!empty($reply_array[$reply_id]["reply_email"])) echo(" / <a href=\"mailto:" . $reply_array[$reply_id]["reply_email"] . "\">e-mail</a>");
	echo("</TD></TR>");
	echo("<TR><TD>");
	echo("張貼於 " . $reply_array[$reply_id]["reply_time"]);
	echo("</TD></TR></TABLE>");

	echo("<HR size=1 width=200 align=left color=#804000>" . $reply_array[$reply_id]["reply_content"]);

	echo("<TABLE border=0 cellpadding=0 cellspacing=0><TR><TD><a href=\"DiscussReplyDelete.php?teacher_id=" . $teacher_id . "&subject_id=" . $subject_id . "&reply_id=" . $reply_id . "&page_number=" . $page_number . "\"><IMG SRC=Images/DiscussReplyDeleteButton.gif BORDER=0 ALT=刪除回應></a></TD></TR></TABLE>");

	echo("</TD></TR></TABLE>");
}

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$str = "Select subject_title, subject_content, subject_author, subject_email, subject_picture, subject_time From discuss_subject Where teacher_id = '" . func_escape_string($teacher_id) . "' And subject_id = '" . func_escape_string($subject_id) . "'";
$result = QueryDatabase($str);
if (!(list($subject_title, $subject_content, $subject_author, $subject_email, $subject_picture, $subject_time) = mysql_fetch_row($result))){
    echo("<script language=javascript>");
    echo("alert('你所指定的討論主題不存在！');");
    echo("window.open('Discuss.php?teacher_id=" . $teacher_id . "', '_self');");
    echo("</script>");
    exit();
}
$subject_title = htmlspecialchars($subject_title);
$subject_content = nl2br(htmlspecialchars($subject_content));
$subject_author = htmlspecialchars($subject_author);
$subject_email = htmlspecialchars($subject_email);

$begin_reply = $page_number * $PERPAGE_REPLY_NUMBER;
$reply_array = array();
$total_reply = 0;
$str = "Select reply_id, reply_content, reply_author, reply_email, reply_picture, reply_time From discuss_reply Where subject_id = " . $subject_id . " Order By reply_time Limit " . $begin_reply .", " . ($PERPAGE_REPLY_NUMBER + 1);
$result = QueryDatabase($str);
while (list($reply_id, $reply_content, $reply_author, $reply_email, $reply_picture, $reply_time) = mysql_fetch_row($result)){
	$reply_array[$reply_id]["reply_content"] = nl2br(htmlspecialchars($reply_content));
	$reply_array[$reply_id]["reply_author"] = htmlspecialchars($reply_author);
	$reply_array[$reply_id]["reply_email"] = htmlspecialchars($reply_email);
	$reply_array[$reply_id]["reply_picture"] = $reply_picture;
	$reply_array[$reply_id]["reply_time"] = $reply_time;
	$total_reply ++;
}
?>
<HTML>
<HEAD>
<TITLE><? echo($homepage_title); ?> → 討論區 → 討論主題</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">

<? function_bar($homepage_theme, 0); ?>
<TABLE border="0" cellspacing="1" cellpadding="2" width="100%">
<TR>
	<TD width="100%"><font color="#FFFFFF">討 . 論 . 主 . 題</font></TD>
	<TD>
	<a href="Discuss.php?teacher_id=<? echo($teacher_id); ?>"><IMG SRC="Images/DiscussReturnButton.gif" BORDER=0 ALT="回討論區"></a></TD>
	<TD>
	<a href="DiscussSubjectDelete.php?teacher_id=<? echo($teacher_id); ?>&subject_id=<? echo($subject_id); ?>"><IMG SRC="Images/DiscussSubjectDeleteButton.gif" BORDER=0 ALT="刪除主題"></TD>
</TR>
</TABLE>
<? function_bar($homepage_theme, 1); ?>

<TABLE width=100% cellpadding="10" bgcolor="<? echo($HOMEPAGE[$homepage_theme]["BGCOLOR1"]); ?>">
<TR>
	<TD>
	<B><font color="#000080" size="3"><? echo($subject_title); ?></font></B>
	<HR size="1" width="100%" align="center">
	<TABLE cellspacing="0" cellpadding="0" border="0">
	<TR>
		<TD rowspan="2"><img src="Images/<? echo($subject_picture); ?>"></TD>
		<TD>
		<U><? echo($subject_author); ?></U>
		<? if (!empty($subject_email)) echo(" / <a href=\"mailto:" . $subject_email . "\">e-mail</a>"); ?>
		</TD>
	</TR>
	<TR>
		<TD>張貼於 <? echo($subject_time); ?></TD>
	</TR>
	</TABLE>
	<BR><? echo($subject_content); ?>
	</TD>
</TR>
</TABLE>

<?
function_bar_for_discuss();
$counter = 0;
while (list($reply_id) = each($reply_array)){
	if ($counter >= $PERPAGE_REPLY_NUMBER) break;
	//if ($counter != 0) echo("<BR><BR>");
	echo("<br>");
	show_reply($reply_id);
	echo("<br>");
	$counter ++;
}
if ($total_reply != 0) function_bar_for_discuss();
?>
</BODY>
</HTML>