<?php
$uploadFile = isset($_FILES['uploadFile']) ? $_FILES['uploadFile'] : null;
if ($uploadFile['size'] > 40000) {
    echo 'failo dydis per didelis';
} else {
    if (
        $uploadFile['type'] !== 'image/png' &&
        $uploadFile['type'] !== 'image/jpeg' &&
        $uploadFile['type'] !== 'image/gif'
    ) {
        echo 'Netinkamas failo formatas';
    } else {
        $uploadFileName = $uploadFile['name'];
        move_uploaded_file($uploadFile['tmp_name'], './uploads/' . $uploadFileName);
        echo 'failas sekmingai ikeltas';
        header('Location: ./');
    }
}
?>