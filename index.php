<?php


session_start();
header('Content-Type: text/html; charset=utf-8');



$mensagem = null;
$tipoMensagem = 'success';

$pessoa = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $acao = $_POST['acao'];

    //Busca
    if ($acao == 'B') {

        $cpf = str_replace(array(',', '.', '-'), '', 9876547654);
        $_SESSION['cpf'] = $cpf;


        //Salvar
    } elseif ($acao == 'S') {

        //echo ($_POST['cpf'] . ' - ' . $_POST['nome'] . ' - ' . $_POST['rua'] . ' - ' . $_POST['numero'] . ' - ' . $_POST['complemento'] . ' - ' . $_POST['bairro'] . ' - ' . $_POST['cidade'] . ' - ' . $_POST['cep'] . ' - ' . $_POST['telefone'] . ' - ' . $_POST['telefoneWhatsapp'] . ' - ' . $_POST['banco'] . ' - ' . $_POST['nome_do_banco']);


        $cpf = 4567;
        $rua = 56789;
        $numero = 123456;
        $complemento = 143567;
        $bairro = 'JKLJH';
        $cidade = 987;
        $uf = 'OLKJHG';
        $cep = 56765;
        $telefone = 9876;
        $telefoneWhatsapp = 12345;
        $email = 13245;
        $banco = 34567;

        if ("123 - BANCO X") {

            $banco = explode('-', $banco);
            $bancoCodigo = trim($banco[0]);
            $bancoNome = trim($banco[1]);
        }

        $agencia = 87654;
        $conta = 6546;
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

    <!-- Autocomplete -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <script src="js/autocomplete.js"></script>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <!-- select2 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.full.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap');

        body {
            height: 100%;
            margin: 0
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        button:focus,
        input:focus {
            outline: none;
            box-shadow: none;
        }

        a,
        a:hover {
            text-decoration: none;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #ddd;

        }


        /*------------*/
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxOS4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9Ii00NzMgMjc3IDEyIDgiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgLTQ3MyAyNzcgMTIgODsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4NCgkuc3Qwe2ZpbGw6IzhBOTNBNjt9DQo8L3N0eWxlPg0KPHBhdGggY2xhc3M9InN0MCIgZD0iTS00NzEuNiwyNzcuM2w0LjYsNC42bDQuNi00LjZsMS40LDEuNGwtNiw2bC02LTZMLTQ3MS42LDI3Ny4zeiIvPg0KPC9zdmc+DQo=) calc(100% - 18px) / 11px no-repeat;
        }

        .form-area {
            background-color: #fff;
            box-shadow: 0px 4px 8px rgb(0 0 0 / 16%);
            padding: 40px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-area .form-inner {
            width: 100%;
        }

        .form-group {
            position: relative;
            margin-bottom: 30px;
        }

        .form-control {
            display: block;
            width: 100%;
            height: auto;
            padding: 8px 19px;
            padding-top: 21px;
            min-height: 55px;
            font-size: 1rem;
            color: #475F7B;
            background-color: #FFF;
            border: 1px solid #DFE3E7;
            border-radius: .267rem;
            -webkit-transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        select.form-control {
            padding-top: 10px;
            transition: 0.15s;
        }

        .form-control:focus {
            color: #475F7B;
            background-color: #FFF;
            border-color: #5A8DEE;
            outline: 0;
            box-shadow: none;
        }

        .floating-label {
            font-size: 16px;
            font-weight: 400;
            color: #475F7B;
            opacity: 1;
            top: 16px;
            left: 20px;
            pointer-events: none;
            position: absolute;
            transition: 240ms;
            margin-bottom: 0;
            z-index: 1;
        }

        .floating-diff .floating-label {
            opacity: 0;
        }

        .floating-diff.focused .floating-label {
            opacity: 1;
        }

        .form-group.focused .floating-label {
            opacity: 1;
            color: #7b7f82;
            top: 4px;
            left: 19px;
            font-size: 12px;
        }

        .form-group.focused select.form-control {
            padding-top: 21px;
        }

        .float-checkradio {
            background-color: #FFF;
            border: 1px solid #DFE3E7;
            border-radius: .267rem;
            padding: 8px 19px;
            transition: 0.3s;
            min-height: 55px;
        }

        .float-checkradio.focused {
            padding-top: 21px;
        }



        /*--------select2-css----*/
        .select2Part .floating-label {
            opacity: 0;
        }

        .select2Part.focused .floating-label {
            opacity: 1;
        }

        .select2multiple .floating-label {
            opacity: 1;
        }

        .select2Part.focused .select2-container--default .select2-selection--single .select2-selection__rendered {
            padding-top: 13px;
        }

        .select2-container--default .select2-selection--single {
            border: 1px solid #DFE3E7;
            height: 55px;
        }

        .select2-container--focus.select2-container--default .select2-selection--single {
            border: 1px solid #5A8DEE;
            background-color: #fff;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 40px;
            transition: 240ms;
            padding-right: 40px;
            font-size: 16px;
            font-weight: 400;
            color: #475F7B;
            padding-top: 7px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 53px;
            right: 15px;
            transition: 240ms;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: rgb(236 238 241);
            color: #4a494a;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border: none;
            background: url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxOS4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9Ii00NzMgMjc3IDEyIDgiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgLTQ3MyAyNzcgMTIgODsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4NCgkuc3Qwe2ZpbGw6IzhBOTNBNjt9DQo8L3N0eWxlPg0KPHBhdGggY2xhc3M9InN0MCIgZD0iTS00NzEuNiwyNzcuM2w0LjYsNC42bDQuNi00LjZsMS40LDEuNGwtNiw2bC02LTZMLTQ3MS42LDI3Ny4zeiIvPg0KPC9zdmc+DQo=') no-repeat 0 0;
            width: 12px;
            height: 8px;
            background-size: 100% 100%;
            transform: translateY(-50%);
            left: 0;
            right: 0;
            margin: auto;
        }

        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #5A8DEE;
            color: #fff;
        }

        .select2-container--default .select2-results__option:last-child {
            border-radius: 0px 0px 4px 4px;
        }

        .select2-container--default .select2-selection--single {
            border-radius: .267rem;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-left: 19px;

        }

        .select2-container--default.select2-container--open.select2-container--above .select2-selection--multiple,
        .select2-container--default.select2-container--open.select2-container--above .select2-selection--single {
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
        }

        .select2-results__option {
            padding: 8px 18px;
            user-select: none;
            -webkit-user-select: none;
            color: #4F4F4F;
            font-size: 15px;
            font-weight: 400;
        }

        .select2-container--open .select2-dropdown--above {
            box-shadow: 0px 6px 32px rgb(0 0 0 / 10%);
            border-radius: 0px;
            border: none;
            top: 8px;
            border-radius: 6px;
            overflow: hidden;
        }

        .select2-container--open .select2-dropdown--below {
            box-shadow: 0px 2px 18px rgb(0 0 0 / 16%);
            border-radius: 0px;
            border: none;
            top: -8px;
            border-radius: 6px;
            overflow: hidden;
        }

        .select2Part.w-100>.select2-container {
            width: 100% !important;
        }

        .select2-search--dropdown {
            padding: 12px 15px;
            position: relative;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            font-size: 14px;
            border: 1px solid #DFE3E7;
            border-radius: 4px;
            color: #757575;
            padding: 10px 15px;
            background-color: #fff;
            position: relative;
            padding-right: 45px;
        }

        .select2-container--default .select2-search--dropdown:after {
            content: "\f002";
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            top: 23px;
            right: 30px;
            font-size: 15px;
            color: rgba(0, 0, 0, 0.54);
        }

        .select2-container--default .select2-selection--multiple {
            background-color: #fff;
            border: 1px solid #DFE3E7;
            min-height: 50px;
            border-radius: 6px;
            position: relative;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border: 1px solid #5A8DEE;
            background-color: #fff;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__rendered {
            color: #757575;
            line-height: 55px;
            padding-right: 40px;
            display: block;
            height: 100%;
            padding-bottom: 7px;
            padding-top: 17px;
            padding-left: 17px;
            transition: 240ms;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__arrow {
            height: 48px;
            right: 15px;
        }

        .select2-container--default .select2-selection--multiple .select2-search--inline .select2-search__field {
            line-height: initial;
            padding: 0;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__rendered:before {
            border: none;
            content: '';
            background: url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxOS4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9Ii00NzMgMjc3IDEyIDgiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgLTQ3MyAyNzcgMTIgODsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4NCgkuc3Qwe2ZpbGw6IzhBOTNBNjt9DQo8L3N0eWxlPg0KPHBhdGggY2xhc3M9InN0MCIgZD0iTS00NzEuNiwyNzcuM2w0LjYsNC42bDQuNi00LjZsMS40LDEuNGwtNiw2bC02LTZMLTQ3MS42LDI3Ny4zeiIvPg0KPC9zdmc+DQo=') no-repeat 0 0;
            width: 12px;
            height: 8px;
            background-size: 100% 100%;
            transform: translateY(-50%);
            position: absolute;
            right: 18px;
            top: 26px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
            list-style: none;
            line-height: initial;
            padding: 5px;
            font-size: 14px;
            position: relative;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #f1f1f1;
            border: 1px solid #f1f1f1;
            border-radius: 4px;
            cursor: default;
            float: left;
            color: #1f1f1f;
            margin-right: 5px;
            margin-top: 5px;
            width: initial !important;
            padding: 5px 10px;
            padding-right: 24px !important;
            font-size: 13px !important;
            letter-spacing: 0.3px;
        }

        .select2-container--default .select2-search--inline .select2-search__field {
            width: 100% !important;
            font-size: 16px;
            margin-top: 0px;
            padding: 0;
            padding-left: 5px;
            line-height: 27px;
            padding-top: 6px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            position: absolute;
            font-size: 17px;
            width: 20px;
            height: 20px;
            top: 3px;
            text-align: center;
            color: #e45555;
            right: 0px;
        }

        .floating-group.focused .select2-container--default .select2-selection--multiple .select2-selection__rendered {
            padding-bottom: 7px;
            padding-top: 17px;
            padding-left: 17px;
        }
    </style>

</head>

<body>
                            <form method="post">
                               


                                        <div class="form-group select2Part w-100 floating-group">
                                            <label class="floating-label">Funcionário</label>
                                            <select name="" id="state" class="form-control customSelectMultiple floating-control" placeholder="Informe o nome do Funcionário">
                                                <option value=""></option>

                                            </select>
                                            <select class="js-data-example-ajax"></select>
                                        </div>
                                        <!-- ************************************************************************* -->
                                        
                            </form>
                            </div>
                    </div>
                </div>
            </div>

            <!-- JavaScript Libraries -->

            <script>
                $(document).ready(function() {

                    $('.js-data-example-ajax').select2({
  ajax: {
    url: 'https://api.github.com/orgs/select2/repos',
    data: function (params) {
      var query = {
        search: params.term,
        type: 'public'
      }

      // Query parameters will be ?search=[term]&type=public
      return query;
    }
  }
});
                    $.getJSON("bancos.json", function(json) {
                        $.each(json, function(key, entry) {
                            entry.cpf = String(entry.cpf).slice(0,3)+".***.***-"+String(entry.cpf).slice(9,11);
                            $('#state').append($('<option></option>').attr('value', entry.id).text(String(entry.cpf) +" - "+ entry.label ));
                        })
                    });

                    //---- select2 multiple----
                    $('.customSelectMultiple').each(function() {
                        var dropdownParents = $(this).parents('.select2Part');
                        var placehldrget = $(this).attr("data-placeholder");

                        $(this).select2({
                            dropdownParent: dropdownParents,
                            placeholder: "Funcionário",
                            // tags: true,
                            // closeOnSelect: false,
                        }).on("select2:open", function(e) {
                            $(this).parents('.floating-group').addClass('focused');
                            $('.select2-selection__placeholder').attr("hidden", true);
                        }).on("select2:close", function(e) {
                            if ($(this).val() != '') {
                                $(this).parents('.floating-group').addClass('focused');
                                alert("Id: "+$(this).val());
                            } else {
                                $(this).parents('.floating-group').removeClass('focused');
                                $('.select2-selection__placeholder').removeAttr("hidden");
                            }
                        }).on("select2:select", function(e) {
                            $(this).parents('.floating-group').addClass('focused');
                        }).on("select2:unselect", function(e) {
                            $(this).parents('.floating-group').addClass('focused');
                           
                        })
                    });
                });
            </script>

</body>
</html>