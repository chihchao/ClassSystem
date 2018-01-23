<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);
$folder_id = intval($_GET["folder_id"]);

if (empty($teacher_id)) exit();
if (empty($folder_id) || $folder_id < 0) $folder_id = 0;

//function===================
function show_folder($list_folder_id, $sub_tree){
	global $teacher_id, $folder_id, $folder_array;
	if (is_array($folder_array[$list_folder_id])){
		asort($folder_array[$list_folder_id]);
		while(list($array_folder_id)  = each($folder_array[$list_folder_id])){
			if ($array_folder_id == $folder_id || $sub_tree == 1){
				$hidden_link = 1;
			}else{
				$hidden_link = 0;
			}
			echo("<TABLE width=100% cellpadding=1 cellspacing=2 border=0><TR>");
			echo("<TD valign=top><img src=Images/PublicFolder.gif></TD>");
			echo("<TD width=100%>");
			if (!$hidden_link) echo("<a href=DocumentFolderMoveDB.php?teacher_id=" . $teacher_id . "&folder_id=" . $folder_id . "&up_folder_id=" . $array_folder_id . ">");
			echo($folder_array[$list_folder_id][$array_folder_id]);
			if (!$hidden_link) echo("</a>");
			if ($array_folder_id == $folder_id) echo("（目前資料夾所在位置）");
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

if ($folder_id == 0){
	$folder_name = "文件區";
	$folder_echo_str = "『文件區』 為最上層資料夾，無法搬移。";
}else{
	$str = "Select folder_name From document_folder Where teacher_id = '" . $teacher_id . "' And folder_id = '" . $folder_id . "'";
	$result = QueryDatabase($str);
	if (!(list($folder_name) = mysql_fetch_row($result))) exit();
	$folder_echo_str = "請問要將 『" . $folder_name . "』 搬到那個資料夾底下？";
}

$folder_array = array();
$folder_array["root"][0] = "文件區";
$str = "Select folder_id, folder_name, up_folder_id From document_folder Where teacher_id = '" . func_escape_string($teacher_id) . "'";
$result = QueryDatabase($str);
while (list($array_folder_id, $array_folder_name, $up_array_folder_id) = mysql_fetch_row($result)){
	$folder_array[$up_array_folder_id][$array_folder_id] = htmlspecialchars($array_folder_name);
}
?>
<HTML>
<HEAD>
<TITLE><? echo($homepage_title); ?> → 文件區 → 搬移資料夾</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">

<? function_bar($homepage_theme, 0); ?>
<TABLE border="0" cellspacing="1" cellpadding="2" width="100%">
<TR>
	<TD width="100%"><font color="#FFFFFF">搬 . 移 . 資 . 料 . 夾</font></TD>
	<TD>
	<a href="Document.php?teacher_id=<? echo($teacher_id); ?>&folder_id=<? echo($folder_id); ?>"><IMG SRC="Images/DocumentReturnButton.gif" BORDER=0 ALT="回資料夾"></a></TD>
</TR>
</TABLE>
<? function_bar($homepage_theme, 1); ?>

<BR>
<TABLE border="0" width="100%" bgcolor="<? echo($HOMEPAGE[$homepage_theme]["BGCOLOR1"]); ?>">
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top" width="100%"><? echo($folder_echo_str); ?></TD>
</TR>
</TABLE>

<?
$list_folder_id = "root";
asort($folder_array["root"]);
show_folder($list_folder_id, 0);
?>

</BODY>
</HTML>