<?
//no cache
function NoCache(){
	header("Cache-Control: no-cache, must-revalidate");
}

//�s����Ʈw
function LinkDatabase(){
	global $DATABASE_URL, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE_BASE, $LINK;
	$LINK = mysql_pconnect($DATABASE_URL, $DATABASE_USER, $DATABASE_PASSWORD);
	mysql_select_db($DATABASE_BASE, $LINK);
}

//��Ʈw�d��
function QueryDatabase($str){
	global $LINK;
	$result = mysql_query($str, $LINK);
	return $result;
}

//deal slashes problem, set magic_quotes_gpc off
function func_setoff_magic_quotes_gpc() {
	if (get_magic_quotes_gpc()) {
		function traverse(&$arr) {
			if (!is_array($arr)) return;
			foreach ($arr as $key => $val) is_array ($arr[$key]) ? traverse($arr[$key]) : ($arr[$key] = stripslashes ($arr[$key]));
		}
		$gpc = array( &$_GET, &$_POST, &$_COOKIE );
		traverse($gpc);
	}
}

//escape string for array data
function func_escape_string($string) {
	if (function_exists('mysql_real_escape_string')) {
		$string = mysql_real_escape_string($string);
	} elseif (function_exists('mysql_escape_string')) {
		$string = mysql_escape_string($string);
	} else {
		$string = addslashes($string);
	}
	return $string;
}
function func_escape_string_arr_trv(&$arr) {
	if (!is_array($arr)) return;
	foreach ($arr as $key => $val) is_array($arr[$key]) ? func_escape_string_arr_trv($arr[$key]) : ($arr[$key] = func_escape_string($arr[$key]));
}
function func_escape_string_arr(&$arr) { func_escape_string_arr_trv($arr); }

//�۰ʭ��s��z
function reload(){
	if ($_COOKIE["reload"] == "1"){
		setcookie("reload", "0");
		echo("<SCRIPT LANGUAGE='JavaScript'>window.location.reload();</SCRIPT>");
	}else{
		setcookie("reload", "1");
	}
}

//���o�~�ŤίZ�ŦW��
function GetGradeClass($grade, $class_number){
	global $GRADE_ARRAY, $CLASS_NUMBER_ARRAY;
	if ($grade >= 1 && $grade <= 6){
		$grade_class = $GRADE_ARRAY[$grade] . " �~" . $CLASS_NUMBER_ARRAY[$class_number] . " �Z";
	}else{
		$grade_class = $GRADE_ARRAY[$grade];
	}
	return $grade_class;
}

//���o�G�������ίZ�ŦW��
function GetThemeTitle(){
	global $teacher_id, $homepage_theme, $homepage_title;
	$str = "Select homepage_theme, homepage_title From teacher Where teacher_id = '" . $teacher_id . "'";
	$result = QueryDatabase($str);
	if (!(list($homepage_theme, $homepage_title) = mysql_fetch_row($result))) exit();
	$homepage_title = htmlspecialchars($homepage_title);
}

//�߰ݨϥΪ̦W�٤αK�X
function auth()
{
    Header("WWW-authenticate: basic realm=\"" . $GLOBALS["authenticate_alert"] . "\"");
    Header("status: 401 Unauthorized");
    Header("HTTP/1.0 401 Unauthorized");
    echo("<SCRIPT LANGUAGE='JavaScript'>");
	echo("alert('�A�S���v������i�J�Ӻ���\\n�Ш��o���v���K�X�C');");
 	echo("history.back();");
	echo("</SCRIPT>");
	exit();
}

//�B�z�n�J -- revised by ���T�� 2004/04/28
function login($authenticate_user){
	global $teacher_id;

	session_start();
	if ($authenticate_user != "everybody"){
		if ( empty($_SESSION["user_id"]) || $_SESSION["user_id"] != $teacher_id){
			header ("Location: Authenticate.php?teacher_id=" . $teacher_id . "&authenticate_user=" . $authenticate_user . "&url=" . urlencode($_SERVER['REQUEST_URI']));
		}else if($_SESSION["user_level"] != "teacher"){
			if (  !( ($_SESSION["user_level"] == "manager") && ($authenticate_user == "classuser") ) ){
				if ($_SESSION["user_level"] != $authenticate_user){
					header ("Location: Authenticate.php?teacher_id=" . $teacher_id . "&authenticate_user=" . $authenticate_user . "&url=" . urlencode($_SERVER['REQUEST_URI']));
				}
			}			
		}
	}

	return $teacher_id;
}

//�\��C
function function_bar($homepage_theme, $half){
	global $HOMEPAGE;
	if ($half == "0"){
		echo("<TABLE cellspacing=0 cellpadding=0 border=0 width=100%>");
		echo("<TR>");
		echo("<TD><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("</TR>");
		echo("<TR>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD width=100%>");

		echo("<TABLE cellspacing=0 cellpadding=0 border=0 width=100%>");
		echo("<TR>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("</TR>");
		echo("<TR>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR2"] . " width=100%>");
	}else{
		echo("</TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("</TR>");
		echo("<TR>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("</TR>");
		echo("</TABLE>");

		echo("<TR>");
		echo("<TD><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("</TR>");
		echo("</TABLE>");
	}
}

//�i�ܮج[
function display_frame($homepage_theme, $part){
	global $HOMEPAGE;
	if ($part == "0"){
		echo("<TABLE cellspacing=0 cellpadding=0 border=0 width=100%>");
		echo("<TR>");
		echo("<TD><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=180 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("</TR>");
		echo("<TR>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("</TR>");
		echo("<TR>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR2"] . " width=100%>");
	}elseif ($part == "1"){
		echo("</TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("</TR>");
		echo("</TABLE>");

		echo("<TABLE cellspacing=0 cellpadding=0 border=0 width=100%>");
		echo("<TR>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR2"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR2"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("</TR>");
		echo("<TR>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR2"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR2"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("</TR>");
		echo("<TR>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD width=100%><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("</TR>");
		echo("<TR>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD width=100%><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("</TR>");
		echo("<TR>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR2"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD width=100%><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=2></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR2"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("</TR>");
		echo("<TR>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD width=100%><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("</TR>");
		echo("<TR>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD width=100%><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("</TR>");
		echo("<TR>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR2"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=3 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD width=100%>");
	}else{
		echo("</TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR2"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=3 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("</TR>");
		echo("<TR>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR2"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR2"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("</TR>");
		echo("<TR>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR2"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR2"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("</TR>");
		echo("</TABLE>");

		echo("<TABLE cellspacing=0 cellpadding=0 border=0 width=100%>");
		echo("<TR>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR1"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR2"] . " width=100%><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=3></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("</TR>");
		echo("<TR>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=" . $HOMEPAGE[$homepage_theme]["BGCOLOR3"] . "><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("</TR>");
		echo("<TR>");
		echo("<TD><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD bgcolor=#000000><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("<TD><IMG SRC=Images/PublicBlankSpace.gif BORDER=0 width=1 height=1></TD>");
		echo("</TR>");
		echo("</TABLE>");
	}
}
?>