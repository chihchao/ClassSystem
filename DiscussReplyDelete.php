<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);
$subject_id = intval($_GET["subject_id"]);
$reply_id = intval($_GET["reply_id"]);
$page_number = intval($_GET["page_number"]);

if (empty($teacher_id)) exit();
if (empty($subject_id)) header("location:Discuss.php?teacher_id=" . $teacher_id);
if (empty($reply_id)) header("location:DiscussSubject.php?teacher_id=" . $teacher_id . "&subject_id=" . $subject_id);

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["DISCUSS"]["DELETE"]);
?>
<FORM METHOD=POST ACTION="DiscussReplyDeleteDB.php" name="dform" id="dform">
<INPUT TYPE="hidden" name="teacher_id" value="<? echo($teacher_id); ?>">
<INPUT TYPE="hidden" name="subject_id" value="<? echo($subject_id); ?>">
<INPUT TYPE="hidden" name="reply_id" value="<? echo($reply_id); ?>">
<INPUT TYPE="hidden" name="page_number" value="<? echo($page_number); ?>">
<p align="center">
你真的要刪除這篇回應嗎？
<br />
<input type="submit" value="確定" /><input type="button" value="取消" onclick="javascript:history.back();"/>
</p>
</FORM>
