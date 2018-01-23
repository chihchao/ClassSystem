<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_POST["teacher_id"]);
$message_id = intval($_POST["message_id"]);
$reply_author = StripSlashes($_POST["reply_author"]);
$reply_content = StripSlashes($_POST["reply_content"]);

if (empty($teacher_id)) exit();
if (empty($message_id)) exit();

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["MESSAGE"]["REPLY"]);

$check_ltrim = ltrim($reply_author);
if (empty($check_ltrim)){
	echo("<script language=javascript>");
	echo("alert('你的姓名沒填或是只填空白，這樣無法加入你的留言。');");
	echo("history.back();");
	echo("</script>");
	exit();
}

$str = "Update message Set reply_author = '" . func_escape_string($reply_author) . "', reply_content = '" . func_escape_string($reply_content) . "', reply_time = now() Where teacher_id = '" . $teacher_id . "' And message_id = '" . $message_id . "'";
QueryDatabase($str);
header("location:Message.php?teacher_id=" . $teacher_id);
?>