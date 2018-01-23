<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_POST["teacher_id"]);
$subject_author = StripSlashes($_POST["subject_author"]);
$subject_email = StripSlashes($_POST["subject_email"]);
$subject_picture = StripSlashes($_POST["subject_picture"]);
$subject_title = StripSlashes($_POST["subject_title"]);
$subject_content = StripSlashes($_POST["subject_content"]);

if (empty($teacher_id)) exit();

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["DISCUSS"]["POST"]);

$check_ltrim = ltrim($subject_author);
if (empty($check_ltrim)){
	echo("<script language=javascript>");
	echo("alert('你的姓名沒填或是只填空白，這樣無法加入討論主題。');");
	echo("history.back();");
	echo("</script>");
	exit();
}
$check_ltrim = ltrim($subject_title);
if (empty($check_ltrim)){
	echo("<script language=javascript>");
	echo("alert('你的討論主題沒填或是只填空白，這樣無法加入討論主題。');");
	echo("history.back();");
	echo("</script>");
	exit();
}

$str = "insert into discuss_subject (teacher_id, subject_title, subject_content, subject_author, subject_email, subject_picture, subject_ip, subject_time, new_reply_time, reply_number) Values ('" . func_escape_string($teacher_id) . "', '" . func_escape_string($subject_title) . "','" . func_escape_string($subject_content) . "','" . func_escape_string($subject_author) . "','" . func_escape_string($subject_email) . "','" . func_escape_string($subject_picture) . "', '" . getenv("REMOTE_ADDR") . "', now(), '', '0')";
QueryDatabase($str);
header("location:Discuss.php?teacher_id=" . $teacher_id);
?>