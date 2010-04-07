<?php
    $path = dirname(__FILE__);
    $db = new PDO("sqlite:{$path}/file.db3");
    $sql = "SELECT filename, content FROM filelist WHERE filename like 'thumb-DSC0%'";
    $res = $db->query($sql);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $rec = $res->fetchAll();
    $rec_length = count($rec);

    foreach($rec as $row)
    {
        echo "<img src=\"show.php?filename={$row['filename']}\"/></br/>\n";
    }
?>
