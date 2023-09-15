<?php
$path = isset($_GET['path']) ? $_GET['path'] : ".";
?>

<header class=" border pt-2 bg-light shadow-sm bg-body">
        <div class="container d-flex justify-content-between">
            <div class="d-flex">
                <h5>H3K Demo</h5>
                <a href="./"><i class="bi bi-house-fill px-2 text-primary"></i></a>
            </div>
            <nav>
                <ul class="d-flex gap-5 list-unstyled text-muted"> 
                    <li class="newItem">
                    <?php 
                        echo '<a href="?page=upload&path=' . $path . '" class="link-secondary link-underline link-underline-opacity-0">
                         <i class="bi bi-plus-square"></i>  
                            <span>Upload</span>
                        </a>'
                        ?>
                        </li> 
                    <li class="upload">
                        <?php 
                        echo '<a href="?page=createNew&path=' . $path . '" class="link-secondary link-underline link-underline-opacity-0">
                                <i class=" bi bi-cloud-arrow-up"></i>
                                <span>Create New</span>
                            </a>'
                        ?>
                    </li>
                   
                </ul>
            </nav>
        </div>
    </header>