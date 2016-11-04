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

function sendMessage($chatId, $text) {                                               //sendMessage?chat_id="  === PARA PASSAR MENSAGENS DE VOLTA AO TELEGRAM
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
	$updateid = $text['result'][$i]['update_id'];
	//print_r($msg);
	
	$ids[$j] = $id;
	$j++;
	
	
	$file='updateid.txt';  //print_r($file);
	$str = file_get_contents($file);
	 $arrayupdateid = explode(',',$str);
		
		
	if (!in_array($updateid, $arrayupdateid)){
		
		if ($msg == '/megasena'){
			for ($c = 0; $c < 6; $c++){
				$numeroMega[$c] = str_pad(rand(1, 60), 2, '0', STR_PAD_LEFT);
			}
			sort($numeroMega);
			$sena = implode('-', $numeroMega); print "<br>";
      
			sendMessage($ids[$i],$sena);
			file_put_contents($file, $updateid.',', FILE_APPEND);
		}
	}

}
	 
	
	  
	  
	 //print_r($str);
	  //var_dump($str);
	  
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
