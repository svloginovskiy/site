<!DOCTYPE html>
<html>
<head>
    <title><?= isset($VIEWTITLE) ? $VIEWTITLE : $VIEWNAME . ' page'; ?></title>
    <link href="/css/<?= file_exists('css/' . $VIEWNAME . '.css') ? $VIEWNAME . '.css' : 'default.css'; ?>"
          rel="stylesheet"/>
</head>
<body>
<?php
include $VIEWBODY ?>
</body>
</html>

