<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="proses/product.php" method="post" enctype="multipart/form-data">
        <input type="text" name="nama">
        <input type="hidden" name="aksi" value="add">
        <input type="file" name="thumb" id="thumb">
        <input type="file" name="splash" id="splash">
        <input type="checkbox" name="recom" value="yes">Recom?
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>