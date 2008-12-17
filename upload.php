<?php
ini_set('upload_max_filesize', '30M');

if(!empty($_FILES)) {
    print_r($_FILES);
}
?>
<html>
<head>
    <title>Upload Test</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="10240000" />
        <input type="file" name="pdf"/>
        <input type="submit" value="Upload" />
    </form>
</body>
</html>
