<?php
    $title = 'Fav Places - ERROR';
    ob_start();
?>

<div class="container">
    <h2>ERROR</h2>
    <hr>
    <p><?= $errorMessage ?></p>
    <p>Please <a href="index.php">GO BACK TO MAIN ></a></p>
</div>

<?php
    $html = ob_get_clean(); // give the code into a variable
    include '_template.php'; // and call the variable from the template
?>