<br><br>
<div class="container">
<p><a href="<?= base_url('index.php/admin/home')?>"> <span class="glyphicon glyphicon-arrow-left"></span> Painel Administrativo </a></p><br>
<h4>Procure a mutação que deseja editar <small>(submeta em branco para visualizar todas as mutações)</small> </h4>

<?php

$form_att  = array('class' => "form", 'method' => "get", 'role' => "form" );
$input_att = array('class' => "form-control");

echo form_open(base_url('index.php/admin/search_mutation'), $form_att);
?>
	<table class="table table-condensed table-bordered table-responsive" style="text-align:center">
		<tr>
			<td><?php echo form_label('Gene symbol', 'gene_name'); ?> 	</td>
			<td class="table-bordered"><?php echo form_label('Type', 'type'); ?>				</td>
			<td class="table-bordered"><?php echo form_label('Inheritance', 'inheritance'); ?>	</td>
			<td class="table-bordered"><?php echo form_label('Site', 'site'); ?> 				</td>
			<td class="table-bordered"><?php echo form_label('c_DNA', 'c_dna'); ?> 				</td>
			<td class="table-bordered"><?php echo form_label('Protein', 'protein'); ?>			</td>
			<td class="table-bordered"><?php echo form_label('Disease', 'disease_name'); ?>		</td>
			<td class="table-bordered"><?php echo form_label('Country', 'country_name'); ?> 	</td>
			<td class="table-bordered"><?php echo form_label('OMIM', 'omim_phenotype'); ?> 		</td>
			<td class="table-bordered"><?php echo form_label('Reference\'s DOI', 'reference'); ?> </td>
		</th>
		<tr>
			<td><?php echo form_input('gene_name', set_value('gene_name'), $input_att); ?>				</td>
			<td><?php echo form_input('type', set_value('type'), $input_att); ?> 						</td>
			<td><?php echo form_input('inheritance', set_value('inheritance'), $input_att); ?>			</td>
			<td><?php echo form_input('site', set_value('site'), $input_att); ?>						</td>
			<td><?php echo form_input('c_dna', set_value('c_dna'), $input_att); ?>						</td>
			<td><?php echo form_input('protein', set_value('protein'), $input_att); ?> 					</td>
			<td><?php echo form_input('disease_name', set_value('disease_name'), $input_att); ?>	 	</td>
			<td><?php echo form_input('country_name', set_value('country_name'), $input_att); ?>	 	</td>
			<td><?php echo form_input('omim_phenotype', set_value('omim_phenotype'), $input_att); ?> 	</td>
			<td><?php echo form_input('reference', set_value('reference'), $input_att); ?> 				</td>
		</tr>
</table>

<?php
echo form_submit('Buscar', 'submit', 'class="btn btn-primary pull-right"');	
?> 


<?php
if (isset($mutations)){
	?>
	<br><br><table class="table table-bordered table-responsive table-hover table-condensed"><br>
	<?
	foreach ($mutations->result() as $row) { ?>
	<tr>
		<td><a href="<?= base_url() . 'admin/mutation_edit_page/' . $row->mutation_id . '/'?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
		<td><a href="<?= base_url() . 'admin/mutation_delete/' . $row->pacient_id; ?>" onClick="javascript: return confirm('Please confirm deletion');"><span class="glyphicon glyphicon-remove"></span></a></td>
		<td><?php echo $row->gene_name; 		?></td>
		<td><?php echo $row->type; 				?></td>
		<td><?php echo $row->inheritance; 		?></td>
		<td><?php echo $row->site; 				?></td>
		<td><?php echo $row->c_dna; 			?></td>
		<td><?php echo $row->protein; 			?></td>
		<td><?php echo $row->disease_name; 		?></td>
		<td><?php echo $row->country_name; 		?></td>
		<td><?php echo $row->omim_phenotype; 	?></td>
		<td><?php echo $row->doi; 				?></td>
	</tr>
<?php  }
}
echo $alert;
?>
</table>

<br><br><br></div>