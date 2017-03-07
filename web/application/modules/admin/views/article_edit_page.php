<div class="container">
<br>
<?php
$search = $this->session->search;
?>
<p><a href="<?= base_url() . 'admin/search_article?title=' . $search['title'] . '&authors=' . $search['authors'] . '&publication_year=' . $search['publication_year'] . '&doi=' . $search['doi']?>"> <span class="glyphicon glyphicon-arrow-left"></span></a></p> 
<br>
<?php 

echo $msg;
$form_att  = array('class' => "form", 'method' => "post", 'role' => "form" );
$input_att = array('class' => "form-control", 'style' => "text-align:center");

echo form_open(base_url('index.php/admin/article_set_edit'), $form_att);
?>
	<table class="table table-condensed table-bordered" style="text-align:center">
		<tr>
			<td><?php echo form_label('Título', 'title'); ?> 				</td>
			<td><?php echo form_label('Autoria', 'authors'); ?> 			</td>
			<td><?php echo form_label('Ano', 'publication_year'); ?>		</td>
			<td><?php echo form_label('DOI', 'doi'); ?>						</td>
		</th>
		<tr>
				<?php echo form_hidden('article_id', $data->article_id, 'class="form-control", style="text-align:center"'); ?>
			<td><?php echo form_input('title', $data->title, $input_att) . form_error('title'); ?>									</td>
			<td><?php echo form_input('authors', $data->authors, $input_att) . form_error('authors'); ?>							</td>
			<td><?php echo form_input('publication_year', $data->publication_year, $input_att) . form_error('publication_year'); ?> </td>
			<td><?php echo form_input('doi', $data->doi, $input_att) . form_error('doi'); ?>										</td>	
		</tr>
</table>

<?php
echo form_submit('Buscar', 'submit', 'class="btn btn-default"');	
?> 
<br><br>
</div>