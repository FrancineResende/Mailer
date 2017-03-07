<div class="container">
	<br><br>
	<ul class="nav nav-tabs tab">
	  <li><a href="<?= base_url('index.php/submissions/submit') ?>">Formulário de submissão</a></li>
	  <li><a href="<?= base_url('index.php/submissions/view_submissions') ?>">Submissões realizadas</a></li>
	  <li><a href="<?= base_url('index.php/submissions/view_data') ?>">Meus dados</a></li>
	  <li><a href="<?= base_url('index.php/submissions/change_password') ?>">Alterar senha</a></li>  
	  <li><a href="<?= base_url('index.php/users/logoff') ?>">Sair</a></li> 
	  <li class="pull-right"><a><?php echo'Login como: ' . $this->session->first_name . ' ' .  $this->session->last_name?></a></li> 
	</ul>
</div>
<br>
