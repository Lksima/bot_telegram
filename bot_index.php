<html>
<body>
<?php

$name = "";

if(isset($_GET["name"])) {
	$name = $_GET["name"];
}

?>


Bot do Simas <?= $name?> </br>

<?php

function sendMessage($chatId, $text) {
            file_get_contents("https://api.telegram.org/bot225906168:AAFObjFWTfrwSp9tDaMRYHyPpxzP-qNTJTI/sendMessage?chat_id=". $chatId . "&text=" . $text);
}

$minhapg = file_get_contents("https://api.telegram.org/bot225906168:AAFObjFWTfrwSp9tDaMRYHyPpxzP-qNTJTI/getUpdates");// pega a api do telegram
$text = json_decode($minhapg,true); //  traz um string em forma de json  $text vira um array

$ids = array();

//print_r(json_encode($text,JSON_PRETTY_PRINT)); // separa o codigo "identa"

$var = count($text['result']);
$j = 0;
//laço para buscar mensagem no json 
for ($i=0; $i<$var; $i++){	
	
	$nome = $text['result'][$i]['message']['chat']['first_name'];
	$id = $text['result'][$i]['message']['chat']['id'];
	$msg = $text['result'][$i]['message']['text'];
	//print_r($msg);
	
	$ids[$j] = $id;
	$j++;
	
	if ($msg == '/megasena'){
		for ($c = 1; $c < 6; $c++){
			$numeroMega[$c] = rand(1,60);
		}
		sort($numeroMega);
		$sena = implode('-', $numeroMega); print "<br>";
		$updateid = $text['result'] [$i] ['update_id'];  
		$file='updateid.txt';  //print_r($file);
		file_put_contents($file, $updateId.',', FILE_APPEND);
	
		sendMessage($ids[$i],$sena);
		
	
	}

}
	 //$str = file_get_contents($file);
	  // print_r($str);
$ids = array_unique($ids);
$ids = array_values($ids);
$contagem = count($ids);


//




//print_r($ids);

 //for ($i = 0; $i < $contagem; $i++) {
	//sendMessage($ids[$i],"0x2");
 //}




//echo print_r($text,true);//imprime o texto na tela



?>
</body>
</html>
