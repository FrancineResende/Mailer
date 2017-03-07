<div class="container starter-template">

	<p class="pull-left"><a href="<?= base_url('index.php/admin/home')?>"> <span class="glyphicon glyphicon-arrow-left"></span> 
	Painel Administrativo</a>/<a href="<?= base_url('index.php/admin/synon_registration')?>">Inserir sinônimos</a></p>
	<br><br>
	<h4>Selecione um gene para visualizar seus sinônimos</h4><br>

	<?php
	

	echo form_open(base_url('index.php/admin/edit_synon'), 'id="form1"');
	echo form_dropdown('gene_id', $genes, set_value('gene_id')); //value=gene_id content=gene_name
	echo form_submit('submit', 'Mostrar sinônimos', 'form-id="#form1"');
	echo form_close();
	echo $alert;
	?>

	<br>
	<div class="col-sm-8 col-sm-offset-2">
		<? 
		if(isset($synon)){
			if (isset($gene_id))
				echo '<br><p>Sinônimos para o gene '.$genes[$gene_id].'</p>';
			else
				echo '<br><p>Sinônimos para o gene '.$genes[set_value('gene_id')].'</p>';
			$form_id=1;
			foreach ($synon as $i => $syn) {
				if (!isset($gene_id)){
					echo form_open(base_url('index.php/admin/set_edit_synon').'/'.$syn->synon_id.'/'.set_value('gene_id'), 'id="'.$form_id.'"'); ?> 
					<div class="input-group">
					<span class="input-group-addon"><a href="<?= base_url().'admin/delete_synon/'.$syn->synon_id.'/'.set_value('gene_id'); ?>" onClick="javascript: return confirm('Please confirm deletion');" ><span class="glyphicon glyphicon-remove pull-left"></span></a></span>
					<input type="text" class="form-control" name="synonymous" style="text-align:center" value="<? echo $syn->synonymous; ?>"/>
					<span class="input-group-addon"><button type="submit" form-id="#<?= $form_id++ ?>">Edit <span class="glyphicon glyphicon-ok"></span></button></span>
					</div>
					<? 
					}
					else { 
					echo form_open(base_url('index.php/admin/set_edit_synon/').'/'.$syn->synon_id.'/'.$gene_id, 'id="'.$form_id.'"'); ?>
					<div class="input-group">
					<span class="input-group-addon"><a href="<?= base_url().'admin/delete_synon/'.$syn->synon_id.'/'.$gene_id; ?>" onClick="javascript: return confirm('Please confirm deletion');" ><span class="glyphicon glyphicon-remove pull-left"></span></a></span>
					<input type="text" class="form-control" name="synonymous" style="text-align:center" value="<? echo $syn->synonymous; ?>"/>		
					<span class="input-group-addon"><button type="submit" form-id="#<?= $form_id++ ?>">Edit <span class="glyphicon glyphicon-ok"></span></button></span>
					</div><?	
					}

				echo form_close();
			}
		}
		?> 

</div>
</div>