<?php
    include "_paths.php";
    include "_functions.php";
    if($places!="") appendContent($places, $file_path);
    $saved = readFileContents($file_path);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HJ's Fav Places</title>
    <style>
        body{
            display:flex;
            flex-direction: column;
            justify-content:center;
        }
        .container {
            background-color: antiquewhite;
            padding: 15px;
            width: fit-content;
            margin: 10px auto;
        }
        h1 {
            width: fit-content;
        }
        h1, h2 {
            color: darkslategrey
        }
        form {
            /* width: fit-content; */
            font-size: 18px;
        }
        input, button, select {
            font-size: 16px;
        }
        button {
            width: 49%;
            padding: 10px 0;
            background-color:transparent;
            font-weight:bold;
        }
        #submit {
            background-color: darkslategrey;
            color: white;
        }
        form div {
            margin: 15px auto;
        }
        table {
            border-spacing: 20px 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your Fav Place for Later~</h1>
        <hr>
        <!-- <form id="favPlace" action="./places.php" method="POST"> -->
        <form id="favPlace">
            <div>
                <label for="placeName">Name of the Place</label><br>
                <input type="text" name="placeName" id="placeName" placeholder="Name it!" autofocus required>
            </div>
            <div>
                <label for="mapLink">Link to Map</label><br>
                <select name="mapProvider" id="mapProvider">
                    <option value="google">Google Maps</option>
                    <option value="naver" selected>Naver Map</option>
                    <option value="kakao">Kakao Map</option>
                </select>
                <input type="url" name="mapLink" id="mapLink" placeholder="Paste the link here!"><br>
            </div>
            <div>
                <label for="memo">Memo</label><br>
                <textarea name="memo" id="memo" cols="30" rows="5">What's so special with this place?</textarea>
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
            <button type="button" id="submit">Submit</button>
            <button type="reset">Reset</button>
        </form>
    </div>
    <div id="places"></div>
    <script src="app.js"></script>
</body>
</html>