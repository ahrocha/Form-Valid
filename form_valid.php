<?php
#Definição das regras
include 'form_rules.php';

#Funções personalizadas
include 'form_callback.php';

function viewErrors($errors)
{
    
     $var_errors = null;
       
      foreach ($errors as $error){
           
           $var_errors = $error.'<br/>'.$var_errors;
                   
      }
      
      return $var_errors;
    
}

function formValidClean($form_valid)
{
    $form_valid_clean = false;
    
     foreach ($form_valid as $campo => $erro){
        
        if(!is_null($erro)){
            $form_valid_clean[$campo] = $erro;
        }
    }
    
    return $form_valid_clean;
    
}

function formValid($form,$fields)
{
   foreach ($fields as $field =>$value){
        
        $form_valid[$field] = formMap($form,$field,$value);
        
    }
     
    #Retorna um array com todos os campos mapeados
    return formValidClean($form_valid);
    
}

function formMap($var_form,$var_field,$var_value)
{
    
    #Carrega o mapeamento dos campos 
    global $rules;
    
    #Carrega o array de validação
    $form_valid = null;
    
    #Percorre o mapeamento dos campo
    foreach ($rules as $formulario => $detalhe):
        
        #Encontra o formulário que está sendo validado
        if($formulario == $var_form){

            if(is_array($detalhe)){
                 
                foreach ($detalhe as $campo => $valor):

                    if($campo==$var_field){
                         
                        if(is_array($valor)){
                             
                            #Validação das regras
                            foreach ($valor as $regra => $validar):
                               
                               ##################PROPRIEDADES DO CAMPO#######################################
                               
                               $tamanho_atual = strlen($var_value);  
                               $field_name    = isset($valor['label'])? $valor['label'] : null;
                              
                               #Se a chave label for null o nome do campo sera o atributo name do formulário
                               if(is_null($field_name)){
                                   
                                   $field_name = $campo;
                               }
                              
                               ##################REGRAS######################################################
                                
                                #Verifica se o campo é obrigatório
                                if($regra=='required' and $validar==true){
                                    
                                    if(empty($var_value)){
                                        
                                        $form_valid = "O campo $field_name é obrigatório!";
                                        break;
                                    }
                                
                                #Chama uma função personalizada    
                                }elseif($regra=='callback'){
                                    
                                     if(!call_user_func($validar, $var_value)){
                                        
                                        $form_valid = "O campo $field_name não é um email válido!";
                                        break;
                                    }
       
                                }elseif($regra=='min'){
                                    
                                    if($tamanho_atual < $validar){
                                        
                                        $form_valid = "O campo deve ter no mínimo $validar caracteres, tamanho atual: $tamanho_atual";
                                        break;
                                    }
                                    
                                }elseif($regra=='max'){
                                    
                                     if($tamanho_atual > $validar){
                                       
                                       $form_valid = "O campo deve ter no máximo $validar caracteres, tamanho atual: $tamanho_atual";
                                        break;
                                    }
                                    
                                }
                                
                                #################FIM DA REGRAS#################################################
                                
                            endforeach;
                        }
                    }
                endforeach;
            }

        } #formulario
    endforeach;

    #Retorna um array com o resultado da valida��o
    return $form_valid;

}