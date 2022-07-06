<?php

session_start();
header('Content-Type: text/html; charset=utf-8');

include_once './src/Query.class.php';

$mensagem = null;
$tipoMensagem = 'success';

$pessoa = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $acao = $_POST['acao'];

    //Busca
    if ($acao == 'B') {

        $cpf = str_replace(array(',', '.', '-'), '', $_POST['cpf']);
        $_SESSION['cpf'] = $cpf;

        $pessoa = Query::getPessoa($cpf);
        var_dump("var_dump(\$pessoa)", $pessoa);

        if ($pessoa == null) {
            $tipoMensagem = 'warning';
            $mensagem = 'CPF informado não localizado.';
        }

        //Salvar
    } elseif ($acao == 'S') {

        //echo ($_POST['cpf'] . ' - ' . $_POST['nome'] . ' - ' . $_POST['rua'] . ' - ' . $_POST['numero'] . ' - ' . $_POST['complemento'] . ' - ' . $_POST['bairro'] . ' - ' . $_POST['cidade'] . ' - ' . $_POST['cep'] . ' - ' . $_POST['telefone'] . ' - ' . $_POST['telefoneWhatsapp'] . ' - ' . $_POST['codigo_banco'] . ' - ' . $_POST['nome_do_banco']);

        $cpf = str_replace(array(',', '.', '-'), '', $_SESSION['cpf']);
        $cpf = str_replace(array(',', '.', '-'), '', $_POST['cpf']);
        $rua = trim($_POST['rua']);
        $numero = trim($_POST['numero']);
        $complemento = trim($_POST['complemento']);
        $bairro = trim($_POST['bairro']);
        $cidade = trim($_POST['cidade']);
        $uf = trim($_POST['uf']);
        $cep = trim($_POST['cep']);
        $telefone = trim($_POST['telefone']);
        $telefoneWhatsapp = trim($_POST['telefoneWhatsapp']);
        $email = trim($_POST['email']);
        $bancoCodigo = trim($_POST['codigo_banco']);
        $bancoNome = trim($_POST['nome_do_banco']);

        // if ($banco) {
        //     $banco = split('|', $banco);
        //     $bancoCodigo = trim($banco[0]);
        //     $bancoNome = trim($banco[1]);
        // }

        $agencia = trim($_POST['agencia']);
        $conta = trim($_POST['conta']);

        if (Query::salvar($cpf, $rua, $numero, $complemento, $bairro, $cidade, $uf, $cep, $telefone, $telefoneWhatsapp, $email, $bancoCodigo, $bancoNome, $agencia, $conta)) {
            $tipoMensagem = 'success';
            $mensagem = 'Dados salvos!';
        } else {
            $tipoMensagem = 'danger';
            $mensagem = 'Ocorreu um erro. '; //.Query::getErro();
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Reciprev</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="lib/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="lib/bootstrapicons/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <div class="container-xxl mt-4">

            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.3s">
                        <?php
                        if ($mensagem) {
                        ?>
                            <div class="row g-3 mt-1">
                                <div class="col-md-12">
                                    <div class="alert alert-<?= $tipoMensagem ?> alert-dismissible fade show" role="alert">
                                        <?= $mensagem ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            <?php
                        }
                            ?>
                            <form method="post">
                                <div class="row g-2">
                                    <h4>Busca por:</h4>
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input id="cpf" name="cpf" value="<?= $cpf ?>" type="text" class="form-control cpf" placeholder="CPF">
                                            <label for="cpf">CPF</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6  mb-3">
                                        <button id="acao" name="acao" value="B" class="btn btn-primary w-50 py-3" type="submit">Buscar</button>
                                    </div>
                                </div>
                            </form>

                            <form method="post">
                                <div class="row g-2">
                                    <?php
                                    if ($pessoa) {
                                    ?>

                                        <hr>
                                        <h4>Dados Pessoais:</h4>
                                        <input id="cpf" name="cpf" value="<?= $cpf ?>" type="text" class="form-control cpf d-none" style="diplay:none" placeholder="CPF">
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input id="nome" name="nome" value="<?= trim($pessoa['nome']) ?>" type="text" class="form-control" placeholder="Nome" readonly>
                                                <label for="nome">Nome</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input id="valorPago" name="valorPago" value="<?= formatMoney(trim($pessoa['valor_pago'])) ?>" type="text" class="form-control" placeholder="Valor Pago" readonly>
                                                <label for="valorPago">Valor Pago</label>
                                            </div>
                                        </div>
                                        <hr>
                                        <h4>Endereço:</h4>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input id="rua" name="rua" value="<?= trim($pessoa['rua']) ?>" type="text" class="form-control" placeholder="Rua" maxlength="100">
                                                <label for="rua">Logradouro</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-floating">
                                                <input id="numero" name="numero" value="<?= trim($pessoa['numero']) ?>" type="text" class="form-control" placeholder="Número" maxlength="100">
                                                <label for="numero">Número</label>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-sm-8">
                                            <div class="form-floating">
                                                <input id="complemento" name="complemento" value="<?= trim($pessoa['complemento']) ?>" type="text" class="form-control" placeholder="Complemento" maxlength="100">
                                                <label for="complemento">Complemento</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-floating">
                                                <input id="bairro" name="bairro" value="<?= trim($pessoa['bairro']) ?>" type="text" class="form-control" placeholder="Bairro" maxlength="100">
                                                <label for="bairro">Bairro</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-floating">
                                                <input id="cidade" name="cidade" value="<?= trim($pessoa['cidade']) ?>" type="text" class="form-control" placeholder="Cidade" maxlength="100">
                                                <label for="cidade">Cidade</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-floating">
                                                <select id="uf" name="uf" class="form-control">
                                                    <?php
                                                    $estados = array(
                                                        '' => '** Selecione **',
                                                        'AC' => 'Acre',
                                                        'AL' => 'Alagoas',
                                                        'AP' => 'Amapá',
                                                        'AM' => 'Amazonas',
                                                        'BA' => 'Bahia',
                                                        'CE' => 'Ceará',
                                                        'DF' => 'Distrito Federal',
                                                        'ES' => 'Espírito Santo',
                                                        'GO' => 'Goiás',
                                                        'MA' => 'Maranhão',
                                                        'MT' => 'Mato Grosso',
                                                        'MS' => 'Mato Grosso do Sul',
                                                        'MG' => 'Minas Gerais',
                                                        'PA' => 'Pará',
                                                        'PB' => 'Paraíba',
                                                        'PR' => 'Paraná',
                                                        'PE' => 'Pernambuco',
                                                        'PI' => 'Piauí',
                                                        'RJ' => 'Rio de Janeiro',
                                                        'RN' => 'Rio Grande do Norte',
                                                        'RS' => 'Rio Grande do Sul',
                                                        'RO' => 'Rondônia',
                                                        'RR' => 'Roraima',
                                                        'SC' => 'Santa Catarina',
                                                        'SP' => 'São Paulo',
                                                        'SE' => 'Sergipe',
                                                        'TO' => 'Tocantins'
                                                    );
                                                    foreach ($estados as $sigla => $estado) {
                                                    ?>
                                                        <option <?= (trim($pessoa['uf']) == $sigla ? 'selected' : '') ?> value="<?= $sigla ?>"><?= $estado ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <label for="numero">U.F.</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-8">
                                            <div class="form-floating">
                                                <input id="email" name="email" value="<?= trim($pessoa['email']) ?>" type="email" class="form-control email" placeholder="e-mail  (exemplo@email.com)" maxlength="100">
                                                <label for="cidade">E-mail</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-floating">
                                                <input id="telefone" name="telefone" value="<?= trim($pessoa['telefone']) ?>" type="text" class="form-control telefone" placeholder="Telefone">
                                                <label for="telefone">Telefone</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-floating">
                                                <input id="telefoneWhatsapp" name="telefoneWhatsapp" value="<?= trim($pessoa['telefone_whatsapp']) ?>" type="text" class="form-control telefone" placeholder="WhatsApp">
                                                <label for="telefoneWhatsapp">WhatsApp</label>
                                            </div>
                                        </div>
                                        <hr>
                                        <h4>Dados Bancários:</h4>
                                        <div class="col-md-12 col-sm-12 ui-widget">
                                            <div class="form-float">
                                                <div class="form-floating">
                                                    <input id="banco" name="banco" value="<?= trim($pessoa['codigo_banco']) ?>" type="text" class="form-control" placeholder="Cód. Banco" maxlength="100">
                                                    <label for="banco">Banco</label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-floating">
                                                <input id="codigo_banco" name="codigo_banco" value="<?= trim($pessoa['codigo_banco']) ?>" type="text" class="form-control" placeholder="Cód. Banco" maxlength="100">
                                                <label for="codigo_banco">Cód. Banco</label>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-sm-8">
                                            <div class="form-floating">
                                                <input id="nome_do_banco" name="nome_do_banco" value="<?= trim($pessoa['nome_do_banco']) ?>" type="text" class="form-control" placeholder="nome_do_banco" maxlength="100">
                                                <label for="nome_do_banco">Nome do Banco</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-floating">
                                                <input id="agencia" name="agencia" value="<?= trim($pessoa['agencia']) ?>" type="text" class="form-control " placeholder="Agência">
                                                <label for="agencia">Nº Agência</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-floating">
                                                <input id="conta" name="conta" value="<?= trim($pessoa['conta']) ?>" type="text" class="form-control input-sm" placeholder="Conta">
                                                <label for="conta">Nº Conta</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-check">
                                                <input id="aceite" name="aceite" value="1" type="checkbox" class="form-check-input">
                                                <label for="conta">Declaro que as informações acima prestadas são verdadeiras, e assumo a inteira responsabilidade pelas mesmas.</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <button id="salvar" name="salvar" value="S" class="btn btn-primary w-50 py-3 " type="submit">Salvar</button>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </form>
                            </div>
                    </div>
                </div>
            </div>


            <!-- JavaScript Libraries -->
            <script src="js/jquery-3.4.1.min.js"></script>
            <script src="js/bootstrap.bundle.min.js"></script>
            <script src="lib/wow/wow.min.js"></script>
            <script src="lib/easing/easing.min.js"></script>
            <script src="lib/waypoints/waypoints.min.js"></script>
            <script src="lib/owlcarousel/owl.carousel.min.js"></script>
            <script src="lib/jquerymask/jquery.mask.min.js"></script>

            <!-- Template Javascript -->
            <script src="js/main.js"></script>

            <script>
                $('#salvar').prop("disabled", true);
                $('#aceite').click(function() {
                    if ($(this).is(':checked')) {
                        $('#salvar').prop("disabled", false);
                    } else {

                        $('#salvar').attr('disabled', true);

                    }
                });
            </script>
</body>


</html>