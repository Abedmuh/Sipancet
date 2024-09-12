<?php
$uri = explode('/', $_SERVER['REQUEST_URI']);
$url = "http://" . $_SERVER['HTTP_HOST'] . '/' . $uri[1] . '/' . $uri[2];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= $url . '/' ?>template/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= $url . '/' ?>template/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= $url . '/' ?>template/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?= $url . '/' ?>template/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="<?= $url . '/' ?>template/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= $url . '/' ?>template/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= $url . '/' ?>template/images/favicon.png" />

    <link rel="stylesheet" href="<?= $url . '/' ?>template/vendors/sweetalert-2.11.1.7/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="<?= $url . '/' ?>template/vendors/fontawesome-free-6.2.0-web/css/all.min.css">
    <script src="<?= $url . '/' ?>template/vendors/sweetalert-2.11.1.7/dist/sweetalert2.min.js"></script>
    <script src="<?= $url . '/' ?>template/js/jquery-3.6.0.min.js"></script>
    <style>
        .swal2-modal .swal2-icon,
        .swal2-modal {
            margin-top: 42px !important;
        }

        .swal2-title {
            padding-top: 0px !important;
        }
    </style>
</head>

<body>