<?php
   require_once("inc/init.php");
   
   if(isset($_GET["id_logement"])){
       $r = $pdo->query("SELECT * FROM logement WHERE id_logement = '$_GET[id_logement]' ");
       $propiete = $r->fetch(PDO::FETCH_ASSOC); 
   }
   
   require_once("inc/header.php");
   ?>
<div class="row col-md-10 mx-auto justify-content-center mt-4">
   <div class="card col-md-4">
      <img class="card-img-top" src="<?php echo $propiete["photo"]; ?>" alt="Card image cap">
      <div class="card-body">
         <p class="card-text text-center font-weight-bold"> <?php echo $propiete["titre"]; ?> </p>
         <p class="card-text text-center"> <?php echo $propiete["ville"]; ?> </p>
         <p class="card-text text-center"> <?php echo $propiete["cp"]; ?> </p>
      </div>
   </div>
   <div class="col-md-6">
      <ul class="list-group">
         <li class="list-group-item"><span class="title"> Adresse : </span> <?php echo $propiete["adresse"]; ?> </li>
         <li class="list-group-item"><span class="title"> Surface : </span> <?php echo $propiete["surface"]; ?>m2 </li>
         <li class="list-group-item"><span class="title"> Type : </span> <?php echo $propiete["type"]; ?> </li>
         <li class="list-group-item"><span class="title"> Prix: </span> <?php echo $propiete["prix"]; ?> € </li>
         <li class="list-group-item">
            <p><span class="title">Description: </span>
               <textarea name="" id="description"class="form-control" id="exampleFormControlTextarea1" cols="50" rows="7"><?php echo $propiete["description"]; ?></textarea>
      </ul>
   </div>
</div>
<?php
   require_once("inc/footer.php");
   ?>