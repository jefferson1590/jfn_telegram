<?php
     
	$website ="https://api.telegram.org/bot268447449:AAHr1lQDAEKahhPF3DxLRLIX7LIl5l5wYW0/getUpdates";
    $update = file_get_contents($website);
	
	function sendMessage($id,$texto){
		$website1 ="https://api.telegram.org/bot268447449:AAHr1lQDAEKahhPF3DxLRLIX7LIl5l5wYW0/sendMessage?chat_id=".$id."&text=".$texto;
		file_get_contents($website1);
	}

	$x = json_decode($update, true);
	$len = count($x['result']);
	
	$ids = array();
	
	for ($i = 0; $i < $len; $i++) {
		$text =  $x['result'][$i]['message']['text'];
		$id = $x['result'][$i]['message']['chat']['id'];
		$updateId = $x['result'][$i]['update_id'];
	    
		$texto1=preg_match('/^.*\/megaSena/',$text);
	
		if($texto1 == 1){
			
			for ($i = 1; $i <= 6; $i++) { 
				$n[] = str_pad(rand(1, 60), 2, '0', STR_PAD_LEFT); 
			}
			sort($n);
			$text =  implode(' - ', $n);
			
			sendMessage($id,$text);
			$file = 'arquivo.txt';
                    file_put_contents($file, $updateId.',', FILE_APPEND );
		}
		
	}
	
?>
