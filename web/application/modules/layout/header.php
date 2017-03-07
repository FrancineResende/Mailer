<?php
$ComplexoBarURLBase         =   "http://" . $_SERVER['HTTP_HOST'];
$ComplexoBarPastaPrincipal  =   "/complexo-bar/";
$ComplexoBarSITEIframe      =   @$_GET['site'];

switch ($ComplexoBarSITEIframe) {
    case 'cpp':
        $showSN =   TRUE;
        $ComplexoBarSIZEWidth       =   "960";
        $activeMenu =   TRUE;
        break;
    case 'hpp':
        $showSN =   TRUE;
        $ComplexoBarSIZEWidth       =   "770";
        $activeMenu =   TRUE;
        break;
    case 'fpp':
        $showSN =   TRUE;
        $ComplexoBarSIZEWidth       =   "778";
        $activeMenu =   TRUE;
        break;
    case 'ipp':
        $showSN =   TRUE;
        $ComplexoBarSIZEWidth       =   "978";
        $activeMenu =   TRUE;
        break;
    case 'gols':
        $showSN =   TRUE;
        $ComplexoBarSIZEWidth       =   "978";
        $activeMenu =   TRUE;
        break;
    case 'sel':
        $showSN =   TRUE;
        $ComplexoBarSIZEWidth       =   "935";
        $activeMenu =   TRUE;
        break;
    case 'doe':
        $showSN =   TRUE;
        $ComplexoBarSIZEWidth       =   "960";
        $activeMenu =   TRUE;
        break;
    default:
        $showSN =   TRUE;
        $ComplexoBarSIZEWidth       =   "978";
        $activeMenu =   TRUE;
        break;
}
?>
<nav class="navbar navbar-default navbar-fixed-top" style="background-color: #004B84; margin-bottom: 0; position: relative; border-bottom: none">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <ul class="nav">
                    <li class="logo">
                        <a title="Complexo Pequeno Príncipe" class="img-responsive pull-left" href="http://www.pequenoprincipe.org.br" id="logo-bicpp" >Complexo Pequeno Príncipe</a>
                    </li>
                    <li id="m-hospital-bicpp" class="border-menu first">
                        <a class="nav-texto" title="Hospital Pequeno Príncipe" href="http://www.hpp.org.br/" target="_top" <?php if( ($ComplexoBarSITEIframe == "hpp") && isset($activeMenu) && ($activeMenu == TRUE) ) : echo 'class="active"'; endif ?>>HOSPITAL</a>
                    </li>
                    <li id="m-faculdades-bicpp" class="border-menu">
                        <a class="nav-texto" title="Faculdades Pequeno Príncipe" href="http://www.fpp.edu.br/" target="_top" <?php if( ($ComplexoBarSITEIframe == "fpp") && isset($activeMenu) && ($activeMenu == TRUE) ) : echo 'class="active"'; endif ?>>FACULDADES</a>
                    </li>
                    <li id="m-instituto-bicpp" class="border-menu ultimo">
                        <a class="nav-texto" title="Instituto de Pesquisa Pelé Pequeno Príncipe" href="http://www.pelepequenoprincipe.org.br/" target="_top" <?php if( ( ($ComplexoBarSITEIframe == "ipp") || ($ComplexoBarSITEIframe == "gols") || ($ComplexoBarSITEIframe == "sel") ) && isset($activeMenu) && ($activeMenu == TRUE) ) : echo 'class="active"'; endif ?>>INSTITUTO de PESQUISA</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav nav-justified">
                        <li class="menu"><a class="nav-texto" href="<?= base_url() ?>">Inicial </a></li>
                        <li class="menu"><a class="nav-texto" href="<?= base_url('index.php/mutations') ?>"> Busca </a></li>
                        <li class="menu"><a class="nav-texto" href="<?= base_url('index.php/bibliography') ?>"> Bibliografia </a></li>
                        <li class="menu"><a class="nav-texto" href="<?= base_url('index.php/home/links') ?>"> Links úteis </a></li>
                        <!-- <li class="menu"><a class="nav-texto" href="<?= base_url('index.php/home/sobre') ?>"> Notícias </a></li> -->
                        <li class="menu"><a class="nav-texto" href="<?= base_url('index.php/home/sobre') ?>"> Sobre nós </a></li>
                        <li class="menu"><a class="nav-texto last" href="<?= base_url('index.php/home/contato') ?>"> Contato </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<div  class="container" id="banner">
    <div class="row">
        <div class="col-sm-7">
            <img class="img-responsive pull-left" src="<?= base_url('assets/img/logo-0023.png') ?>" alt="Logo base de dados latino-americana de mutações genéticas em imunodeficiências primárias">
        </div>
        <div class="col-sm-4 pull-right" style="margin-top: 5%">
            <form class="form" action="login.php" method="post">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="email" placeholder="E-mail" class="form-control">
                        <div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="password" name="senha" placeholder="Senha" class="form-control">
                        <div class="input-group-addon"><i class="fa fa-unlock"></i></div>
                    </div>
                </div>
                <button class="btn btn-primary" action="#"> Cadastrar                 </button>
                <button type="submit" class="btn btn-primary pull-right"> Entrar      </button>
                </button>
            </form>
        </div>
    </div>
</div>

