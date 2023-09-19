<?php
    // Este programa é para execução do Api_Consultas

    include 'EspecialistasService.php'; //incluir arquivo EspecialistasService.php
    
    //Colocando o cabecalho para retornar os dados em formado json na saida
    header("Content-Type: application/json; charset=UTF-8");     
   
    // $_GET eh uma variável do tipo array() que pegar link (endereço)
    // Metodo GET é um protocolo de solicitação
    /* Um array associativo de variáveis passadas para o script 
    atual via os parâmetros da URL (também conhecidos como query string). 
    Note que o array não é preenchido apenas para solicitações GET, 
    mas também para todas requisições com uma query string. */

    //var_dump($_GET); //testar !!!
    if ($_GET['url']){// se houver url ele cria a variável $url 
       
        // O comando var_dump(..) é para imprimir (mostrar)
        //var_dump($_GET); //testar !!!
        //var_dump($_GET['url']); //testar !!!
        $url = explode('/' , $_GET['url']);
        //var_dump($url);  // mostrar a url

         
        if ($url[0] === 'api' ){//se estiver tentando acessar a api 
            // Removendo a primeira posição do registro e retorna o resto (neste caso api)          
            array_shift($url);
            
            /*ucfirst — Converte para maiúscula o primeiro caractere de uma string;
              Retorna uma string com o primeiro caractere de str em maiúscula, 
              se o caractere for do alfabeto. */
            //var_dump($url);  // mostrar a url 
            $service = ucfirst($url[0]).'Service' ;  

            //Removendo a primeira posição do registro (neste caso Alunos)
            array_shift($url); //neste caso $url ficar como um vetor vazio
            
            //var_dump($url); //testar !!!            
            
            $method = strtolower( $_SERVER['REQUEST_METHOD']); // metodo get ou post (minusculo)  
            //$method = $_SERVER['REQUEST_METHOD']; // metodo get ou post (Maiuscilo)           
            //var_dump($service) ;  //  testar !!         
            //var_dump($method) ;   //testar !!    
            // die(); comando para morrer processo atual !!!
           
            //Trazer os dados do BD
            try {
                // chamando o metodo call_user_func_array(..) para buscar os dados
                $response =  call_user_func_array(array( new  $service , $method), $url) ;
                
                http_response_code(200) ; // ok
                //convertendo o resultado em json e mostrando os dados;
                echo json_encode( array('status' => 'sucess' , 'data' => $response));
                
            } catch (Exception $e) {
                http_response_code(404) ; // erro
                //mostrando a mensagem de erro (não encontrado);
                echo json_encode( array('status' => 'error' , 'data' => $e->getMessage()));
                
            }  

        } 
    }
