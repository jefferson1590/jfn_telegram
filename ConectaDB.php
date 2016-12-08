<?php
class ChamaBD {
    		public function 
	                      ChamaBD(){
                      		 $conect = new PDO("mysql:host=localhost;dbname=Bot_telegram","root","");
                return $conect;  
                                  }
   		public function adicinardados($updateid,$comando,$resposta){
        $sql = "insert into tbbotresposta(update_id,comando,resposta) values (?,?,?)";
        
                
			
		  $adicionarcomando = self::conectarbanco()->prepare($sql);
                  $adicionarcomando->bindParam(1, $updateid);
                  $adicionarcomando->bindParam(2, $comando);
                  $adicionarcomando->bindParam(3, $resposta);
                          $adicionarcomando->execute();
             }
}
