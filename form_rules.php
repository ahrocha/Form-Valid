<?php
/*
 * Desenvolvedor::. Raphael de Souza Godoi
 *        E-mail::. raphael.fatecandos@gmail.com
 *      Objetivo::. Mapamentos dos campos de um formulário, informar apenas campos
 *                  que deve passar por algum tipo de validação
 *  Data criação::. 30/05/2015 
 * 
 *      IMPORTANTE
 *        - O Array de mapeamento deve respeitar a estrutura e nomenclaturas deste exemplos, caso contrário seu formulário não será validado corretamente
 * 
 *      MAIS INFORMAÇÕES
 *          Ao mapear seus campos você poderá informar as regras que deverão ser validadas, as regras aceitas estão abaixo:
 *          
 *           required recebe true ou false :
 *              - Irá validar o obrigatoriedade do campo, se o mesmo não for preenchido retorna uma mensagem
 *           max recebe um int
 *              - Valida o tamanho máximo do valor informado no campo;
 *           min recebe um int:
 *              - Valida o tamanho mínimo do valor informado no campo;
 *          callback recebe o nome de uma função
 *             - Chama uma função personalizada que deverá retornar sempre true ou false, podem existir quantos, callbacks forem necessários
 *          
 *  */

#exemplo
$rules =
array(
    "frm_cadastro" =>
    array ("nome_razao" => array("label"       => 'razão social',
                                 "required"    => true,
                                 "max"         => 10,
                                 "min"         => 5,
                                 "type"        => "texto"),

                "email" => array("label"       => "E-mail",
                                 "required"    => true,
                                 "max"         => 10,
                                 "callback"    => 'validaEmail'),
        
                 "nome" => array("label"       =>  "Nome",
                                 "required"    =>  true,
                                 "max"         =>  10)
         
    )

);