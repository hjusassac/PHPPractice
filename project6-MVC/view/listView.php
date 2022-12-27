<?php
    $title = 'Fav Places List';
    include '_viewHelper.php';
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
            <form  method="post">
                <?php 
                    foreach ($places as $place) {
                ?>
                <tr class="tableRow">
                    <td class="name"><?= $place['name'] ?></td>
                    <td class="link">
                        <?= $place['map_link'] == null ? 'N/A': giveLink($place['map_provider'], $place['map_link']) ?>
                    </td>
                    <td class="memo"><?= $place['memo'] ?></td>
                    <td class="rating"><?= $place['rating'] == null ? 'Not Sure': giveStars($place['rating']) ?></td>
                    <td class="buttons">
                        <button type="button" class="editEntry" onclick="
                            window.location.href='<?= $editPath ?>&id=<?= $place['id'] ?>';
                        ">Edit</button>
                        <button type="submit" class="deleteEntry" name="delete" value="<?= $place['id'] ?>">Delete</button>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </form>    
        </tbody>
    </table>
</div>



<?php
    $html = ob_get_clean(); // give the code into a variable
    include '_template.php'; // and call the variable from the template
?>