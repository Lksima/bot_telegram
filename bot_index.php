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
$conexao = new PDO("mysql:host=127.0.0.1:3306;dbname=Bot_Telegram", "root", "");
$sql = "insert into resultado(updateid,nome_comando,text_resposta,chatid) values(?,?,?,?)";

//echo inverse(0) . "\n";
for ($i=0; $i<$var; $i++){	
	
	if(!isset($text['result'][$i]['message']['text'])) {
		continue;
	}
	
	$nome = $text['result'][$i]['message']['chat']['first_name'];
	$id = $text['result'][$i]['message']['chat']['id'];
	$msg = $text['result'][$i]['message']['text'];
	$msg = strtolower($msg);

	$updateid = $text['result'][$i]['update_id'];
	//print_r($msg);
	

	
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
	  
			sendMessage($id,$sena);
			file_put_contents($file, $updateid.',', FILE_APPEND);
			
			$stmt = $conexao->prepare($sql);
			$stmt->bindParam(1,$updateid);
			$stmt->bindParam(2,$msg);
			$stmt->bindParam(3,$sena);
			$stmt->bindParam(4,$id);
			$stmt->execute();			
			
		} 
	}
}

$conn=null;	

 //for ($i = 0; $i < $contagem; $i++) {
	//sendMessage($ids[$i],"0x2");
 //}
//echo print_r($text,true);//imprime o texto na tela

?>
