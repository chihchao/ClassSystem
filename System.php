<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$password = StripSlashes($_POST["password"]);

//function===================
function show_teacher($teacher_id){
	global $teacher_array, $password;
	echo("<TR>");
	echo("<TD valign=top><img src=Images/PublicPointer.gif border=0></TD>");
	echo("<TD valign=top>");
	echo($teacher_array[$teacher_id]["teacher_name"]);
	echo("</TD>");
	echo("<TD valign=top>");
	echo($teacher_array[$teacher_id]["grade_class"]);
	echo("</TD>");
	echo("<TD valign=top>");
	echo($teacher_array[$teacher_id]["teacher_account"]);
	echo("</TD>");
	echo("<TD><form METHOD=POST ACTION=SystemChangePassword.php>");
	echo("<input type=hidden name=password value=\"" . $password . "\">");
	echo("<input type=hidden name=teacher_id value=\"" . $teacher_id . "\">");
	echo("<input type=submit value=�ק�K�X>");
	echo("</form></TD>");
	echo("<TD><form METHOD=POST ACTION=SystemDeleteClass.php>");
	echo("<input type=hidden name=password value=\"" . $password . "\">");
	echo("<input type=hidden name=teacher_id value=\"" . $teacher_id . "\">");
	echo("<input type=submit value=�R���Z��>");
	echo("</form></TD>");
	echo("</TR>");
}

//page=======================
NoCache();

if ($password != $MANAGE_PASSWORD){
	include("PublicPassword.php");
	exit();
}

LinkDatabase();

$teacher_array = array();
$str = "Select teacher_id, teacher_account, teacher_name, grade, class_number From teacher Order By grade DESC, class_number";
$result = QueryDatabase($str);
while (list($teacher_id, $teacher_account, $teacher_name, $grade, $class_number) = mysql_fetch_row($result)){
	$teacher_array[$teacher_id]["teacher_account"] = htmlspecialchars($teacher_account);
	$teacher_array[$teacher_id]["teacher_name"] = htmlspecialchars($teacher_name);
	$teacher_array[$teacher_id]["grade_class"] = htmlspecialchars(GetGradeClass($grade, $class_number));
}
?>
<HTML>
<HEAD>
<TITLE>�t�κ޲z</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground0.gif">

<? display_frame(0, 0); ?>

		<TABLE border="0" width="100%">
		<TR>
			<TD width="100%"><font color="#FFFFFF"�t . �� . �� . �z</font></TD>
			<TD><a href="index.php"><IMG SRC="Images/SystemReturnButton.gif" BORDER=0 ALT="�^�Z�ź����t��"></a></TD>
		</TR>
		</TABLE>

<? display_frame(0, 1); ?>

		<TABLE border="0" cellspacing="5">
		<TR>
			<TD></TD>
			<TD bgcolor="#60CBFF" align="center"><IMG SRC="Images/PublicBlankSpace.gif" BORDER="0" width="55" height="0"><BR>�Ѯv</TD>
			<TD bgcolor="#60CBFF" align="center"><IMG SRC="Images/PublicBlankSpace.gif" BORDER="0" width="65" height="0"><BR>�Z��</TD>
			<TD bgcolor="#60CBFF" width="100%" align="center">�b��</TD>
			<TD></TD><TD></TD>
		</TR>
		<?
		reset($teacher_array);
		while (list($teacher_id) = each($teacher_array)){
			show_teacher($teacher_id);
		}
		?>
		</TABLE>

<? display_frame(0, 2); ?>

</BODY>
</HTML>