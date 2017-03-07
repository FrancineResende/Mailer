<!DOCTYPE html>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Base de Dados Latino-Americana de Mutações Genéticas em Imunodeficiências Primárias">
  <meta name="keywords" content="Mutation, Mutação, Mutações, Imunologia, Imunodeficiêcia, Immunodeficience, Primary Immunodeficience, 
  Imunodeficiências Primárias, América Latina, Latino-Americano, Genética, Instituto de Pesquisa Pelé Pequeno Príncipe, IPPPP, 
  Hospital Pequeno Príncipe, HPP, LASID">
  <meta name="author" content="Francine Resende">
  <!--Adicionar keywords e ver oq mais é importante-->
  
  <title> <?php echo $title; ?> </title>
  <link href="<?= base_url('assets/bootstrap-3.3.7/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link rel="shortcut icon" href="<?= base_url('assets/img/logo-022.jpg'); ?>">
  <link rel="stylesheet" type="text/css" media="all" href="<?= base_url('assets/css/barra.css') ?>" title="estilo" />
  <!-- <link rel="stylesheet" type="text/css" media="all" href="//= base_url(//'assets/css/reset.css') //>" title="estilo" /> -->
  <link rel="stylesheet" type="text/css" media="all" href="<?= base_url('assets/css/footer.css') ?>" title="estilo" />

  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">

  <link href="<?= base_url('assets/css/custom.css') ?>" rel="stylesheet">

	<script src="<?= base_url('assets/bootstrap-3.3.7/docs/assets/js/ie-emulation-modes-warning.js'); ?>"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="<?= base_url('assets/bootstrap-3.3.7/dist/js/bootstrap.min.js') ?>"></script>
  <!--   [if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif] -->
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-70850718-1', 'auto');
    ga('send', 'pageview');

  </script>
</head>
<body>
<?php if($header) echo $header ;?>
<?php if($middle) echo $middle ;?>
<?php if($footer) echo $footer ;?>
</body>
</html>
