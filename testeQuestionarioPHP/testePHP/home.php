<h2 class="text-center">Questionario</h2>
<div class="">
    <a class="btn btn-primary" href="?pagina=home&action=cadastrar">Cadastrar</a>
    <a class="btn btn-primary" href="?pagina=home">Lista</a>
</div>
<hr>

<?php
$action = '';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}
if ($action == '') {
    $bd->query("select * from tb_usuario");
    $total = $bd->linhas();
    if ($total == '') {
        echo "Nenhum dado encontrado";
    } else {
        $qtd_por_pg = 10;
        $pg = 1;
        if (isset($_GET['p']) && !empty($_GET['p'])) {
            $pg = $_GET['p'];
        }
        $p = ($pg - 1) * $qtd_por_pg;
        $anterior = $pg - 1;
        $proximo = $pg + 1;

        $max_paginas = ceil($total / $qtd_por_pg);

        $posicao = [];
        for ($i = 10; $i >= 0; $i--) {
            foreach ($bd->resultado() as $dados) {
                if ($dados['acertos_usuario'] == $i) {
                    array_push($posicao, [$dados['acertos_usuario'], $dados['nome_usuario'], $dados['email_usuario']]);
                }
            }
        }

        echo "Total de registros encontrados: " . $total . '<br>';
?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">Posição</th>
                    <th>Nome</th>
                    <th class="text-center">Acertos</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php

                for ($i = ($p); $i < ($pg * $qtd_por_pg); $i++) {
                    if ($i <= ($total - 1)) {
                ?>
                        <tr>
                            <td class="text-center"><?php echo ($i + 1) ?></td>
                            <td><?php echo $posicao[$i][1] ?></td>
                            <td class="text-center"><?php echo $posicao[$i][0] ?></td>
                            <td><?php echo $posicao[$i][2] ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>

        <?php
        ?>
        <div class="mx-auto" style="max-width: 175px;">
            <ul class="pagination">
                <?php
                if ($pg > 1) {
                ?>
                    <li class="page-item">
                        <a class="page-link" href="?p=<?php echo $pg - 1 ?>">&laquo;</a>
                    </li>
                    <?php
                }
                if ($max_paginas > 1) {
                    for ($i = 1; $i <= $max_paginas; $i++) {
                    ?>
                        <li class="page-item <?php if ($i == $pg) echo 'active'; ?>">
                            <a class="page-link" href="?p=<?php echo $i ?>"><?php echo $i ?></a>
                        </li>
                    <?php
                    }
                }
                if ($pg < $max_paginas) {
                    ?>
                    <li class="page-item">
                        <a class="page-link" href="?p=<?php echo $pg + 1 ?>">&raquo;</a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    <?php
    }
}

if ($action == 'cadastrar') {
    ?>
    <form action="?action=questionario" name="form" method="post">
        <label>Nome</label>
        <br>
        <input class="form-control" type="text" name="nome_usuario" id="nome_usuario">
        <br>
        <label>Email</label>
        <br>
        <input class="form-control" type="text" name="email_usuario" id="email_usuario">
        <br>
        <a id="btn" class="btn btn-success text-white">Enviar</a>
        <a class="btn border-dark" href="?pagina=home">Cancelar</a>
    </form>
    <script>
        document.getElementById("btn").setAttribute('onclick', 'btn()');

        function btn() {
            if (document.getElementById("nome_usuario").value != '' && document.getElementById("email_usuario").value != '') {
                document.forms['form'].submit();
            } else {
                alert('Erro, campos vazios!');
            }
        }
    </script>
<?php
};

if ($action == 'questionario') {
    $nome_usuario = addslashes(($_POST['nome_usuario']));
    $email_usuario = addslashes(($_POST['email_usuario']));
    $hidden = [$nome_usuario, $email_usuario];
    echo $perguntas->setPerguntas($hidden);
}

if ($action == 'inserir') {
    $nome_usuario = addslashes(($_POST['nome_usuario']));
    $email_usuario = addslashes(($_POST['email_usuario']));
    $respostas = [
        isset($_POST["pergunta1"]) ? $_POST["pergunta1"] : null,
        isset($_POST["pergunta2"]) ? $_POST["pergunta2"] : null,
        isset($_POST["pergunta3"]) ? $_POST["pergunta3"] : null,
        isset($_POST["pergunta4"]) ? $_POST["pergunta4"] : null,
        isset($_POST["pergunta5"]) ? $_POST["pergunta5"] : null,
        isset($_POST["pergunta6"]) ? $_POST["pergunta6"] : null,
        isset($_POST["pergunta7"]) ? $_POST["pergunta7"] : null,
        isset($_POST["pergunta8"]) ? $_POST["pergunta8"] : null,
        isset($_POST["pergunta9"]) ? $_POST["pergunta9"] : null,
        isset($_POST["pergunta10"]) ? $_POST["pergunta10"] : null
    ];
    $respostasCertas = $validacao->validar($respostas);
    $json = $formatacao->formatar($respostas);
    $bd->query("insert into tb_usuario (nome_usuario,email_usuario,acertos_usuario,perguntas_usuario) values ('$nome_usuario','$email_usuario','$respostasCertas','$json');");
    $action = '';
}
?>