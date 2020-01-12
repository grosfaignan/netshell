<?php
function display($data)
{
	echo '<!doctype html><html lang="fr"><head><meta charset="utf-8"><title>Titre de la page</title><link rel="stylesheet" href="stdout.css"></head><body>';
	echo '<div id="c1"><pre>';
	for ($i = 0; $i < count($data); $i++) {
		echo ($i . '<br/>');
	}
	echo '</pre></div><div id="c2"><pre>';

	for ($i = 0; $i < count($data); $i++) {
		echo ($data[$i] . '<br/>');
	}

	echo '</pre></div></body></html>';

}
function parseStdout($data)
{

	$temp   = htmlspecialchars($data);
	$split1 = preg_split("/(\s+\n*)/U", $temp); //"/\s{2,}|\n/","/(\s\s+)|(\n)/U" , une version pas trop mal "/(0\s+\n*)/U" avec 0=null, \s+ pour les espace et \n pour les retour chariot
	$split2 = preg_split("/\n/", $temp);
	return $split2;

}

function shellCommand($stringCommand)
{

	$directReturn = shell_exec(escapeshellcmd($stringCommand));
	$cleanReturn  = mb_convert_encoding($directReturn, 'UTF-8', 'CP-850');
	return $cleanReturn;
}
//$cmd    = shellCommand('help'); // for debug
$lastString = exec('help', $output, $errorCode);
//var_dump($output);

$input  = $_GET;
//var_dump($input);
//$cmd    = shellcommand($input['cmd']);
//$parsed = parseStdout($cmd);
// var_dump($parsed);
// display($parsed);

?>