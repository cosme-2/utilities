<?php
include('include/header.html');
require_once('include/functions.php');
?>

<!-- Decode function -->
<?php
  json_file_decode();
?>

<!-- Main page return button -->
<div class="return-home-button">
    <a href="index.php">Retourner à la page d'accueil</a>
</div>

<?php
include('include/footer.html');
?>