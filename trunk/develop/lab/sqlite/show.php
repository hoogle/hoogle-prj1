<?php
    $filename = $_GET['filename'];
    $db = new PDO("sqlite:/home/www/develop/lab/sqlite/file.db3");
    $sql = "SELECT content FROM filelist WHERE filename = '{$filename}'";
    $res = $db->query($sql);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $rec = $res->fetch();
    $bin_str = pack("H*", $rec['content']);
    header('Content-type: image/jpeg');
    echo $bin_str;
?>
