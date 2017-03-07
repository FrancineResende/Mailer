<br><br>
<div class="container">
<p><a href="<?= base_url('index.php/admin/home')?>"> <span class="glyphicon glyphicon-arrow-left"></span> Painel Administrativo </a></p><br>
<h4>Procure o artigo que deseja editar <small>(submeta em branco para visualizar todos os artigos)</small> </h4>

<?php

$form_att  = array('class' => "form", 'method' => "get", 'role' => "form" );
$input_att = array('class' => "form-control");

echo form_open(base_url('index.php/admin/search_article'), $form_att);
?>
	<table class="table table-condensed table-bordered table-responsive" style="text-align:center">
		<tr>
			<td class="table-bordered"><?php echo form_label('Título (completo ou parte)', 'title'); ?> </td>
			<td class="table-bordered"><?php echo form_label('Autores', 'authors'); ?> 					</td>
			<td class="table-bordered"><?php echo form_label('Ano', 'publication_year'); ?>				</td>
			<td class="table-bordered"><?php echo form_label('DOI', 'doi'); ?>							</td>
		</th>
		<tr>
			<td><?php echo form_input('title', set_value('title'), $input_att); ?>														  </td>
			<td><?php echo form_input('authors', set_value('authors'), $input_att); ?>													  </td>
			<td><?php echo form_input('publication_year', set_value('publication_year'), $input_att) . form_error('publication_year'); ?> </td>
			<td><?php echo form_input('doi', set_value('doi'), $input_att) . form_error('doi'); ?>										  </td>	
		</tr>
</table>
<?php
echo form_submit('Buscar', 'submit', 'class="btn btn-primary pull-right"');	
?> 
<br><br><br>
<table class="table table-bordered table-responsive table-hover">
<?
if (isset($articles))
foreach ($articles->result() as $row) { ?>
	<tr>
		<td><a href="<?= base_url() . 'admin/article_edit_page/' . $row->article_id . '/'?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
		<td><a href="<?= base_url() . 'admin/article_delete/' . $row->article_id; ?>" onClick="javascript: return confirm('Please confirm deletion');"><span class="glyphicon glyphicon-remove"></span></a></td>
		<td><?php echo $row->title; 			?></td>
		<td><?php echo $row->authors; 			?></td>
		<td><?php echo $row->publication_year; 	?></td>
		<td><?php echo $row->doi; 				?></td>
	</tr>
<?
}
echo $alert;
?>
</table>
<br></div>