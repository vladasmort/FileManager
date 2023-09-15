<?php


?>
<form method="POST">
        <table class="table mt-5">
            <thead>
                <tr>
                    <th><input type="checkbox" onclick="selectAll(event)" class="form-check-input"></th>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Modified</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php

                foreach ($files as $file) {
                    $fileToDelete = isset($_POST['selectedFiles']) ? $_POST['selectedFiles'] : [];

//--------------------------edit------------------------------------------------------------------

                    $editMode = isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['file']) && $_GET['file'] === $file;
                    if ($editMode) {
                        $editFile = pathinfo($_GET['file']);
                        $editFileName = pathinfo($_GET['file'], PATHINFO_FILENAME);

                        $form = "<form method='POST'>
                        <div class='input-group'>
                            <input type='text' name='newName' value='$editFileName' class='form-control'>
                            <button class='btn btn-primary'>Submit</button>
                        </div>
                    </form>";
                    } else {
                        $form = "";
                    }

                    if ($editMode && isset($_POST['newName'])) {
                        $newName = $_POST['newName'] . '.' . pathinfo($_GET['file'], PATHINFO_EXTENSION);
                        rename("$path/$file", "$path/$newName");
                        $editedFileDirectory = dirname("$path/$file");
                        header("Location: ?path=$editedFileDirectory");
                        exit;
                    }
                   

//------------------------ikonos prie failu---------------------------------------------------------
                    $kintamasis = pathinfo($file);
                    if (array_key_exists('extension', $kintamasis)) {
                        if ($kintamasis['extension'] === "php") {
                            $icon_class = "bi bi-filetype-php";
                        } else if ($kintamasis['extension'] === "md") {
                            $icon_class = "bi bi-filetype-md";
                        } else if ($kintamasis['extension'] === "txt") {
                            $icon_class = "bi bi-filetype-txt";
                        } else if ($kintamasis['extension'] === "html") {
                            $icon_class = "bi bi-filetype-html";
                        } else if ($kintamasis['extension'] === "jpg") {
                            $icon_class = "bi bi-image";
                        } else if ($kintamasis['extension'] === "png") {
                            $icon_class = "bi bi-image";
                        } else if ($kintamasis['extension'] === "git") {
                            $icon_class = 'bi bi-github';
                        } else if ($kintamasis['extension'] === "php") {
                            $icon_class = 'bi bi-filetype-php';
                        } else if ($kintamasis['extension'] === "pdf") {
                            $icon_class = 'bi bi-file-earmark-pdf-fill';
                        } else if ($kintamasis['extension'] === "gif") {
                            $icon_class = 'bi bi-filetype-gif';
                        } else if ($kintamasis['extension'] === "mp3") {
                            $icon_class = 'bi bi-file-earmark-music';
                        } else if ($kintamasis['extension'] === "mp4") {
                            $icon_class = 'bi bi-play-circle';
                        } else {
                            $icon_class = "";
                        }
                    } else {
                        $icon_class = "bi bi-folder2";
                    }

// --------------------------------rodo size arba folder----------------------------------------------
                    $realfile = "$path/$file";
                    
                    
                    $size = filesize($realfile);
                    if ($size >= 1048576) {
                        $size = round($size / 1024) . " mb";
                    } else if ($size >= 1024) {
                        $size = round($size / 1024) . " kb";
                    } else {
                        $size = $size . " b";
                    }

//------------------------------------- Size or Folder--------------------------------------------------

                    $FolderOrEmpty = ($file === "..") ? "" : "Folder";
                    $isFolderOrSize = is_file($realfile) ? $size : $FolderOrEmpty;
//-------------------------------- Modifikuoto failo data-----------------------------------------------

                    $laikas = ($file !== "..") ? date("d/m/Y h:i A", filemtime($realfile)) : "";
//---------------------------------------icons------------------------------------------------------------

                    $delete_icon = ($file === ".."  && !$deleteMode || $file === "uploadForm.php" || $file === "receiveFormData.php" || $file === "uploads") ? "" : "bi bi-trash";

                    $edit_icon = ($file === ".." && !$editMode || $file === "uploadForm.php" || $file === "receiveFormData.php" || $file === "uploads" ) ? "" : "bi bi-pencil-square";

//----------------------grizineja atgal ir pirmyn per viena direktorija----------------------------------



                    if ($file === ".." && $path !== ".") {
                        $link = "<a href='?path=" . dirname($path) . "'><i class='bi bi-arrow-left-circle-fill'></i></a>";
                    } else {
                       
                        $link = "<a href='?&path=" . "$path/$file" . "'>$file</a>";
                    }

                 
//-------------------------------- nerodo directorijos . ir index.php -----------------------------------


                    if ($file !== "." && $file !== "index.php" && $file !== "createNew.php" && $file !== "receiveFormData.php" && $file !== "uploadForm.php" ) {
                        echo " <tr>
        <td><input type='checkbox' class='form-check-input' name='selectedFiles[]' value='$file'></td>
        <td>
        <i class='$icon_class'></i>
        <a href='?path=$path/$file'>$link $form</a>
        </td>
        <td>$isFolderOrSize</td>
        <td>$laikas</td>
        <td>
          <a href='?action=edit&path=$path&file=$file'><i class='$edit_icon'></i>$editMode</a>
          <a href='?action=delete&path=$path&file=$file'><i class='$delete_icon'>$deleteMode</i></a>
        </td>
      </tr>";
                    }
                }
                ob_end_flush(); // Flush the output buffer
                ?>
            </tbody>
        </table>
        <div class="mt-3 d-flex gap-3">
                <button type="submit" name="deleteSelected" class="btn btn-primary">Delete Selected</button>
            </div>
        </form>
 


  