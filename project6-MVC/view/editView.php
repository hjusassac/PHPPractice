<?php
    $title = 'Edit Fav Places';
    include '_viewHelper.php';
    $selected = giveSelected($place['map_provider']);
    $checked = giveChecked($place['rating']);
    ob_start();
?>

<div class="container">
    <h1><?= $title ?></h1>
    <hr>
    <form method="POST" id="favPlace">
        <div>
            <label for="placeName">Name of the Place</label><br>
            <input type="text" name="placeName" id="placeName" value="<?= $place['name'] ?>" autofocus required>
            <span>: Required</span>
        </div>
        <div>
            <label for="mapLink">Link to Map</label><br>
            <select name="mapProvider" id="mapProvider">
                <option value="" <?= $selected['none'] ? 'selected':'' ?>>--- Select ---</option>
                <option value="Google Maps" <?= $selected['google'] ? 'selected':'' ?>>Google Maps</option>
                <option value="Naver Map" <?= $selected['naver'] ? 'selected':'' ?>>Naver Map</option>
                <option value="Kakao Map" <?= $selected['kakao'] ? 'selected':'' ?>>Kakao Map</option>
            </select>
            <input type="url" name="mapLink" id="mapLink" value="<?= $place['map_link'] != null ? $place['map_link']:'' ?>" placeholder="Paste the link here!">
            <br>
        </div>
        <div>
            <label for="memo">Memo</label><br>
            <textarea name="memo" id="memo" cols="30" rows="5"><?= $place['memo'] ?></textarea>
            <span>: Required</span>
        </div>
        <div>
            <label for="scoreThree">Give a score out of 5</label><br>
            <input type="radio" name="rating" id="scoreOne" value="1" <?= $checked['1'] ? 'checked':'' ?>>1
            <input type="radio" name="rating" id="scoreTwo" value="2" <?= $checked['2'] ? 'checked':'' ?>>2
            <input type="radio" name="rating" id="scoreThree" value="3" <?= $checked['3'] ? 'checked':'' ?>>3
            <input type="radio" name="rating" id="scoreFour" value="4" <?= $checked['4'] ? 'checked':'' ?>>4
            <input type="radio" name="rating" id="scoreFive" value="5" <?= $checked['5'] ? 'checked':'' ?>>5
        </div>
        <hr>
        <button type="submit" id="submit" name="edit" value="<?= $place['id'] ?>">Submit</button>
        <button type="button" onclick="
            window.location.href='<?= $indexPath ?>'
        ">Go Back</button>
    </form>
</div>


<?php
    $html = ob_get_clean(); // give the code into a variable
    include '_template.php'; // and call the variable from the template
?>