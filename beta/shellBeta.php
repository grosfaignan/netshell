<?php
if (!isset($_GET['cmd']) || $_GET['cmd'] === "") {
	$cmd = 'help';
} else {
	$cmd = $_GET['cmd'];
}
function export($data)
{
	$file      = 'data.php';
	$toWrite   = array("<?php \r\n \$data =", var_export($data, true), "\r\n?>");
	$errorCode = file_put_contents($file, $toWrite);
	require 'data.php';
	$temp = $data;
	return $temp;
}
function display($data)
{
	$count=0;
	foreach ($data as $line)
	{
		echo ('<a class="data"><code> '.$line. '</code></a><br/>');
		$count++;

	}
	return $count;
}
function parseStdout($data)
{

	//$temp = htmlspecialchars($data);
	//$split1 = preg_split("/(\s+\n*)/U", $temp); //"/\s{2,}|\n/","/(\s\s+)|(\n)/U" , une version pas trop mal "/(0\s+\n*)/U" avec 0=null, \s+ pour les espace et \n pour les retour chariot
	//$temp1=preg_replace("/[\r?\n]+/"," ",$data);
	//var_dump($temp1);
	$error=preg_match_all("/[^\.]\n[\s]*?[a-z]+/",$data,$array, PREG_OFFSET_CAPTURE);
	// for($i=0; $i<count($array[0]);$++)
	// {
		
	// }
	//for($i=0; $i<strlen($data);i)
	var_dump($array);


	$split2 = preg_split("/\n/", $data);
	//$split3 = preg_split("/(\.\n)/", $split2);
	// var_dump($split2);
	$split3 = preg_grep("/.{2,}/", $split2);
	// var_dump($split3);
	// foreach($split3 as $line)
	// {
	// 	//var_dump($split3);
	// 	if((preg_match("/[\r?\n]?[\s]+[a-z]+/A",$line, $temp))&&(preg_match("/[\r?\n]?[\s]+[a-z]+[\s]+/A", $line, $temp2)))//
	// 	{
	// 		var_dump($line);
	// 	}
	// }
	//$split4= preg_grep("/[\S]+/",$split3);
	//var_dump($split4);
	
	
	
	//echo('<pre>'.$temp1.'</pre>');
	
	
	// $pattern=array("/[\s]{4,}/","/[\s]{4,}/");
	// $replacement=array('<a class="comment-ident">','</a><a class="comment-ident">');
	// $temp=preg_replace($pattern, $replacement ,$split3);
	//var_dump($temp);
	$split6=array();
	$keys=array_keys($split3);
	var_dump($keys);
	for($i=0; $i<count($keys);$i++)//count($split3)
	{
		echo $i.'...keys='.$keys[$i];
		$error = preg_match_all("/([\S]{1,})|([\s]{2,})/",$split2[$keys[$i]], $split4);//"/[\S]{1,}/" ...//essai "/\b[^\s]*\b/"
		
		// $error=array_unshift($split4[0],'<code>');
		var_dump($split4[0]);
		
		// for($i=0; $i<=array_key_last($split4);$i++)
		// {

		// }

	}

	for($i=0; $i<=array_key_last($split3);$i++)
	{
		$error = preg_match_all("/[\S]{1,}/",$split2[$i], $split4);
		var_dump($split4);
		$split5[$i] = implode(" ", $split4[0]);
		//var_dump($split5[$i]);
		
		if(!empty($split5[$i]))
		{
			$split6[]=$split5[$i];
			//$error = array_push($split6,$split5[$i]);	
			//var_dump($split5[$i]);
				
		}
			
	}
	//var_dump($split5);
	var_dump($split6);
	
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
	$lastString_e_Return = exec(escapeshellcmd($cmd), $e_Return, $e_errorCode);
	// $data = array('$> '=>var_export($cmd,true),'shell_exec Return'=> var_export($s_e_Return,true),'exec Return'=> var_export($e_Return,true),'exec error code'=>var_export($e_errorCode,true) );
	$data = $s_e_Return;
	if (PHP_OS === "WINNT") {
		$cleanReturn = mb_convert_encoding($data, 'UTF-8', 'CP-850');
	} else {
		$cleanReturn = $data;

	}

	return $cleanReturn;
}
// $err    = ' &> out.txt';
// $string = 'man man' . $err;
// $cmd    = shell_exec($string); // for debug
//
//$handle = fopen('data.php','w+');
// echo ('<br/>echo = <br/>');
// echo ($cmd);
// echo ('<br/>var_dump = <br/>');
// var_dump($cmd);
// echo ('<br/>var_export = <br/>');
// var_export($cmd);

// $cmd = (system($string, $errorCode));
// echo ('<br/>echo = <br/>');
// echo ($cmd);
// echo ('<br/>var_dump = <br/>');
// var_dump($cmd);
// echo ('<br/>var_export = <br/>');
// var_export($cmd);

// $lastString = exec($string, $cmd, $errorCode); //cette version fonctionne sur le remote.
// echo ('<br/>echo = <br/>');
// echo ('<br/>var_dump = <br/>');
// var_dump($cmd);
// echo ('<br/>var_export = <br/>');
//$errorCode=fclose($handle);

//var_dump($output);
// $parsed = parseStdout($cmd);
// display($parsed);
//var_dump($input);
//$cmd    = shellcommand($input['cmd']);
//$parsed = parseStdout($cmd);
// var_dump($parsed);
// display($parsed);

$executed = shellcommand($cmd);
$parsed   = parseStdout($executed);
//display($parsed);
// echo(PHP_OS.'<br/>');
// $execute = shellCommand('help command');
// display($parsed);
// var_dump($parsed);
//$array = array(get_resources(),getenv(),memory_get_peak_usage(true),php_ini_loaded_file(),get_loaded_extensions());
//var_dump($array);
//$string = var_dump($execute);
//echo($string);
//var_dump($execute);

?>