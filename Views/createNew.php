<?php
$path = isset($_GET['path']) ? $_GET['path'] : '.';

$fileType = isset($_POST['itemType']) ? $_POST['itemType'] : null;
$fileName = isset($_POST['inputName']) ? $_POST['inputName'] : null;
$pathPart = pathinfo($fileName);

$filePath = $path . '/' . $fileName;

if ($fileType === "file" && $fileName) {
    if (array_key_exists('extension', $pathPart)) {
            $myfile = fopen($filePath, "w") or die("Unable to open file!");
            fclose($myfile);
            header('Location: index.php?path=' . $path);
        
    } else {
        
        echo '<div class="alert alert-danger mt-5" role="alert">Invalid file name format. Make sure to include an extension.</div>';
    }
} elseif ($fileType === 'folder' && $fileName) {
    if (strpos($fileName, '.') !== false) {
        echo '<div class="alert alert-danger mt-5" role="alert">You must enter folder name without extension.</div>';
    } else {
        mkdir($filePath);
        header('Location: index.php?path=' . $path);
    }
}
?>
    <div class="container2 bg-white mx-auto my-5 p-3">
        <h5 class=""><i class="newItem bi bi-plus-square mx-1"></i>Create new Item</h5>
        <hr>
        
        <form method="POST">
            <div class="d-flex gap-4">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="itemType" value="file" <label class="form-check-label">
                    File
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="itemType" value="folder">
                    <label class="form-check-label">
                        Folder
                    </label>
                </div>
            </div>
            <div class="form-check p-0 my-3">
                <label>Item name</label>
                <input type="text" name="inputName" class="form-control" placeholder="Enter here...">
            </div>
            <hr>
            <div class="d-flex justify-content-end gap-2">
                <button class="btn btn-outline-primary">Create</button>
            </div>
        </form>


    </div>
