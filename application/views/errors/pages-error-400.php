<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>HRIS | 403</title>
    <link href="<?= base_url('assets/images/favicon.png') ?>" rel="icon" type="image/png" sizes="16x16">
    <link href="<?= base_url('assets/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>

<body class="fix-header card-no-border">

    <section id="wrapper" class="error-page">
        <div class="error-box">
            <div class="error-body text-center">
                <h1 class="text-danger">400</h1>
                <h3 class="text-uppercase">Page Not Found !</h3>
                <p class="text-muted mt-4 mb-4">YOU SEEM TO BE TRYING TO FIND HIS WAY HOME</p>
                <a href="<?= base_url('dashboard') ?>" class="btn btn-danger btn-rounded waves-effect waves-light mb-5">Back to home</a>
            </div>
            <footer class="footer text-center">© 2019 - <?= date('Y') ?> PT RESLIN INDONESIA. All Rights Reserved..</footer>
        </div>
    </section>

    <script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/bootstrap/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/waves/waves.js') ?>"></script>
</body>

</html>