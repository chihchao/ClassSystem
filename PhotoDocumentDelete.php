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
�A�u���n�R���o�i�ۤ��ܡH
<br />
<input type="submit" value="�T�w" /><input type="button" value="����" onclick="javascript:history.back();"/>
</p>
</FORM>
