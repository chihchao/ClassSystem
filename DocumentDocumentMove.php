<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);
$document_id = intval($_GET["document_id"]);

if (empty($teacher_id)) exit();
if (empty($document_id)) exit();

//function===================
function show_folder($list_folder_id){
	global $teacher_id, $document_id, $folder_id, $folder_array;
	if (is_array($folder_array[$list_folder_id])){
		asort($folder_array[$list_folder_id]);
		while(list($array_folder_id)  = each($folder_array[$list_folder_id])){
			echo("<TABLE width=100% cellpadding=1 cellspacing=2 border=0><TR>");
			echo("<TD valign=top><img src=Images/PublicFolder.gif></TD>");
			echo("<TD width=100%>");
			if ($array_folder_id != $folder_id) echo("<a href=DocumentDocumentMoveDB.php?teacher_id=" . $teacher_id . "&document_id=" . $document_id . "&folder_id=" . $array_folder_id . ">");
			echo($folder_array[$list_folder_id][$array_folder_id]);
			if ($array_folder_id != $folder_id) echo("</a>");
			if ($array_folder_id == $folder_id) echo("�]�ثe���Ҧb��Ƨ��^");
			echo("</TD>");
			echo("</TR><TR>");
			echo("<TD valign=top></TD>");
			echo("<TD>");
			show_folder($array_folder_id, $hidden_link);
			echo("</TD>");
			echo("</TR></TABLE>");
		}
	}
}

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["DOCUMENT"]["MOVE"]);

$str = "Select folder_id, document_title From document_document Where teacher_id = '" . $teacher_id . "' And document_id = '" . $document_id . "'";
$result = QueryDatabase($str);
if (!(list($folder_id, $document_title) = mysql_fetch_row($result))) exit();
$document_title = htmlspecialchars($document_title);

$folder_array = array();
$folder_array["root"][0] = "����";
$str = "Select folder_id, folder_name, up_folder_id From document_folder Where teacher_id = '" . func_escape_string($teacher_id) . "'";
$result = QueryDatabase($str);
while (list($array_folder_id, $array_folder_name, $up_array_folder_id) = mysql_fetch_row($result)){
	$folder_array[$up_array_folder_id][$array_folder_id] = htmlspecialchars($array_folder_name);
}

?>
<HTML>
<HEAD>
<TITLE><? echo($homepage_title); ?> �� ���� �� ��󤺮e �� �h�����</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">

<? function_bar($homepage_theme, 0); ?>
<TABLE border="0" cellspacing="1" cellpadding="2" width="100%">
<TR>
	<TD width="100%"><font color="#FFFFFF">�h . �� . �� . ��</font></TD>
	<TD>
	<a href="DocumentDocument.php?teacher_id=<? echo($teacher_id); ?>&document_id=<? echo($document_id); ?>"><IMG SRC="Images/DocumentDocumentReturnButton.gif" BORDER=0 ALT="�^��󤺮e"></a></TD>
</TR>
</TABLE>
<? function_bar($homepage_theme, 1); ?>

<BR>
<TABLE border="0" width="100%" bgcolor="<? echo($HOMEPAGE[$homepage_theme]["BGCOLOR1"]); ?>">
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top" width="100%">�аݭn�N �y<? echo($document_title); ?>�z �h�쨺�Ӹ�Ƨ����U�H</TD>
</TR>
</TABLE>

<?
$list_folder_id = "root";
asort($folder_array["root"]);
show_folder($list_folder_id);
?>

</BODY>
</HTML>