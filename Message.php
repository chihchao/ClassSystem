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
function function_bar_for_message($header){
	global $teacher_id, $page_number, $total_message, $PERPAGE_MESSAGE_NUMBER, $HOMEPAGE, $homepage_theme;
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
	if ($header) echo("<font color=#FFFFFF>留 . 言 . 區</font>");
	echo("</TD>");
	if ($page_number != 0) echo("<TD><a href=\"Message.php?teacher_id=" . $teacher_id . "&page_number=" . ($page_number - 1) . "\"><img src=Images/MessageBackButton.gif border=0 alt=上一頁></a></TD>");
	echo("<TD><a href=\"MessagePost.php?teacher_id=" . $teacher_id . "\"><IMG SRC=Images/MessagePostButton.gif BORDER=0 ALT=張貼留言></a></TD>");
	if ($total_message > $PERPAGE_MESSAGE_NUMBER) echo("<TD><a href=\"Message.php?teacher_id=" . $teacher_id . "&page_number=" . ($page_number + 1) . "\"><img src=Images/MessageNextButton.gif border=0 alt=下一頁></a></TD>");
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

function show_message($message_id){
	global $teacher_id, $message_array, $HOMEPAGE, $homepage_theme;
	echo("<BR><table border=0 width=100%>");
	echo("<tr>");
	echo("<td rowspan=2><IMG SRC=Images/" . $message_array[$message_id]["message_picture"] . " BORDER=0></td>");
	echo("<td width=100%><U>" . $message_array[$message_id]["message_author"] . "</U>留言給<U>" . $message_array[$message_id]["message_to"] . "</U></td>");
	echo("</tr>");
	echo("<tr>");
	echo("<td>");
	if (!empty($message_array[$message_id]["message_email"])) echo("<a href=\"mailto:" . $message_array[$message_id]["message_email"] . "\">E-MAIL</a> / ");;
	echo("張貼於 " . $message_array[$message_id]["message_time"] . "</td>");
	echo("</tr>");
	echo("<tr>");
	echo("<td colspan=2 bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . ">" . $message_array[$message_id]["message_content"] . "</td>");
	echo("</tr>");
	echo("</table>");
	if (!empty($message_array[$message_id]["reply_author"])){
		echo("<TABLE border=0 width=100%><TR><TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR2"] . " valign=top><IMG SRC=Images/MessageReplyIcon.gif BORDER=0></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . " width=100%>");
		echo($message_array[$message_id]["reply_author"] . " / 張貼於 " . $message_array[$message_id]["reply_time"]);
		echo("<BR><BR>" . $message_array[$message_id]["reply_content"]);
		echo("</TD>");
		echo("</TR></TABLE>");
	}
	echo("<table border=0 width=100%>");
	echo("<tr>");
	echo("<td>");
	if (empty($message_array[$message_id]["reply_author"])) echo("<a href=\"MessageReply.php?teacher_id=" . $teacher_id . "&message_id=" . $message_id . "\"><IMG SRC=Images/MessageReplyButton.gif BORDER=0 ALT=回覆留言></a>");
	echo("<a href=\"MessageDelete.php?teacher_id=" . $teacher_id . "&message_id=" . $message_id . "\"><IMG SRC=Images/MessageDeleteButton.gif BORDER=0 ALT=刪除留言></a>");
	echo("</td>");
	echo("</tr>");
	echo("</table>");
}
//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$begin_message = $page_number * $PERPAGE_MESSAGE_NUMBER;
$message_array = array();
$total_message = 0;

$str = "Select message_id, message_author, message_email, message_picture, message_to, message_content, message_time, reply_author, reply_content, reply_time From message Where teacher_id = '" . $teacher_id . "' Order By reply_time DESC Limit " . $begin_message .", " . ($PERPAGE_MESSAGE_NUMBER + 1);
$result = QueryDatabase($str);
while (list($message_id, $message_author, $message_email, $message_picture, $message_to, $message_content, $message_time, $reply_author, $reply_content, $reply_time) = mysql_fetch_row($result)){
	$message_array[$message_id]["message_author"] = htmlspecialchars($message_author);
	$message_array[$message_id]["message_email"] = htmlspecialchars($message_email);
	$message_array[$message_id]["message_picture"] = $message_picture;
	$message_array[$message_id]["message_to"] = htmlspecialchars($message_to);
	$message_array[$message_id]["message_content"] = nl2br(htmlspecialchars($message_content));
	$message_array[$message_id]["message_time"] = $message_time;
	$message_array[$message_id]["reply_author"] = htmlspecialchars($reply_author);
	$message_array[$message_id]["reply_content"] = nl2br(htmlspecialchars($reply_content));
	$message_array[$message_id]["reply_time"] = $reply_time;
	$total_message ++;
}
?>
<HTML>
<HEAD>
<TITLE><? echo($homepage_title); ?> → 留言區</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">
<? function_bar_for_message(1); ?>
<?
$counter = 0;
while (list($message_id) = each($message_array)){
	if ($counter >= $PERPAGE_MESSAGE_NUMBER) break;
	show_message($message_id);
	$counter ++;
}
?>
<BR>
<? function_bar_for_message(0); ?>
</BODY>
</HTML>