<?php
    $highlight = 'text-decoration:underline';
    $user_name = '__';
?>

<div id="header">
    <ul>
        <li><a href="<?= $indexPath ?>" style="<?= $_GET['action'] == 'list' ? $highlight:'' ?>">LIST</a></li>
        <li><a href="<?= $addPath ?>" style="<?= $_GET['action'] == 'add' ? $highlight:'' ?>">ADD</a></li>
    </ul>
    <form method="post">
        <p id="hiUser"><?= 'hello ' . $user_name . '!' ?></p>
        <button type="submit" name="logout" value="<?= $user_name ?>" style="width:fit-content; margin-right:20px;">LOG OUT</button>
    </form>
</div>