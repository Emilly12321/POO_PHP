<?php 

require_once 'Models\TrataeMostra.php';


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/styles.css">

    <title>Calculadora_POOV7</title>
</head>

<body>
    <main class="container">

        <?php

        
            TrataeMostra::exibirResultado($error,$operacao,$vlr1,$vlr2,$result);

        ?>

    </main>


</body>

</html>

