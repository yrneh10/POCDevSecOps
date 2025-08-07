<?
echo($_GET['name']); // XSS 1
echo($_POST['name']); // XSS 2
echo($_REQUEST['name']); // XSS 3
?>
