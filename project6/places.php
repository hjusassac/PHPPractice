<?php
    include "_paths.php";
    include "_variables.php";
    include "_functions.php";
    if($places!=[]) {
        // when there's form input, process the input and store in the file
        array_splice($places, 1, 1);
        appendContent($places, $file_path);
    }
    // and then read the file contents to display below
    $saved = readFileContents($file_path);
?>
<table>
    <thead>
        <tr>
            <th>no.</th>
            <?php foreach($saved[0] as $key => $value): ?>
            <th><?= $key ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php for($i=count($saved)-1; $i>=0; $i--): ?>
        <tr>
            <td><?= $i+1 ?></td>
            <?php foreach($saved[$i] as $value): ?>
            <td><?= $value ?></td>
            <?php endforeach; ?>
        </tr>
        <?php endfor; ?>
    </tbody>
</table>

<?php
echo "<hr>";

$anarray = [
    "placeName"=>"hehehe789",
    "mapProvider"=>"Google Maps",
    "mapLink"=>"http:\/\/456.net",
    "memo"=>"yellow",
    "rating"=>"3"
];

$array2 = [['a'=>"🍎", 'b'=>"🍑", 'c'=>"🥭", 'd'=>"🥥"], ['a'=>"🍎", 'b'=>"🥭", 'c'=>"🥥"], ['a'=>"🥪", 'b'=>"🥨", 'c'=>"🧇"]];
$index = 0;
foreach($array2 as $item) {
    if($item['a'] == "🥪") break;
    // $index5 = array_search("🍎", $item);
    // if($index5) break;
    $index ++;
}
echo $index;
echo "<hr>";
echo uniqid();
// editContent($file_path, $anarray);
