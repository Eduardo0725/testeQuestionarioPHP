<?php
class criadorPerguntas
{
    public $enunciado;
    public $alternativas;
    public $conjunto;

    public function setPerguntas($hidden)
    {
        $perguntas = json_decode(file_get_contents('questoes.json'));

        $img1 = './imgs/sangue.jpg';
        $img2 = './imgs/penso-logo-existo.png';
        $img3 = './imgs/chuveiro.jpg';
        $img4 = './imgs/mundo.jpeg';
        $img5 = './imgs/presidente.jpg';
        $img6 = './imgs/palavras.jpg';
        $img7 = './imgs/livros.png';
        $img8 = './imgs/casas-decimais-de-pi.jpg';
        $img9 = './imgs/quimica.jpg';
        $img10 = './imgs/paises.jpg';

        $imgs = [null, $img1, $img2, $img3, $img4, $img5, $img6, $img7, $img8, $img9, $img10];

?>
        <form name="form" action="?action=inserir" method="post">
            <div>
                <?php
                for ($i = 1; $i <= 10; $i++) {
                ?>
                    <div class="style-div" id="questao<?php echo $i; ?>" name="questao<?php echo $i; ?>">
                        <div class="text-center">
                            <img class="pergunta_img" src="<?php echo $imgs[$i]; ?>">
                        </div>
                        <p><?php echo $i; ?>)<?php echo $perguntas->$i->enunciado; ?></p>
                        <?php
                        $operador = 0;
                        $quant = ['a', 'b', 'c', 'd', 'e'];
                        foreach ($perguntas->$i->alternativas as $alternativa) {
                        ?>
                            <div class="style-primary">
                                <input type="radio" id="pergunta<?php echo $i; ?>resposta<?php echo $operador + 1; ?>" name="pergunta<?php echo $i; ?>" value="<?php echo $i . $quant[$operador]; ?>"></input>
                                <label for="pergunta<?php echo $i; ?>resposta<?php echo $operador + 1; ?>"><?php echo $quant[$operador]; ?>)<?php echo $alternativa; ?></label>
                            </div>
                        <?php
                            $operador = $operador + 1;
                        }
                        ?>
                    </div>
                <?php
                }
                ?>
            </div>
            <input type="hidden" name="nome_usuario" id="nome_usuario" value="<?php echo $hidden[0]; ?>"></input>
            <input type="hidden" name="email_usuario" id="email_usuario" value="<?php echo $hidden[1]; ?>"></input>
            <a id="btn" class="btn btn-success text-white">Enviar</a>
        </form>
        <style>
            .pergunta_img {
                width: 100%;
                max-width: 500px;
                height: 400px;
                border-radius: 15px;
                justify-content: center;
            }

            .style-div label {
                width: 110%;
                border-radius: 3px;
                border: 1px solid #D1D3D4;
                font-weight: normal;
            }

            .style-div input[type="radio"] {
                display: none;
            }

            .style-div input[type="radio"]:empty~label {
                position: relative;
                line-height: 2.5em;
                text-indent: 3.25em;
                margin-bottom: 1em;
                cursor: pointer;
            }

            .style-div input[type="radio"]:empty~label:before {
                position: absolute;
                display: block;
                top: 0;
                bottom: 0;
                left: 0;
                content: '';
                width: 2.5em;
                background-color: #D1D3D4;
                border-radius: 3px 0 0 3px;
            }

            .style-div input[type="radio"]:hover:not(:checked)~label {
                color: blue;
            }

            .style-div input[type="radio"]:hover:not(:checked)~label::before {
                content: '\2714';
                text-indent: .9em;
                color: #fff;
            }

            .style-div input[type="radio"]:checked~label {
                color: #777;
            }

            .style-div input[type="radio"]:checked~label:before {
                content: '\2714';
                text-indent: .9em;
                color: #333;
                background-color: #ccc;
            }

            .style-primary input[type="radio"]:checked~label:before {
                color: #fff;
                background-color: #5cb85c;
            }
        </style>
        <script>
            document.getElementById("btn").setAttribute('onclick', 'btn()');

            function btn() {
                for (i = 1; i <= 10; i++) {
                    name = "pergunta" + i;
                    var perguntas = document.getElementsByName(name);
                    validacao = false;
                    perguntas.forEach((item, index) => {
                        if (item.checked) {
                            validacao = true;
                        } else if (!validacao && index == 4 && !item.checked) {
                            throw alert('Erro, algumas perguntas não foram respondidas!');
                        }
                    })
                    if (i == 10) {
                        document.forms["form"].submit();
                    }
                }
            }
        </script>
<?php
    }
}
