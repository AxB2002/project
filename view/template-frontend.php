<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bibliotheque</title>
    <link href="<?= $path ?>assets/img/favicon.png" rel="icon">
    <link href="<?= $path ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="<?= $path ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $path ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= $path ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= $path ?>assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= $path ?>assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= $path ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= $path ?>assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="<?= $path ?>assets/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="<?= $path ?>assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">MaBiblioTech</span>
            </a>
            <?= isset($user) ? '<i class="bi bi-list toggle-sidebar-btn"></i>' : "" ?>
        </div><!-- End Logo -->

    </header><!-- End Header -->

    <?php if(isset($user)) {

        $CONFIG_NAV = [
            [
                "label" => "Créer un utilisateur",
                "access" => ["admin"],
                "href" => $path . "Utilisateur/create"
            ],
            [
                "label" => "Lister les utilisateurs",
                "access" => ["admin", "employe"],
                "href" => $path . "Utilisateur/list"
            ],
            [
                "label" => "Lister les documents",
                "access" => ["admin", "employe", "membre"],
                "href" => $path . "Document/list"
            ],
            [
                "label" => "Lister les réservations",
                "access" => ["admin", "employe"],
                "href" => $path . "Reservation/list"
            ],
            [
                "label" => "Déconnexion",
                "access" => ["admin", "employe", "membre"],
                "href" => $path . "Connexion/logout"
            ],
        ]
        ?>
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <h5><?= $user["Prenom"] . " " . $user["Nom"] ?></h5>
                <span>Role : <strong><?= $user["Role"] ?></strong></span>
            </li>

            <?php foreach($CONFIG_NAV as $config) {
                if(in_array($user["Role"], $config["access"])) {
                ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= $config["href"] ?>">
                    <span><?= $config["label"] ?></span>
                </a>
            </li>
            <?php
                }
            } ?>
        </ul>

    </aside><!-- End Sidebar-->
    <?php 
    } ?>

    <main id="<?= isset($user) ? "main" : "" ?>" class="<?= isset($user) ? "main" : "" ?>">
        <?php include $templateMain; ?>

        <?php if (isset($errors)){  ?>
        <div class="col-12">
            <div class="alert alert-danger"><?= $errors ?></div>
        </div>
        <?php } ?>
    </main>

    <!-- Vendor JS Files -->
    <script src="<?= $path ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?= $path ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $path ?>assets/vendor/chart.js/chart.umd.js"></script>
    <script src="<?= $path ?>assets/vendor/echarts/echarts.min.js"></script>
    <script src="<?= $path ?>assets/vendor/quill/quill.js"></script>
    <script src="<?= $path ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?= $path ?>assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?= $path ?>assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= $path ?>assets/js/main.js"></script>
</body>

</html>