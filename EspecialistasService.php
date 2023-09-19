<?php
    // Arquivo de controle : tipo de servicos oferecidos pelo Api   
    include 'Especialistas.php'; //incluir o arquivo Especialistas.php
    class EspecialistasService 
    {
          //Um método "get" para consulta de dados: (protocolo: "get" - buscar os dados no BD)
          // quando "$id = null" significa que pode ter ou não este parâmetro 
          public function get( $id = null )
          {
              if ($id){// se existe $id  
                 //retornar resultado do método select($id) da class Alunos            
                 return Especialistas::select($id) ;
              }else{
                 //retornar resultado do método selectAll() da class Alunos 
                 return Especialistas::selectAll() ;
              }

          }
          //Um método "post" para incluir os dados no BD : (protocolo: "post" - inserir os dados no BD)
          // funcão para inclusão de dados
          public function post()
          {
             /* Método 01 : usando "multipart" no programa Insomnia  
            //Criar uma variável para incluir os dados em vetor (array) usando método "post"
              $dados = $_POST;           

            /* Metodo 02: usnado JSON no Insomnia para incluir dados no banco */           
             $dados = json_decode(file_get_contents('php://input'), true, 512);
             if ($dados == null) {
                 throw new Exception("Faltou as informações para incluir");
             }             
            //retornar resultado do método insert($dados) com parâmetro $dados 
             return Especialistas::insert($dados);
          }
          //Um método "put" para alterar os dados no BD : (protocolo: "put(update)" - alterar os dados no BD)          
          // funcão para alteração de dados
          public function put($id = null)          
          {
              if ($id == null ){
                 throw new Exception("Falta o código");
              }                             
              //Pagar as informações para atualizar no banco
              $dados = json_decode(file_get_contents('php://input'), true, 512);
              if ($dados == null ){
                 throw new Exception("Faltou as informações para alterar");
              }
              return Especialistas::alterar($id, $dados);  
          }
          //Um método "delete" para remover um regsitro no BD : (protocolo: "delete" - remover dados no BD) 
          //funcão para exclusão de dados
          public function delete($id = null)
          {
              if($id == null ){
                  throw new Exception("Falta o código");
              }
              return Especialistas::delete( $id );   
          }
          
   }