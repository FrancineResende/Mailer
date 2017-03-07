<div class="container starter-template">

	<p><a class="pull-left" href="<?= base_url('index.php/admin/home')?>"> <span class="glyphicon glyphicon-arrow-left"></span> Painel Administrativo</a>
	<a class="pull-right" href="<?= base_url('index.php/admin/edit_synon')?>">Editar sinônimos <span class="glyphicon glyphicon-arrow-right"></span></a></p>
	<br><br>
	<h4>Selecione um gene para registrar seu sinônimo</h4><br>

	<?php
	echo form_open(base_url('index.php/admin/save_synonymous'));
	echo form_dropdown('gene_id', $data, set_value('gene_id')); //value=gene_id content=gene_name
	?>
	<br><br>
	<div class="col-sm-4 col-sm-offset-4">
	<?
	echo form_label('Insira o sinônimo', 'synonymous');
	echo form_input('synonymous', set_value('synonymous'), 'class="form-control" style="text-align:center"');
	echo form_error('synonymous');
	echo form_close();
	?>
<br> 
<? echo $msg; ?> 
</br>	
</div>
</div>