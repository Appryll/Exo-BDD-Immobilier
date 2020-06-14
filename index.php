<?php
   require_once("inc/init.php");
   
   if($_POST){
   $erreur = '';
   
   foreach($_POST as $indice=>$valeur){
       $_POST[$indice] = addslashes($valeur);
       }
   
   if (!preg_match('/^\d{5}$/', $_POST["cp"])) {
       $erreur .= "<div class=\"alert alert-danger\" role=\"alert\">
       Le CP adjouté n'est pas un format valide. Ne doit contenir que des chiffres et jusqu'à 5 chiffres  !
     </div>";
       }
   
   if(!is_numeric($_POST["surface"])) {
       $erreur .= "<div class=\"alert alert-danger\" role=\"alert\">
       Le champ \"Surface\" ne doit contenir que des valeurs numériques !
     </div>";
       }
   if(!is_numeric($_POST["prix"])) {
       $erreur .= "<div class=\"alert alert-danger\" role=\"alert\">
       Le champ \"Prix\" ne doit contenir que des valeurs numériques !
     </div>";
       }
   
   if(!empty($_FILES)){
   
       ///nom de photo et extention ///
           $fecha = new DateTime();
           $extention= $fecha->getTimestamp();
           $nomoriginaldephoto= $_FILES["photo"]["name"];
           $aprespoint= pathinfo($nomoriginaldephoto, PATHINFO_EXTENSION);
   
       //// ajouter une photo////
       if($_FILES["photo"]["error"]>0){
           $content .= "<div class=\"alert alert-danger\" role=\"alert\"> Attention! Aucune photo n'a été ajoutée </div>"; 
               }
           else{
   
           $permitidos= array("image/jpg","image/jpeg", "image/png", "image/bmp");
           $limite_kb= 200;
           $nomPhoto = "logement_" . $extention . "." . $aprespoint;
   
           if(in_array($_FILES["photo"]["type"], $permitidos) && ($_FILES["photo"]["size"] <= $limite_kb * 1024)){
   
               $ruta= 'photo/'.$extention.'/';
               $archivo= $ruta.$nomPhoto;
   
               if(!file_exists($ruta)){
                   mkdir($ruta);
               }
   
               if(!file_exists($archivo)){
                   $resultado= copy($_FILES["photo"]["tmp_name"], $archivo);
                   }
           }else{
               $erreur .= "<div class=\"alert alert-danger\" role=\"alert\">
               Le fichier n'est pas autorisé ou dépasse la taille autorisée. Les extensions jpg, jpeg ou png sont autorisées.
               </div>"; 
           }
       }
   
   } 
   
   if(empty($erreur)) {
   $count = $pdo->exec(" INSERT INTO logement (titre, adresse, ville, cp, surface, 
   prix, photo, type, description)  VALUES( '$_POST[titre]', '$_POST[adresse]', '$_POST[ville]', '$_POST[cp]', '$_POST[surface]', 
   '$_POST[prix]', '$archivo' , '$_POST[type]', '$_POST[description]') ");
   
   if($count >0){
       $content .= "<div class=\"alert alert-success\" role=\"alert\">
       Votre propiété " . $_POST["titre"] . " a bien été ajouté en base. </div>";
       }
   }
   
   $content .= $erreur;
   }
   
   require_once("inc/header.php");
   ?>
<?php echo $content;?>
<form action="" method="POST" enctype="multipart/form-data" class="shadow-lg p-3 mb-5 bg-white rounded mt-2">
   <div class="form-row">
   <div class="form-group col-md-3">
      <label for="reference">Titre<i class="champs">*</i></label>
      <input type="text" class="form-control" id="reference" name="titre" value="" required>
   </div>
   <div class="form-group col-md-3">
      <label for="categorie">Adresse<i class="champs">*</i></label>
      <input type="text" class="form-control" id="categorie" name="adresse" value=""required>
   </div>
   <div class="form-group col-md-3">
      <label for="titre">Ville</label>
      <input type="text" class="form-control" id="titre" name="ville" value="" >
   </div>
   <div class="form-group col-md-3">
      <label for="couleur">CP<i class="champs">*</i></label>
      <input type="text" class="form-control" id="couleur" name="cp" value="" required>
   </div>
   <div class="form-group col-md-3 ">
      <label for="taille">Surface<i class="champs">*</i></label> 
      <input type="text" class="form-control" id="taille" name="surface"placeholder="M2" value="" required> 
   </div>
   <div class="form-group col-md-3">
      <label for="prix">Prix<i class="champs">*</i></label>
      <input type="text" class="form-control" id="prix" name="prix" placeholder="Euro" value="" required>
   </div>
   <div class="w-100"></div>
   <div class="form-group col-md-3">
      <label for="type">Type</label>
      <div class="custom-control custom-radio">
         <input type="radio" id="type_l" name="type" class="custom-control-input" value="Location" checked>  
         <label class="custom-control-label" for="type_l">Location</label>
      </div>
   </div>
   <div class="form-group col-md-3">
      <label for="type_v" style="color:transparent">Type</label>
      <div class="custom-control custom-radio">
         <input type="radio" id="type_v" name="type" class="custom-control-input" value="Vente">
         <label class="custom-control-label" for="type_v">Vente</label>
      </div>
   </div>
   <div class="custom-file mb-3">
      <input type="file" class="custom-file-input" id="photo" name="photo">
      <label class="custom-file-label" for="photo">Choisir une photo</label>
   </div>
   <div class="form-group col-md-12">
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Description de la propiété" name="description"></textarea>
   </div>
   <p class="champs">* Champs obligatoires</p>
   <div class="w-100"></div>
   <button type="submit" class="btn btn-primary" name="ajouterPropiete">Ajouter une propriété</button> 
</form>
<?php
   require_once("inc/footer.php");
   ?>