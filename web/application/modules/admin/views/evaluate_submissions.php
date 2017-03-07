<div class="container">
<br><p><a href="<?= base_url('index.php/admin/home')?>"> <span class="glyphicon glyphicon-arrow-left"></span> Painel Administrativo </a></p><br>
<br>
<?php

$options = array('waiting'	 	=> 'Aguardando avaliação',
				'already_on_bd' => 'Artigo já consta no ImunoDB',
				'accepted'		=> 'Colaboração aceita',
				'refused_x' 	=> 'Colaboração recusada por motivo X',
				'refused_y' 	=> 'Colaboração recusada por motivo Y');

echo $msg; 
?>
<table class="table table-responsive table-hover table-bordered">
	<tr>
		<th>Título		</th>
		<th>Ano 	 	</th>
		<th>DOI 		</th>
		<th>Contribuidor</th>
		<th>Data e hora	</th>
		<th>Comentário	</th>
		<th>Status 		</th>
		<th>			</th>
	</tr>
<?php
$i = 1;

	if (!$list->result()){
		?>
		</table>
		<br><p class="alert alert-info" style="text-align:center">Não há submissões a serem avaliadas</p><br><br><br><br>
		<?
	}

	foreach ($list->result() as $row) { ?>
	<tr style="text-align:justify">
		<td><?php echo $row->title; 					?></td>
		<td><?php echo $row->publication_year; 			?></td>
		<td><?php echo $row->doi; 						?></td>
		<td><?php echo $contrib_name[$row->contrib_id]; ?></td>
		<td><?php echo $row->time; 						?></td>
		<td><?php echo $row->comment; 					?></td>

		<td><?php echo form_open(base_url('index.php/admin/evaluate').'/'.$row->submission_id, 'method="get" id="'. $i.'"' );
			 	  echo form_dropdown('status', $options, '', 'form="'.$i++.'"' ) ;?></td>

		<td><button type="submit"><a><span class="glyphicon glyphicon-ok"></span></a></button>
			<?php echo form_close(); ?></td>
	
			
	</tr>
	<?php } ?>

</table>
</div>

