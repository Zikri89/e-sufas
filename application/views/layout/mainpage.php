<!DOCTYPE html>
<html>
<head>
    <?php
        require_once('meta.php');
    ?>
    <title><?php echo $submain_title ?></title>
    <?php
        require_once('link.php');
    ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php
        //Gabungin semua layout template
        require_once('header.php');
        require_once('sidebar.php');
        require_once('main.php');
        require_once('footer.php');
        ?>
    </div>
    <?php require_once('scripts.php'); ?>
</body>
</html>