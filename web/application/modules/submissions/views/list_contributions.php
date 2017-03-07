<div class="container starter-template">
<?php 
    echo '<h4>Minhas contribuições</h4><br>';
	if ($list->num_rows() == 0)
		echo '<br><br><div class="cointainer"><p class="alert alert-info">Você não realizou contribuições até o momento</p></div></div><br><br><br>';
	else {
        // echo '<br><div class="container"><h5 style="text-align:center"> Submissões realizadas até o momento: '. $list->num_rows() . '</h5><br><br>';
	?>
</div>
		<div class="container table-responsive">
        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                	<th >#</th>
                    <th >Título do artigo</th>
                    <th >Ano</th>
                    <th >DOI</th>
                    <th >Seu comentário</th>
                    <th >Data e hora de envio</th>
                    <th >Status</th>
                </tr>
            </thead>

            <?php
            $i=1;
            
            foreach ($list->result() as $row) {
            ?>
                <tr >
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row->title; ?></td>
                    <td><?php echo $row->publication_year; ?></td>
                    <td><?php echo $row->doi; ?></td>
                    <td><?php echo $row->comment; ?></td>
                    <td><?php echo $row->time; ?></td> 
                    <td><?php echo $row->status; ?></td>
                </tr>
            <?php } ?>

        </table>
        <hr>
    	</div>
    <?php }  echo '<br><br><br><br>'; ?>
