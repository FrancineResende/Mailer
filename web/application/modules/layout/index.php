<!DOCTYPE html>
<html class="no-js">
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title> <?php echo $title; ?> </title>
    <link href="<?= base_url('assets/bootstrap-3.3.5/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/custom.css') ?>" rel="stylesheet">
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo-022.jpg'); ?>">
    <link rel="stylesheet" type="text/css" media="all" href="<?= base_url('assets/css/barra.css') ?>" title="estilo" />
    <link rel="stylesheet" type="text/css" media="all" href="<?= base_url('assets/css/reset.css') ?>" title="estilo" />
    <link rel="stylesheet" type="text/css" media="all" href="<?= base_url('assets/css/footer.css') ?>" title="estilo" />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
     <script src="<?= base_url('assetsbootstrap-3.3.5/docs/assets/js/ie-emulation-modes-warning.js'); ?>"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?= base_url('assets/bootstrap-3.3.5/dist/js/bootstrap.min.js') ?>"></script>
  <!--   [if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif] -->
</head>
<body>
<?php if($header) echo $header ;?>
<?php if($middle) echo $middle ;?>
<?php if($footer) echo $footer ;?>
</body>
</html>
