<?php
$targetDir = "./";

if (!empty($_FILES)) {
    $file = $_FILES['file']['tmp_name'];
    $chunkNumber = $_POST['chunkNumber'];
    $chunks = $_POST['chunks'];

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $targetFile = $targetDir . basename($_FILES['file']['name']) . '.part' . $chunkNumber;
    move_uploaded_file($file, $targetFile);

    if ($chunkNumber == $chunks) {
        // 所有分片上传完成，合并文件
        $fileName = $targetDir . basename($_FILES['file']['name']);

        $fp = fopen($fileName, 'w');

        for ($i = 1; $i <= $chunks; $i++) {
            $partFile = $targetDir . basename($_FILES['file']['name']) . '.part' . $i;
            $partStream = fopen($partFile, 'r');
            fwrite($fp, fread($partStream, filesize($partFile)));
            fclose($partStream);
            unlink($partFile);
        }

        fclose($fp);

        // 返回上传ID，可用于后续操作
        echo '123456';
    }
}
