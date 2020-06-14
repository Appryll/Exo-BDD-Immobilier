<?php
    require_once("inc/init.php");


    require_once("inc/header.php");
?>


<div class="table-responsive">

<table class="table col-md-12 mt-5 table-bordered">
    <thead class="thead-light shadow-sm p-3 mb-5 bg-white rounded  " >
        <tr>

            <?php 

            //////////// RÉCUPÉRER EN BDD LES INFOS DU PROPIETE ////////////////
            $r = $pdo->query("SELECT * FROM logement");
            
            for($i=0; $i< $r->columnCount(); $i++ ) { ?>
                <th scope="col"> <?php echo $r->getColumnMeta($i)["name"]; ?> </th>
            <?php } ?>

            <th scope="col">+</th>
        
        </tr>
    </thead>

    <tbody>

        <?php while($propietes= $r->fetch(PDO::FETCH_ASSOC)) { ?>
        
        <tr>
            <td><?php echo $propietes['id_logement']; ?></td>            
            <td><?php echo $propietes['titre']; ?></td>            
            <td><?php echo $propietes['adresse']; ?></td>            
            <td><?php echo $propietes['ville']; ?></td>            
            <td><?php echo $propietes['cp']; ?></td>            
            <td><?php echo $propietes['surface']; ?></td>            
            <td><?php echo $propietes['prix']; ?></td> 
            <td> <img class="img-fluid" style="width:40px" src="<?php echo $propietes['photo']; ?>"></td>           
            <td><?php echo $propietes['type']; ?></td> 
            <td><?php echo substr($propietes['description'], 0, 10) . "..."; ?></td>            
            <td>
                <a href="fiche-propiete.php?id_logement=<?php echo $propietes['id_logement'];?>" class="badge badge-info">Plus d'info </a>
            </td>
        </tr>
            
        <?php } ?>

    </tbody>
</table>

</div>

<?php
    require_once("inc/footer.php");
?>