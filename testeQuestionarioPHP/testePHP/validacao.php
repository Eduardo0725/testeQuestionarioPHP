<?php
class validacao
{
    public function validar($respostas)
    {
        $questoes = json_decode(file_get_contents('questoes.json'));

        $respostasCertas = 0;
        for ($i = 1; $i <= 10; $i++) {
            if (strval($i . $questoes->$i->correct) == $respostas[$i-1]) {
                $respostasCertas = $respostasCertas + 1;
            }
        }

        if($respostasCertas >= 7){
            ?>
            <h1>Você foi aprovado!</h1>
            <?php
        }else{
            ?>
            <h1>Você foi reprovado!</h1>
            <?php
        }
        ?>
        <p>Vocẽ acertou <?php echo ($respostasCertas*10).'%' ?> do questionário.</p>
        <a class="btn btn-success" href="?pagina=home">&raquo;&raquo;&raquo;&raquo;</a>
        <?php
        return $respostasCertas;
    }
}
