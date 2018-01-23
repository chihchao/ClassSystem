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

$login_user = login($PAGE_AUTHENTICATE_USER["PHOTO"]["EDIT"]);

$str = "Select folder_id, document_title, document_content, document_file, document_time From photo_document Where teacher_id = '" . $teacher_id . "' And document_id = '" . $document_id . "'";
$result = QueryDatabase($str);
if (!(list($folder_id, $document_title, $document_content, $document_file, $document_time) = mysql_fetch_row($result))) exit();

if ($folder_id == 0){
	$folder_name = "相片區";
}else{
	$str = "Select folder_name From photo_folder Where teacher_id = '" . $teacher_id . "' And folder_id = '" . $folder_id . "'";
	$result = QueryDatabase($str);
	if (!(list($folder_name) = mysql_fetch_row($result))) exit();
}
$folder_name = htmlspecialchars($folder_name);
?>
<HTML>
<HEAD>
<TITLE><? echo($homepage_title); ?> → 相片區 →相片內容 → 編輯相片</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">

<? function_bar($homepage_theme, 0); ?>
<TABLE border="0" cellspacing="1" cellpadding="2" width="100%">
<TR>
	<TD width="100%"><font color="#FFFFFF">編 . 輯 . 相 . 片</font></TD>
	<TD>
	<a href="PhotoDocument.php?teacher_id=<? echo($teacher_id); ?>&document_id=<? echo($document_id); ?>"><IMG SRC="Images/PhotoDocumentReturnButton.gif" BORDER=0 ALT="回相片內容"></a></TD>
</TR>
</TABLE>
<? function_bar($homepage_theme, 1); ?>

<FORM METHOD="POST" enctype="multipart/form-data" ACTION="PhotoDocumentEditDB.php">
<TABLE border="0" width="100%" bgcolor="<? echo($HOMEPAGE[$homepage_theme]["BGCOLOR1"]); ?>">
<TR>
	<TD valign="top"><IMG SRC="Images/PublicFolder.gif" BORDER=0></TD>
	<TD valign="top" width="100%"><? echo($folder_name); ?></TD>
</TR>
</TABLE>
<TABLE border="0">
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top"><img src="Images/PublicBlankSpace.gif" border="0" width="65" height="0"><BR>相片標題：</TD>
	<TD><INPUT TYPE="text" NAME="document_title" size="40" value="<? echo($document_title); ?>"></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">相片說明：</TD>
	<TD><TEXTAREA NAME="document_content" ROWS="8" COLS="40"><? echo($document_content); ?></TEXTAREA></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">相　　片：</TD>
	<TD>
	目前這張相片檔是『<? echo($document_file); ?>』，如果你要變更相片檔，請選擇你要變更的檔案。
	<BR><INPUT TYPE="file" NAME="uploadfile" size="40"></TD>
</TR>
<TR>
	<TD></TD>
	<TD>
	<INPUT TYPE="hidden" name="document_id" value="<? echo($document_id); ?>">
	<INPUT TYPE="hidden" name="teacher_id" value="<? echo($teacher_id); ?>">
	</TD>
	<TD><INPUT TYPE="submit" value="送出"><INPUT TYPE="reset" value="重置"></TD>
</TR>
</TABLE>

</FORM>

</BODY>
</HTML>
