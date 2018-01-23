<?
session_start();
$_SESSION["user_id"] = "";
$_SESSION["user_level"] = "";
//parameter==================
$teacher_id = intval($_GET["teacher_id"]);
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
window.open("Homepage.php?teacher_id=<? echo($teacher_id); ?>", "_top");
//-->
</SCRIPT>