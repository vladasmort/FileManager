
<?php
ob_start(); // Start output buffering

$path = isset($_GET['path'])  ? urldecode($_GET['path']) : '.';

if (!is_dir($path)) {
    if (file_exists($path)) {
        $filePath = $path;
        include 'Views/fileInfo.php';
        exit;
    } else {
        die('Invalid directory or file path: ' . $path);
    }
}

$files = scandir($path);

unset($files[0]);
if ($path === ".") unset($files[1]);

 //------------------------delete-------------------------------------------------------------------
function removeRecursively($dir)
{
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (is_dir($dir . "/" . $object)) {
                    removeRecursively($dir . "/" . $object);
                } else {
                    unlink($dir . "/" . $object);
                }
            }
        }
        rmdir($dir);
    }
}
$disallowedFiles = ["index.php", "receiveFormData.php", "uploadForm.php", "createNEw.php", "uploads"];
$deleteMode = isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['file']);
if ($deleteMode) {
    $fileToDelete = $_GET['file']; // Get the file to be deleted

    if (!in_array($fileToDelete, $disallowedFiles)) {
        $deleteitem = $path . '/' . $fileToDelete; // Use the correct file name

        if (is_dir($deleteitem)) {
            // Remove the folder and its contents
            removeRecursively($deleteitem);
        } else {
            // Remove a file
            unlink($deleteitem);
        }
        header("Location: ?path=$path");
    }
}
//--------------delete selected --------------------------------
if (isset($_POST['deleteSelected'])) {
    if (isset($_POST['selectedFiles'])) {
        foreach ($_POST['selectedFiles'] as $fileToDelete) {
            if (!in_array($fileToDelete, $disallowedFiles)) {
                $deleteitem = $path . '/' . $fileToDelete;
                if (is_dir($deleteitem)) {
                    // Remove the folder and its contents
                    removeRecursively($deleteitem);
                } else {
                    // Remove a file
                    unlink($deleteitem);
                }
            }
        }
        // After deleting selected files, redirect back to the same page
        header("Location: ?path=$path");
        exit;
    }
}

$page = isset($_GET['page']) ? $_GET['page'] : false;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
   
</head>
 
<body class="bg-secondary-subtle">
   <?php include './Views/snippets/Header.php'; ?>
    
    <main>
    <div class="container">
    <?php switch ($page) { 
        case 'createNew':
            include './Views/createNew.php';
            break;
        case 'upload':
            include './Views/uploadForm.php';
            break;
        case 'fileInfo':
            include './Views/fileInfo.php';
            break;
        default:
            include './Views/Home.php';
    }
    ?>
    </main>
    </div>
    

</body>
<script>
      function selectAll(e) {
        const checkAll = document.querySelectorAll('input[type="checkbox"]');
        checkAll.forEach((el) => {
            el.checked = !el.checked;
        });
        
    }
</script> 

</html>