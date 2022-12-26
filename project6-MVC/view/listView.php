<?php
    $title = 'Fav Places List';
    ob_start();
?>

<div class="container" id="places" >
    <button type="button" id="edit">Edit</button>
    <button type="button" id="done">Done</button>
    <h1> <?= $title ?> </h1>
    <hr>
    <table id="List">
        <thead>
            <tr>
                <th>Name</th>
                <th>Link</th>
                <th>Memo</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody id="tableBody">
        <?php 
            foreach ($places as $place) {
        ?>
        <tr class="tableRow">
            <td class="name"><?= $place['name'] ?></td>
            <td class="link">
                <?= $place['map_link'] == null ? 'N/A':$place['map_link'] ?>
            </td>
            <td class="memo"><?= $place['memo'] ?></td>
            <td class="rating"><?= $place['rating'] == null ? 'Not Sure': Manager::giveStars($place['rating']) ?></td>
            <td class="buttons">
                <button type="button" class="editEntry">Edit</button>
                <button type="button" class="deleteEntry">Delete</button>
            </td>
        </tr>
        <?php
            }
        ?>

        </tbody>
    </table>
</div>



<?php
    $html = ob_get_clean(); // give the code into a variable
    include 'template.php'; // and call the variable from the template
?>