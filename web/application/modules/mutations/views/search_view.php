<div class="container">
            <br>
            <form action='<?= base_url('index.php/mutations') ?>'>
            <input type="submit" class="btn btn-default" value="Nova pesquisa">
            </form>
        </div>
        <br>

        <div class ="container table-responsive">
        <?php // echo "Sua pesquisa encontrou " . $result->num_rows(); " resultado(s). <br><br>"; ?>
        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                	<th style="text-align:center">#</th>
                    <th style="text-align:center">Gene</th>
                    <th style="text-align:center">Inheritance</th>
                    <th style="text-align:center">Type of mutation</th>
                    <th style="text-align:center">Site</th>
                    <th style="text-align:center">cDNA</th>
                    <th style="text-align:center">Disease</th>
                    <th style="text-align:center">Country</th>
                    <th style="text-align:center">Reference</th>
                </tr>
            </thead>

            <?php
            $i=1;
            // echo $result->num_rows();
            foreach ($result as $row){
            ?>
                <tr style="text-align:center">
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row->gene_name; ?></td>
                    <td><?php echo $row->inheritance; ?></td>
                    <td><?php echo $row->type; ?></td>
                    <td><?php echo $row->site . "  "; ?></td>
                    <td><?php echo $row->c_dna . " "; ?></td>
                    <td><?php echo $row->disease_name; ?></td>
                    <td><?php echo $row->country_name; ?></td>
                    <td><?php echo $row->authors . ', ' . $row->publication_year; ?> </td>
                </tr>
            <?php } ?>

        </table>
        <hr><br><br><br>
</div>