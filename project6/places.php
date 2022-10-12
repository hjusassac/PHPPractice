<?php
    include "_paths.php";
    include "_variables.php";
    include "_functions.php";
    if($places!=[]) {
        array_splice($places, 1, 1);
        appendContent($places, $file_path);
    }
    $saved = readFileContents($file_path);
?>

<?php if($places!=[]): ?>
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
<?php endif; ?>