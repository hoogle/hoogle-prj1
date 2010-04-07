<?php
    define("ICON_SIZE", 56);

    $path = dirname(__FILE__);
    $filelist = glob("{$path}/thumb-*.JPG");
    $db = new PDO("sqlite:{$path}/file.db3");
    foreach ($filelist as $k => $file)
    {
        $file = str_replace("{$path}/", "", $file);
        $img_file = $path."/".$file;
        $fh = fopen($img_file, "rb");
        $img_contents = fread($fh, filesize($img_file));
        fclose($fh);
        $img_hex = bin2hex($img_contents);

        $time = time();
        $sql = "SELECT COUNT(*) AS dup FROM filelist WHERE filename = '{$file}'";
        $res = $db->query($sql);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $rec = $res->fetch();
        if ( ! $rec['dup'])
        {
            $sql = "INSERT INTO filelist VALUES ('{$file}', 'path', {$time}, 'size', '{$img_hex}')";
            //$q = $db->exec($sql) or die(print_r($db->errorInfo(), true));
            echo "{$sql}<br/>\n";
        }
    }

    $sql = "SELECT filename, content FROM filelist";
    echo "<br/>{$sql}<br/>\n";
    $res = $db->query($sql);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $rec = $res->fetchAll();

    foreach($rec as $k => $row)
    {
        echo $row['filename']."<br/>";
    }
?>
