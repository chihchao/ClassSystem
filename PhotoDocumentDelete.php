<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);
$document_id = intval($_GET["document_id"]);

if (empty($teacher_id)) exit();
if (empty($document_id)) exit();

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["PHOTO"]["DELETE"]);
?>
<FORM METHOD=POST ACTION="PhotoDocumentDeleteDB.php" name="dform" id="dform">
<INPUT TYPE="hidden" name="teacher_id" value="<? echo($teacher_id); ?>">
<INPUT TYPE="hidden" name="document_id" value="<? echo($document_id); ?>">
<p align="center">
你真的要刪除這張相片嗎？
<br />
<input type="submit" value="確定" /><input type="button" value="取消" onclick="javascript:history.back();"/>
</p>
</FORM>
