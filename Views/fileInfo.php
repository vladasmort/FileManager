<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

<?php

$file = isset($filePath) ? urldecode($filePath) : '';

if (!file_exists($file)) {
    die('File not found.');
}

$fileInfo = pathinfo($file);
$fileName = $fileInfo['basename'];
$fileSize = filesize($file);
$fileSizeFormatted = formatFileSize($fileSize);
$fileType = mime_content_type($file);
$fileModified = date("d/m/Y h:i A", filemtime($file));

function formatFileSize($size)
{
    if ($size >= 1048576) {
        return round($size / 1024 / 1024, 2) . " MB";
    } elseif ($size >= 1024) {
        return round($size / 1024, 2) . " KB";
    } else {
        return $size . " bytes";
    }
}
?>
<div class="container3 text-center  p-5 bg-light">
     <h3>File Information</h3>
    <p><strong>File Name:</strong> <?php echo $fileName; ?></p>
    <p><strong>File Size:</strong> <?php echo $fileSizeFormatted; ?></p>
    <p><strong>File Type:</strong> <?php echo $fileType; ?></p>
    <p><strong>Last Modified:</strong> <?php echo $fileModified; ?></p>
    <p><a href="javascript:history.go(-1)" class="link-secondary link-underline link-underline-opacity-0"><i class='bi bi-arrow-left-circle-fill'></i>Back</a></p>
</div>
   

