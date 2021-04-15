<?php
    require_once("../admin/includes/message.php");
    if (isset($_POST['submit_upload']) && isset($_FILES['file_upload']['error'])) {
        $upload_errors = [
            UPLOAD_ERR_INI_SIZE => "Selected file exceeds the maximal upload file size directive in php.ini.",
            UPLOAD_ERR_FORM_SIZE => "Selected file exceeds the maximal upload file size directive in the HTML form.",
            UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
            UPLOAD_ERR_NO_FILE => "No file was selected.",
            UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
            UPLOAD_ERR_CANT_WRITE => "IO error. Cannot write to disk.",
            UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload.",
        ];
        
        $name = $_FILES['file_upload']['name'];
        $tmp_name = $_FILES['file_upload']['tmp_name'];
        $upload_dir = 'uploaded_files';
        $target_dir = realpath("..") . DIRECTORY_SEPARATOR . $upload_dir . DIRECTORY_SEPARATOR . $name;
        if (!move_uploaded_file($tmp_name, $target_dir)) {
            setMessage($upload_errors[$_FILES['file_upload']['error']]);
        } else {
            setMessage("Upload successful.");
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload</title>
</head>
<body>
<form action="upload.php" enctype="multipart/form-data" method="post">
    <div>
        <pre><?php echo showMessage(); ?></pre>
    </div>
    <input type="file" name="file_upload"><br><br>
    <input type="submit" name="submit_upload" value="Upload">
</form>
</body>
</html>
