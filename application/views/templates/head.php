<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo_pagina ?></title>

    <link href="/public/assets/vendor/css/materialicons.css" rel="stylesheet">
    <link href="/public/assets/vendor/css/materialize.css" rel="stylesheet">
    <link href="/public/assets/vendor/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

    <style>
        .footer-padrao {
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <script src="/public/assets/vendor/js/jquery-3.6.0.js"></script>
    <script src="/public/assets/vendor/js/materialize.js"></script>
    <script src="/public/assets/vendor/js/jquery.mask.js"></script>
    <script src="/public/assets/vendor/js/jquery.dataTables.js" type="text/javascript"></script>
    <script>
        $(function() {
            $('#minhaTabela').DataTable({
                language: {
                    url: '/public/assets/localization/pt_br.json'
                },
                "lengthChange": false
            });
        });
        $('.modal').modal();
    </script>

    <main>