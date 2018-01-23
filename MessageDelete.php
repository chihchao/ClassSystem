<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);
$message_id = intval($_GET["message_id"]);

if (empty($teacher_id)) exit();
if (empty($message_id)) exit();

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["MESSAGE"]["DELETE"]);
?>
<form name="dform" id="dform" method="post" action="MessageDeleteDB.php">
<INPUT TYPE="hidden" name="teacher_id" value="<? echo($teacher_id); ?>">
<INPUT TYPE="hidden" name="message_id" value="<? echo($message_id); ?>">
<input style="display: none;" type="submit">
<p align="center">
你真的要刪除這篇留言嗎？
<br />
<input type="submit" value="確定" /><input type="button" value="取消" onclick="javascript:history.back();"/>
</p>
</form>

