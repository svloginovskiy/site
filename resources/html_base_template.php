<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= isset($VIEWTITLE) ? ucfirst($VIEWTITLE) : ucfirst($VIEWNAME) . ' page'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?php if (file_exists('css/' . $VIEWNAME . '.css')): ?>
        <link href="/css/<?= $VIEWNAME . '.css'; ?>"
              rel="stylesheet"/>
    <?php endif; ?>
    <link href="/css/default.css" rel="stylesheet"/>
    <?php if (file_exists('js/' . $VIEWNAME . '.js')): ?>
        <script src="/js/<?= $VIEWNAME; ?>.js"></script>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;1,400;1,500&display=swap');
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css");
    </style>
</head>
<body onload="initElement()">
<main class="h-100">
    <?php
    include $VIEWHEADER;
    include $VIEWBODY; ?>
</main>
</body>
</html>

