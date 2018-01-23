<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_POST["teacher_id"]);
$subject_id = intval($_POST["subject_id"]);
$reply_id = intval($_POST["reply_id"]);
$page_number = intval($_POST["page_number"]);

if (empty($teacher_id)) exit();
if (empty($subject_id)) header("location:Discuss.php?teacher_id=" . $teacher_id);
if (empty($reply_id)) header("location:DiscussSubject.php?teacher_id=" . $teacher_id . "&subject_id=" . $subject_id);

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["DISCUSS"]["DELETE"]);

$str = "Delete From discuss_reply Where teacher_id = '" . $teacher_id . "' And reply_id = '" . $reply_id . "'";
QueryDatabase($str);

$str = "Select reply_time From discuss_reply Where teacher_id = '" . $teacher_id . "' And subject_id = '" . $subject_id . "' Order By reply_time DESC Limit 0, 1";
$result = QueryDatabase($str);
if (!(list($reply_time) = mysql_fetch_row($result))) $reply_time = "0000-00-00 00:00:00";

$str = "Update discuss_subject Set reply_number = reply_number - 1, new_reply_time = '" . $reply_time . "' Where teacher_id = '" . func_escape_string($teacher_id) . "' And subject_id = '" . func_escape_string($subject_id) . "'";
QueryDatabase($str);

header("location:DiscussSubject.php?teacher_id=" . $teacher_id . "&subject_id=" . $subject_id . "&page_number=" . $page_number);
?>