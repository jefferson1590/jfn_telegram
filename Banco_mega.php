
<?php

$nome_servidor = "localhost";
$nome_usuario = "boot";
$senha = "";
$nome_banco = "MsgBanco";   
$conecta = new mysqli($nome_servidor,$nome_usuario,$senha,$nome_banco);
if ($conecta->connect_error) {
die("A Conexão falhou: " . $conecta->connect_error."<br>");
}
		echo "Conexão realizada !! <br>";
 $sql = "SELECT id,conversa, megasena FROM conversa";
    $result = $conecta->query($sql);
        if ($result->num_rows > 0) {
    while($linha = $result->fetch_assoc()) {
         echo "id: " . $linha["id"]. " - Name: " . $linha["conversa"]. " " . $linha["megasena"]. "<br>";
        }
        }else {
        echo "0 results";
        }
$url=file_get_contents('https://api.telegram.org/bot268447449:AAHr1lQDAEKahhPF3DxLRLIX7LIl5l5wYW0/getUpdates');
$x=json_decode($url,true);
$xLen=count($x['result']);

		for ($i=0;$i<$xLen;$i++)
{
    $idUpdate[$i] = $x['result'][$i]['update_id'];  
    $idChat[$i] = $x['result'][$i]['message']['chat']['id'];
    $text[$i] = $x['result'][$i]['message']['text'];
}
$file = "idUpdate.txt";
$str = file_get_contents($file);
$arrFile =  explode( ',', $str);

for ($i = 1; $i <= 6; $i++)
{
    $n[] = str_pad(rand(1, 60), 2, '0', STR_PAD_LEFT); 
}
sort($n);
$mega = implode(' - ', $n);

for ($i=0;$i<$xLen;$i++) 
{
    if (!in_array($idUpdate[$i], $arrFile))
    {
        if ($text[$i] == '/megaSena') 
        {
            $url = 'https://api.telegram.org/bot268447449:AAHr1lQDAEKahhPF3DxLRLIX7LIl5l5wYW0/sendMessage?chat_id='.$idChat[$i]."&text=$mega";
            file_get_contents($url);
            file_put_contents($file, $idUpdate[$i].",", FILE_APPEND | LOCK_EX);
            print ($mega);
            $sql = "INSERT INTO conversa (id,conversa,megasena)
                    VALUES ('$idUpdate[$i]','$idChat[$i]','$mega',1)";
            if ($conecta->query($sql) === TRUE) {
            echo "Registro criado com sucesso";
            } else {
            echo "Erro: " . $sql . "<br>" . $conecta->error."<br>";
            }

        mysqli_query($conecta,"insert into boot values ($idUpdate[$i],$idChat[$i],$mega,1);");
        }
    }
}
$conecta->close();
?>

</body>
