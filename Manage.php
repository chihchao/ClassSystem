<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);

if (empty($teacher_id)) exit();

//function===================
function show_page($page_str){
	global $HOMEPAGE, $homepage_theme, $teacher_id, $PAGE_AUTHENTICATE_USER, $page_str_array, $link_str_array, $auth_str_array, $user_str_array;
	echo("<TABLE border=0 WIDTH=100% bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><TR><TD>" . $page_str_array[$page_str] . "</TD></TR></TABLE>");
	echo("<TABLE><TR><TD valign=top><img src=Images/PublicPointer.gif border=0></TD><TD valign=top>���}�G</TD>");
	echo("<TD>http://" . $_SERVER["SERVER_NAME"] . str_replace("Manage.php", "", $_SERVER["SCRIPT_NAME"]) . $link_str_array[$page_str] . "?teacher_id=" . $teacher_id . "</TD></TR>");
	echo("<TR><TD valign=top><img src=Images/PublicPointer.gif border=0></TD><TD valign=top>�v���G</TD><TD>");
	while (list($auth_str) = each($PAGE_AUTHENTICATE_USER[$page_str])){
		echo($auth_str_array[$auth_str]);
		echo(" �� ");
		echo($user_str_array[$PAGE_AUTHENTICATE_USER[$page_str][$auth_str]]);
		echo("<BR>");
	}
	echo("</TD></TR></TABLE>");
	echo("<BR>");
}

//page=======================
NoCache();

LinkDatabase();

$str = "Select teacher_account, teacher_password, teacher_name, teacher_email, grade, class_number, homepage_theme, homepage_title, homepage_describe, homepage_counter, class_password, apply_time, homepage_image, manage_password, function From teacher Where teacher_id = '" . $teacher_id . "'";
$result = QueryDatabase($str);
if (!(list($teacher_account, $teacher_password, $teacher_name, $teacher_email, $grade, $class_number, $homepage_theme, $homepage_title, $homepage_describe, $homepage_counter, $class_password, $apply_time, $homepage_image, $manage_password, $function) = mysql_fetch_row($result))) exit();
$homepage_account = htmlspecialchars($homepage_account);
$homepage_image = htmlspecialchars($homepage_image);

$login_user = login($PAGE_AUTHENTICATE_USER["MANAGE"]["EDIT"]);

$page_str_array["DOCUMENT"] = "����";
$page_str_array["PHOTO"] = "�ۤ���";
$page_str_array["LINK"] = "�s����";
$page_str_array["BOARD"] = "���i��";
$page_str_array["CALENDAR"] = "��ƾ�";
$page_str_array["DISCUSS"] = "�Q�װ�";
$page_str_array["MESSAGE"] = "�d����";
$page_str_array["MANAGE"] = "�޲z��";

$link_str_array["DOCUMENT"] = "Document.php";
$link_str_array["PHOTO"] = "Photo.php";
$link_str_array["LINK"] = "Link.php";
$link_str_array["BOARD"] = "Board.php";
$link_str_array["CALENDAR"] = "Calendar.php";
$link_str_array["DISCUSS"] = "Discuss.php";
$link_str_array["MESSAGE"] = "Message.php";
$link_str_array["MANAGE"] = "Manage.php";

$auth_str_array["ADD"] = "�s�W";
$auth_str_array["DELETE"] = "�R��";
$auth_str_array["EDIT"] = "�s��";
$auth_str_array["MOVE"] = "�h��";
$auth_str_array["POST"] = "�i�K";
$auth_str_array["REPLY"] = "�^��";

$user_str_array["teacher"] = "�Ѯv";
$user_str_array["manager"] = "�޲z��";
$user_str_array["classuser"] = "�Z�ŨϥΪ�";
$user_str_array["everybody"] = "�Ҧ��H";
?>
<HTML>
<HEAD>
<TITLE><? echo($homepage_title); ?> �� �޲z��</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">

<? function_bar(0, 0); ?>

<TABLE border="0" cellspacing="1" cellpadding="2" width="100%">
<TR>
	<TD width="100%"><font color="#FFFFFF">�� . �z . ��</font></TD>
	<TD>
	<a href="Homepage.php?teacher_id=<? echo($teacher_id); ?>" target="_top"><IMG SRC="Images/ManageRetrunButton.gif" BORDER=0 ALT="�^�Z�ź���"></a></TD>
	<TD>
</TR>
</TABLE>

<? function_bar(0, 1); ?>

<FORM METHOD="POST" enctype="multipart/form-data" ACTION="ManageDB.php">
<TABLE>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top"><img src="Images/PublicBlankSpace.gif" border="0" width="60" height="0"><BR>�Ѯv�b���G</TD>
	<TD><? echo($teacher_account); ?></TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">�Ѯv�K���G</TD>
	<TD><INPUT TYPE="password" NAME="teacher_password" size="40" value="<? echo($teacher_password); ?>"></TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">�Ѯv�m�W�G</TD>
	<TD><INPUT TYPE="text" NAME="teacher_name" size="40" value="<? echo($teacher_name); ?>"></TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">�Ѯv�H�c�G</TD>
	<TD><INPUT TYPE="text" NAME="teacher_email" size="40" value="<? echo($teacher_email); ?>"></TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">�~�ůZ�šG</TD>
	<TD>
	<select name="grade">
	<?
	reset($GRADE_ARRAY);
	while (list($option_counter) = each($GRADE_ARRAY)){
		echo("<option value=\"" . $option_counter . "\"");
		if ($option_counter == $grade) echo(" selected");
		echo(">");
		echo($GRADE_ARRAY[$option_counter]);
		echo("</option>");
	}
	?>
	</select> �~
	<select name="class_number">
	<?
	reset($CLASS_NUMBER_ARRAY);
	while (list($option_counter) = each($CLASS_NUMBER_ARRAY)){
		echo("<option value=\"" . $option_counter . "\"");
		if ($option_counter == $class_number) echo(" selected");
		echo(">");
		echo($CLASS_NUMBER_ARRAY[$option_counter]);
		echo("</option>");
	}
	?>
	</select> �Z
	</TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">�޲z�K�X�G</TD>
	<TD><INPUT TYPE="password" NAME="manage_password" size="40" value="<? echo($manage_password); ?>"><BR><font color="#FF0000">��</font> �Ъ`�N�A�޲z�K�X���i�M�Ѯv�K�X�ۦP�A�_�h�޲z�̱N�֦��M�Ѯv�@�˪��v���C</TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">�Z�űK�X�G</TD>
	<TD><INPUT TYPE="password" NAME="class_password" size="40" value="<? echo($class_password); ?>"><BR><font color="#FF0000">��</font> �Ъ`�N�A�Z�űK�X���i�M�Ѯv�K�X�B�޲z�K�X�ۦP�A�_�h�Z�ŨϥΪ̱N�֦��M�Ѯv�B�޲z�̤@�˪��v���C</TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">�����W�١G</TD>
	<TD><INPUT TYPE="text" NAME="homepage_title" size="40" value="<? echo($homepage_title); ?>"></TD>
</TR>
<!-- By ���T��-->
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">�}��\��G</TD>
	<TD>
	<?
		if ( stristr($function, 'a') ){
			echo ("<input type=checkbox name=function_a value=a checked>");
        }else{
			echo ("<input type=checkbox name=function_a value=a>");
        }
		echo($page_str_array["DOCUMENT"] . "�@");
		if ( stristr($function, 'b') ){
			echo ("<input type=checkbox name=function_b value=b checked>");
        }else{
			echo ("<input type=checkbox name=function_b value=b>");
        }
		echo($page_str_array["PHOTO"] . "�@");
		if ( stristr($function, 'c') ){
			echo ("<input type=checkbox name=function_c value=c checked>");
        }else{
			echo ("<input type=checkbox name=function_c value=c>");
        }
		echo($page_str_array["LINK"] . "�@");
		if ( stristr($function, 'd') ){
			echo ("<input type=checkbox name=function_d value=d checked>");
        }else{
			echo ("<input type=checkbox name=function_d value=d>");
        }
		echo($page_str_array["BOARD"] . "�@");
		if ( stristr($function, 'e') ){
			echo ("<input type=checkbox name=function_e value=e checked>");
        }else{
			echo ("<input type=checkbox name=function_e value=e>");
        }
		echo($page_str_array["CALENDAR"] . "�@");
		if ( stristr($function, 'f') ){
			echo ("<input type=checkbox name=function_f value=f checked>");
        }else{
			echo ("<input type=checkbox name=function_f value=f>");
        }
		echo($page_str_array["DISCUSS"] . "�@");
		if ( stristr($function, 'g') ){
			echo ("<input type=checkbox name=function_g value=g checked>");
        }else{
			echo ("<input type=checkbox name=function_g value=g>");
        }
		echo($page_str_array["MESSAGE"] . "�@");
	?>
	</TD>
</TR>
<!-------------->
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">�����Ϥ��G</TD>
	<TD>
	<?
	if (empty($homepage_image)){
		echo("�ثe�S�������Ϥ��A�p�G�Q�[�J�����Ϥ��A�п�ܤ@�i�Ϥ��C");
	}else{
		echo("�ثe�Ϥ��O�y" . $homepage_image . "�z�A�p�G�Q�ﴫ�O���Ϥ��A�Э��s��ܤ@�i�s���Ϥ��C");
	}
	?>
	<BR><INPUT TYPE="file" NAME="uploadfile" size="40">
	<? if (!empty($homepage_image)) echo("<BR><INPUT TYPE=checkbox NAME=homepage_image_delete value=delete>�p�G�A�n�R�������Ϥ��ФĿ�o�Ӷ��ءC"); ?>
	</TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">������r�G</TD>
	<TD><TEXTAREA NAME="homepage_describe" ROWS="8" COLS="40"><? echo($homepage_describe); ?></TEXTAREA></TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">�G�������G</TD>
	<TD>
	<?
	$option_counter = 0;
	while ($option_counter <= 2){
		if ($option_counter == 1) echo("�@�@");
		if ($option_counter == 2) echo("<BR><BR>");
		echo("<INPUT TYPE=radio NAME=homepage_theme value=" . $option_counter);
		if ($option_counter == $homepage_theme) echo(" checked");
		echo(">");
		echo("<img src=Images/PublicTheme" . $option_counter . ".gif border=1 align=top>");
		$option_counter ++;
	}
	?>
	</TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">�_�l�H�ơG</TD>
	<TD><INPUT TYPE="text" NAME="homepage_counter" size="40" value="<? echo($homepage_counter); ?>"></TD>
</TR>
<TR>
	<TD valign="top"></TD>
	<TD valign="top">
	<INPUT TYPE="hidden" name="teacher_id" value="<? echo($teacher_id); ?>">
	</TD>
	<TD><INPUT TYPE="submit" value="�e�X"><INPUT TYPE="reset" value="���m"></TD>
</TR>
</TABLE>
</FORM>

<HR width=100% size=1 color="<? echo($HOMEPAGE[$homepage_theme]["BGCOLOR3"]); ?>">

<?
while (list($page_str) = each($PAGE_AUTHENTICATE_USER)){
	show_page($page_str);
}
?>

</BODY>
</HTML>