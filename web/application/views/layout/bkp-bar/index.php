<?php 
$ComplexoBarURLBase			=	"http://" . $_SERVER['HTTP_HOST'];
$ComplexoBarPastaPrincipal	=	"/complexo-bar-responsivo/";
$ComplexoBarSITEIframe		=	$_GET['site'];

switch ($ComplexoBarSITEIframe) {
	case 'cpp':
		$showSN	=	TRUE;
		$ComplexoBarSIZEWidth		=	"960";
		$activeMenu	=	TRUE;
		break;
	case 'hpp':
		$showSN	=	TRUE;
		$ComplexoBarSIZEWidth		=	"770";
		$activeMenu	=	TRUE;
		break;
	case 'fpp':
		$showSN	=	TRUE;
		$ComplexoBarSIZEWidth		=	"778";
		$activeMenu	=	TRUE;
		break;
	case 'ipp':
		$showSN	=	TRUE;
		$ComplexoBarSIZEWidth		=	"978";
		$activeMenu	=	TRUE;
		break;
	case 'gols':
		$showSN	=	TRUE;
		$ComplexoBarSIZEWidth		=	"978";
		$activeMenu	=	TRUE;
		break;
	case 'sel':
		$showSN	=	TRUE;
		$ComplexoBarSIZEWidth		=	"935";
		$activeMenu	=	TRUE;
		break;
	case 'doe':
		$showSN	=	TRUE;
		$ComplexoBarSIZEWidth		=	"960";
		$activeMenu	=	TRUE;
		break;
	default:
		$showSN	=	TRUE;
		$ComplexoBarSIZEWidth		=	"960";
		$activeMenu	=	TRUE;
		break;
}

if($showSN	==	TRUE){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Complexo Pequeno Príncipe</title>
	<link rel="stylesheet" type="text/css" media="all" href="barra.css" title="estilo" />
	<link rel="stylesheet" type="text/css" media="all" href="reset.css" title="estilo" />
	<link href="./bootstrap-3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<style type="text/css">
	.all-bicpp{width: <?php echo $ComplexoBarSIZEWidth;?>px;}
	</style>
</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="topnavbar" style="background-color: #004B84; margin-bottom: 0;">
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
				<div> <!-- nav -->
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
				        <li><a class="nav-texto" href="#"> Mutações </a></li>
				        <li class="nav-texto"> | </li>
				        <li><a class="nav-texto" href="#"> Bibliografia </a></li>
				        <li class="nav-texto"> | </li>
				        <li><a class="nav-texto" href="#"> Links </a></li>
				        <li class="nav-texto"> | </li>
				        <li><a class="nav-texto" href="#"> Sobre </a></li>
				        <li class="nav-texto"> | </li>
				        <li><a class="nav-texto" href="#"> Cadastre-se </a></li>
				        <li class="nav-texto"> | </li>
				        <li><a class="nav-texto" href="#"> Contato </a></li>
				      </ul>	
				   	</div>	
			  	</div> <!-- nav -->
			</div>
		</div>
	</div>
</nav>
</body>
</html>
<?php
}
?>