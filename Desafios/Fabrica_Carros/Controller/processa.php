<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Menu-Fabrica de Veiculos</title>
</head>

<body>



    <?php
    session_start();

    require_once '../Models/Fabrica.php';
    require_once '../Models/Carro.php';
    require_once '../Models/Motos.php';

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $acao = $_POST['acao'] ?? "";

        switch ($acao) {

            case "fabricar":
                echo '
                <div class="container-pai">
                    <div class="container-esquerdo">
                        <div class="fotos-integrantes">
                            <img src="../assets/img/emilly.png" alt="Emmilly luz" class="fotos-inte">
                            <img src="../assets/img/nivea.jpg" alt="Nivea souza" class="fotos-inte">
                            <img src="../assets/img/ana.png" alt="Ana" class="fotos-inte">
                        </div>
                        <div class="titulos">
                            <h2 class="subtitulo-principal">monte o seu veículo</h2>
                            <h1 class="texto-h1">Fábrica de Veículos</h1>
                        </div>
                        <div class="caixa-card">
                            <h3>Fabricar Veículo</h3>
                            <form action="processa.php" method="POST" class="form-menu">
                                <input type="hidden" name="acao" value="criandoVeiculo">
                                <div class="form-inputs-venda">
                                <label>Quantidade de veículos a serem fabricados:</label>
                                <input type="number" min="1" name="qtdeFabricar" required>
                                <label>Escolha um veículo:</label>
                                <select name="tipo_veiculo" required>
                                    <option value="Motos">Moto</option>
                                    <option value="Carros">Carro</option>
                                </select>
                                </div>
                                <div class="caixa-btn">
                                    <button type="submit" class="btn-primeiro">Confirmar</button>
                                    <a href="../View/index.html" class="btn-segundo">Voltar ao menu</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="container-direito"></div>
                </div>';
                break;

            case "criandoVeiculo":
                $qtdeFabricar = $_POST['qtdeFabricar'] ?? "";
                $tipo = $_POST['tipo_veiculo'] ?? "";

                echo '
                <div class="container-pai">
                    <div class="container-esquerdo">
                        <div class="fotos-integrantes">
                            <img src="../assets/img/emilly.png" alt="Emmilly luz" class="fotos-inte">
                            <img src="../assets/img/nivea.jpg" alt="Nivea souza" class="fotos-inte">
                            <img src="../assets/img/ana.png" alt="Ana" class="fotos-inte">
                        </div>
                        <div class="titulos">
                            <h2 class="subtitulo-principal">monte o seu veículo</h2>
                            <h1 class="texto-h1">Fabricando ' . $tipo . '</h1>
                        </div>
                        <div class="caixa-card">
                            <h3>Informe os dados dos veículos</h3>
                            <form action="processa.php" method="POST" class="form-menu">
                                <input type="hidden" name="acao" value="salvarVeiculo">
                                <input type="hidden" name="qtdeFabricar" value="' . $qtdeFabricar . '">
                                <input type="hidden" name="tipo_veiculo" value="' . $tipo . '">';

                for ($i = 1; $i <= $qtdeFabricar; $i++) {
                    echo '
                                <div class="bloco-veiculo">
                                    <label>Modelo (' . $i . '):</label>
                                    <input type="text" name="modelo_' . $i . '" required>
                                    <label>Cor:</label>
                                    <input type="text" name="cor_' . $i . '" required>
                                </div>';
                }

                echo '
                                <div class="caixa-btn">
                                    <button type="submit" class="btn-primeiro">Confirmar</button>
                                    <a href="../View/index.html" class="btn-segundo">Voltar ao menu</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="container-direito"></div>
                </div>';
                break;

            case "salvarVeiculo":
                $qtdeFabricar = $_POST['qtdeFabricar'] ?? "";
                $tipo = $_POST['tipo_veiculo'] ?? "";

                $fabrica = isset($_SESSION['fabrica']) ? unserialize($_SESSION['fabrica']) : new Fabrica();
                $veiculos = [];

                for ($i = 1; $i <= $qtdeFabricar; $i++) {
                    $veiculo = ($tipo == "Motos") ? new Motos() : new Carros();
                    $veiculo->setModelo($_POST["modelo_{$i}"] ?? "");
                    $veiculo->setCor($_POST["cor_{$i}"] ?? "");
                    $veiculos[] = $veiculo;
                }

                $fabrica->fabricarVeiculos($veiculos);
                $_SESSION['fabrica'] = serialize($fabrica);

                echo '
                <div class="container-pai">
                    <div class="container-esquerdo">
                        <div class="fotos-integrantes">
                            <img src="../assets/img/emilly.png" class="fotos-inte">
                            <img src="../assets/img/nivea.jpg" class="fotos-inte">
                            <img src="../assets/img/ana.png" class="fotos-inte">
                        </div>
                        <div class="titulos">
                            <h2 class="subtitulo-principal">monte o seu veículo</h2>
                            <h1 class="texto-h1">Fábrica de Veículos</h1>
                        </div>
                        <div class="caixa-card">
                            <h3>Sucesso na Fabricação</h3>
                            <p class="sucesso">Os veículos da categoria <strong>' . $tipo . '</strong> foram fabricados com sucesso.</p>
                            <div class="caixa-btn">
                                <a href="../View/index.html" class="btn-segundo">Voltar ao menu</a>
                            </div>
                        </div>
                    </div>
                    <div class="container-direito"></div>
                </div>';
                break;

            case "venda":
                $fabrica = unserialize($_SESSION['fabrica'] ?? serialize(new Fabrica()));
                $acaoDois = $_POST['acaoDois'] ?? "";

                echo '<div class="container-pai">
                <div class="container-esquerdo">
                    <div class="fotos-integrantes">
                        <img src="../assets/img/emilly.png" class="fotos-inte">
                        <img src="../assets/img/nivea.jpg" class="fotos-inte">
                        <img src="../assets/img/ana.png" class="fotos-inte">
                    </div>
                    <div class="titulos">
                        <h2 class="subtitulo-principal">monte o seu veículo</h2>
                        <h1 class="texto-h1">Venda de Veículos</h1>
                    </div>
                    <div class="caixa-card">
                        <h3>Escolha o tipo de veículo</h3>
                        <form action="processa.php" method="POST" class="form-menu">
                        <input type="hidden" name="acao" value="venda">
                        <div class="caixa-btn-veiculos">
                            <button name="acaoDois" value="Motos" class="btn-primeiro">Motos</button>
                            <button name="acaoDois" value="Carros" class="btn-primeiro">Carros</button>
                    </div>
                </form>';

                if ($acaoDois) {
                    echo '<h3>' . $acaoDois . ' disponíveis</h3>';
                    $fabrica->mostrarTipoVeiculos($acaoDois);
                    echo '<form action="processa.php" method="POST" class="form-menu-venda">
                        <input type="hidden" name="acao" value="venderCarro">
                        <input type="hidden" name="tipo_veiculo" value="' . $acaoDois . '">
                        <div class="form-inputs-venda">
                            <p class="titulo-card">Informe os dados do veículo a ser vendido:</p>
                            <label>Modelo:</label>
                            <input type="text" name="modelo" required>
                            <label>Cor:</label>
                            <input type="text" name="cor" required>
                        </div>
                        <div class="caixa-btn">
                            <button type="submit" class="btn-primeiro">Vender</button>
                            <a href="../View/index.html" class="btn-segundo">Voltar ao menu</a>
                        </div>
                    </form>';
                }

                echo '</div> <!-- caixa-card -->
                </div> <!-- container-esquerdo -->
                <div class="container-direito"></div>
                </div> <!-- container-pai -->';
                break;


            case "venderCarro":
                $modelo = $_POST['modelo'] ?? "";
                $cor = $_POST['cor'] ?? "";
                $tipo = $_POST['tipo_veiculo'] ?? "";

                $fabrica = unserialize($_SESSION['fabrica'] ?? serialize(new Fabrica()));
                
                $validador = $fabrica->venderVeiculos($modelo, $cor,$tipo);
                $_SESSION['fabrica'] = serialize($fabrica);

                echo '<div class="container-pai">
                    <div class="container-esquerdo">
                        <div class="fotos-integrantes">
                            <img src="../assets/img/emilly.png" class="fotos-inte">
                            <img src="../assets/img/nivea.jpg" class="fotos-inte">
                            <img src="../assets/img/ana.png" class="fotos-inte">
                        </div>
                        <div class="titulos">
                            <h2 class="subtitulo-principal">monte o seu veículo</h2>
                            <h1 class="texto-h1">Venda de Veículos</h1>
                        </div>
                        <div class="caixa-card">';
                if ($validador) {
                    echo '<h3 style="color: #228B22 ">Venda efetuada com sucesso</h3>
                        <p><strong>Categoria:</strong> ' . $tipo . '</p>
                        <p><strong>Modelo:</strong> ' . $modelo . '</p>
                        <p><strong>Cor:</strong> ' . $cor . '</p>';
                } else {
                    echo '<h3>Venda não realizada</h3>
                        <p class="erro">Não há '.$tipo.' em estoque com essas informações.</p>';
                }
                echo '<div class="caixa-btn">
                        <a href="../View/index.html" class="btn-segundo">Voltar ao menu</a>
                    </div>
                    </div>
                </div>
                <div class="container-direito"></div>
            </div>';
                break;

            case "info":
                
                $fabrica = unserialize($_SESSION['fabrica'] ?? serialize(new Fabrica()));
                $acaoInfo = $_POST['acaoInfo'] ?? "";

                echo '<div class="container-pai">
                      <div class="container-esquerdo-info">
                        <div class="caixa-card">
                            <h3>Veículos fabricados</h3>
                            <form action="processa.php" method="POST" class="form-menu">
                                <input type="hidden" name="acao" value="info">
                                <div class="btn-info-veiculos">
                                    <button name="acaoInfo" value="Motos" class="btn-primeiro">Motos</button>
                                    <button name="acaoInfo" value="Carros" class="btn-primeiro">Carros</button>
                                    <button name="acaoInfo" value="infoGeral" class="btn-primeiro">Em estoque</button>
                                </div>
                            </form>';

                switch ($acaoInfo) {
                    case 'Motos':
                    case 'Carros':
                        $fabrica->mostrarTipoVeiculos($acaoInfo);
                        break;
                    case 'infoGeral':
                        $fabrica->mostrarVeiculos();
                        break;
                }

                echo '<form action="processa.php" method="POST" class="form-menu">
                        <input type="hidden" name="acao" value="finalizar_secao">
                        <div class="caixa-btn">
                            <button class="btn-terceiro ">Fechar a Fábrica</button>
                            <a href="../View/index.html" class="btn-segundo">Voltar ao menu</a>
                        </div>
                    </form>
                    </div>
                </div>
                <div class="container-direito"></div>
            </div>';
                break;

            case "finalizar_secao":
                session_destroy();
                echo '<div class="container-pai">
                    <div class="container-esquerdo-info">
                        <div class="caixa-card">
                            <h3>Fábrica Fechada</h3>
                            <p class="sucesso">Os veículos foram destruídos com sucesso.</p>
                            <div class="caixa-btn">
                                <a href="../View/index.html" class="btn-segundo">Voltar ao menu</a>
                            </div>
                        </div>
                    </div>
                    <div class="container-direito"></div>
                </div>';
                break;

            default:
                echo '<div class="container-pai">
                        <div class="container-esquerdo-info">
                            <div class="caixa-card">
                                <p>Ação inválida!</p>
                                <div class="caixa-btn">
                                    <a href="../View/index.html" class="btn-segundo">Voltar ao menu</a>
                                </div>
                            </div>
                        </div>
                        <div class="container-direito"></div>
                    </div>';
                break;
        }
    }
    ?>

</body>

</html>