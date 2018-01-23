<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_POST["teacher_id"]);
$subject_id = intval($_POST["subject_id"]);
$page_number = intval($_POST["page_number"]);

if (empty($teacher_id)) exit();
if (empty($subject_id)) header("location:Discuss.php?teacher_id=" . $teacher_id);
if (empty($page_number) || $page_number < 0) $page_number = 0;

$reply_author = StripSlashes($_POST["reply_author"]);
$reply_email = StripSlashes($_POST["reply_email"]);
$reply_picture = StripSlashes($_POST["reply_picture"]);
$reply_content = StripSlashes($_POST["reply_content"]);

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["DISCUSS"]["REPLY"]);

$check_ltrim = ltrim($reply_author);
if (empty($check_ltrim)){
	echo("<script language=javascript>");
	echo("alert('你的姓名沒填或是只填空白，這樣無法加入你的回應。');");
	echo("history.back();");
	echo("</script>");
	exit();
}

$link = LinkDatabase();
$str = "insert into discuss_reply (teacher_id, subject_id, reply_content, reply_author, reply_email, reply_picture, reply_ip, reply_time) Values ('" . func_escape_string($teacher_id) . "', '" . func_escape_string($subject_id) . "', '" . func_escape_string($reply_content) . "', '" . func_escape_string($reply_author) . "', '" . func_escape_string($reply_email) . "','" . func_escape_string($reply_picture) . "', '" . getenv("REMOTE_ADDR") . "', now())";
QueryDatabase($str);
$str = "Update discuss_subject Set reply_number = reply_number + 1, new_reply_time = now() Where teacher_id = '" . func_escape_string($teacher_id) . "' And subject_id = '" . func_escape_string($subject_id) . "'";
QueryDatabase($str);
header("location:DiscussSubject.php?teacher_id=" . $teacher_id . "&subject_id=" . $subject_id . "&page_number=" . $page_number);
?>