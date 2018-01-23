<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_POST["teacher_id"]);
$message_author = StripSlashes($_POST["message_author"]);
$message_email = StripSlashes($_POST["message_email"]);
$message_to = StripSlashes($_POST["message_to"]);
$message_picture = StripSlashes($_POST["message_picture"]);
$message_content = StripSlashes($_POST["message_content"]);

if (empty($teacher_id)) exit();
if ($_POST["message_pass"] != substr(md5($MESSAGE_NOSPAMMER_VALUE . date("Y") . date("m") . date("d")), 0, 6)) exit();

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["MESSAGE"]["POST"]);

$check_ltrim = ltrim($message_author);
if (empty($check_ltrim)){
	echo("<script language=javascript>");
	echo("alert('你的姓名沒填或是只填空白，這樣無法加入你的留言。');");
	echo("history.back();");
	echo("</script>");
	exit();
}

$str = "insert into message (teacher_id, message_author, message_email, message_picture, message_to, message_content, message_ip, message_time, reply_time) Values ('" . $teacher_id . "', '" . func_escape_string($message_author) . "', '" . func_escape_string($message_email) . "', '" . func_escape_string($message_picture) . "', '" . func_escape_string($message_to) . "', '" . func_escape_string($message_content) . "', '" . getenv("REMOTE_ADDR") . "', now(), now())";
QueryDatabase($str);
header("location:Message.php?teacher_id=" . $teacher_id);
?>