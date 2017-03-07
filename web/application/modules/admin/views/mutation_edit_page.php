<div class="container">
<br>
<?php
$searchMut = $this->session->searchMut;
?>
<p><a href="<?= base_url() . 'admin/search_mutation?gene_name=' . $searchMut['gene_name'] . '&type=' . $searchMut['type'] . '&inheritance=' . $searchMut['inheritance'] . 
'&site=' . $searchMut['site'] . '&c_dna=' . $searchMut['c_dna'] . '&protein=' . $searchMut['protein'] . '&disease_name=' . $searchMut['disease_name'] . '&country_name=' . 
$searchMut['country_name'] . '&omim_phenotype=' . $searchMut['omim_phenotype'] . '&reference=' . $searchMut['reference']?>"> 
<span class="glyphicon glyphicon-arrow-left"></span></a></p> 
<br>
<?php 

echo $msg;
$form_att  = array('class' => "form", 'method' => "post", 'role' => "form" );
$input_att = array('class' => "form-control", 'style' => "text-align:center");

echo form_open(base_url() . 'index.php/admin/mutation_set_edit/' . $data->mutation_id, $form_att);
?>

<p>Paciente <?php echo $data->pacient_id?></p>
<table class="table table-condensed table-bordered" style="text-align:center">
		<tr>
			<td><b>Gene Symbol</b></td>
			<td><b>Type</b></td>
			<td><b>Inheritance</b></td>
			<td><b>Site</b></td>
			<td><b>c_DNA</b></td>
		</tr>
		<tr>
				<?php echo form_hidden('pacient_id', $data->pacient_id, 'class="form-control", style="text-align:center"'); 	?>
				<?php echo form_hidden('mutation_id', $data->mutation_id, 'class="form-control", style="text-align:center"'); 	?>
				<?php echo form_hidden('country_id', $data->country_id, 'class="form-control", style="text-align:center"'); 	?>
				<?php echo form_hidden('disease_id', $data->disease_id, 'class="form-control", style="text-align:center"'); 	?>
				<?php echo form_hidden('gene_id', $data->gene_id, 'class="form-control", style="text-align:center"'); 			?>
				<?php echo form_hidden('article_id', $data->article_id, 'class="form-control", style="text-align:center"'); 	?>
			
			<td><?php echo form_input('gene_name', $data->gene_name, $input_att) . form_error('gene_name'); ?>	</td>
			<td><?php echo form_input('type', $data->type, $input_att) . form_error('type'); ?> 								</td>
			<td><?php echo form_input('inheritance', $data->inheritance, $input_att) . form_error('inheritance'); ?>			</td>
			<td><?php echo form_input('site', $data->site, $input_att) . form_error('site'); ?>									</td>
			<td><?php echo form_input('c_dna', $data->c_dna, $input_att) . form_error('c_dna'); ?>								</td>
		</tr>
</table>

<table class="table table-condensed table-bordered" style="text-align:center">

		<tr>
			<td><b>Protein</b></td>
			<td><b>Disease</b></td>
			<td><b>Country</b></td>
			<td><b>OMIM</b></td>
			<td><b>Reference</b></td>
		</tr>
		<tr>
			<td><?php echo form_input('protein', $data->protein, $input_att) . form_error('protein'); ?> 						</td>
			<td><?php echo form_input('disease_name', $data->disease_name, $input_att) . form_error('disease_name'); ?>			</td>
			<td><?php echo form_input('country_name', $data->country_name, $input_att) . form_error('country_name'); ?>			</td>
			<td><?php echo form_input('omim_phenotype', $data->omim_phenotype, $input_att) . form_error('omim_phenotype'); ?>	</td>
			<td><?php echo form_input('reference', $data->doi, $input_att) . form_error('reference'); ?>						</td>
		</tr>
</table>

<?php
echo form_submit('submit', 'Alterar', 'class="btn btn-primary"');
echo form_close();	
?> 
<br><br>
</div>