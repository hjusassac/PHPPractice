<?php
    $title = 'Add Fav Places';
    ob_start();
?>

<div class="container">
    <h1><?= $title ?></h1>
    <hr>
    <form method="POST" id="favPlace">
        <div>
            <label for="placeName">Name of the Place</label><br>
            <input type="text" name="placeName" id="placeName" placeholder="Name it!" autofocus required>
            <span>: Required</span>
        </div>
        <div>
            <label for="mapLink">Link to Map</label><br>
            <select name="mapProvider" id="mapProvider">
                <option value="">--- Select ---</option>
                <option value="Google Maps">Google Maps</option>
                <option value="Naver Map">Naver Map</option>
                <option value="Kakao Map">Kakao Map</option>
            </select>
            <input type="url" name="mapLink" id="mapLink" placeholder="Paste the link here!"><br>
        </div>
        <div>
            <label for="memo">Memo</label><br>
            <textarea name="memo" id="memo" cols="30" rows="5">What's so special with this place?</textarea>
            <span>: Required</span>
        </div>
        <div>
            <label for="scoreThree">Give a score out of 5</label><br>
            <input type="radio" name="rating" id="scoreOne" value="1">1
            <input type="radio" name="rating" id="scoreTwo" value="2">2
            <input type="radio" name="rating" id="scoreThree" value="3">3
            <input type="radio" name="rating" id="scoreFour" value="4">4
            <input type="radio" name="rating" id="scoreFive" value="5">5
        </div>
        <hr>
        <button type="submit" name="add">Submit</button>
        <button type="reset">Reset</button>
    </form>
</div>


<?php
    $html = ob_get_clean(); // give the code into a variable
    include 'template.php'; // and call the variable from the template
?>