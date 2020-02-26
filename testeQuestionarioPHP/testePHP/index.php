<?php
include_once('config.php');
$bd = new Banco();

include_once('perguntas.php');
$perguntas = new criadorPerguntas();

include_once('validacao.php');
$validacao = new Validacao();

include_once('formatacao.php');
$formatacao = new formatacao();
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="./bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <script src="./bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
    <script src="./jquery-3.4.1.min.js"></script>


    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php 
                $pagina = "home";
                if(!empty($_GET["pagina"])){
                    $pagina = $_GET["pagina"];
                }
                if(file_exists("$pagina.php")){
                    include("$pagina.php");
                }else{
                    echo "Pagina não encontrada";
                }
                ?> 
            </div>
        </div>
    </div>
</body>

</html>