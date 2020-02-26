<?php
#'{"pergunta1":"false","pergunta2":"false","pergunta3":"false","pergunta4":"false","pergunta5":"false","pergunta6":"false","pergunta7":"false","pergunta8":"false","pergunta9":"false","pergunta10":"false"}'
class formatacao{
    public $json = '{';
    
    public function formatar($respostas)
    {
        $i = 0;
        foreach ($respostas as $value) {
            if($i != 9){
                if($value == null){
                    $this->json = $this->json.'"pergunta'.($i+1).'":"null",';
                }else{
                    $this->json = $this->json.'"pergunta'.($i+1).'":"'.$value.'",';
                }
            }
            else{
                if($value == null){
                    $this->json = $this->json.'"pergunta'.($i+1).'":"null"';
                }else{
                    $this->json = $this->json.'"pergunta'.($i+1).'":"'.$value.'"';
                }
            }
            $i++;
        }

        $this->json = $this->json.'}';

        return $this->json;
    }
}
