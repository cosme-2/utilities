<?php
include('include/header.html');
require_once('include/functions.php');
?>

<!-- BEGIN: Check if there are some file in  "json/originals" folder -->

<!-- if there are some files in "json/originals" folder ask for decoding -->
<?php if(find_json_file_names()): ?>
  
   <!-- Show list of all json file put in "json/originals" folder -->
   <div class="heading-1">Les fichiers suivants ont été trouvés dans le dossier "json/originals":</div>
   <div class="list-files"><?php echo find_json_file_names() ?></div>

   <!-- Ask to decode json files from "json/originals" folder -->
   <form action="result.php" method="POST">

         <!-- Submit button -->
         <div class="decode-submit-button">
            Souhaitez-vous décoder toutes les entités HTML dans ces fichiers à leurs caractères correspondants?
            <br/><input class="decode-submit-button" type="submit"  value="Décoder">
         </div>
   </form>

<!-- if there are no any file in "json/originals" folder remind to add file there -->
<?php else: ?>
  <div class="list-files">aucun fichier trouvé</div>
  
  <!-- Little reminder where put files to decode -->
  <div class="main-reminder">Déposez les fichiers que vous souhaitez à décoder dans le dossier "json/originals".</div>

<?php endif; ?>
<!-- END: Check if there are some file in  "json/originals" folder -->

<?php
include('include/footer.html');
?>