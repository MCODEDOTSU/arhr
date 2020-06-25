<style rel="stylesheet" type="text/css">

    .fix {
        max-width: <?= get_theme_mod('max_width', '1340') ?>px;
    }

    header .logo {
        background-image: url('<?= get_theme_mod('logo_image', get_template_directory_uri() . 'img/logo.png') ?>');
    }

    header {
        background: <?= get_theme_mod('color_1', '#fafafa') ?>;
    }

    header .main {
        background: -moz-linear-gradient(0deg, <?= hex2rgba(get_theme_mod('color_1', '#fafafa'), 1) ?> 0%, <?= hex2rgba(get_theme_mod('color_1', '#fafafa'), 1) ?> 20%, #ffffff 100%);
        background: -webkit-linear-gradient(0deg, <?= hex2rgba(get_theme_mod('color_1', '#fafafa'), 1) ?> 0%, <?= hex2rgba(get_theme_mod('color_1', '#fafafa'), 1) ?> 20%, #ffffff 100%);
        background: linear-gradient(0deg, <?= hex2rgba(get_theme_mod('color_1', '#fafafa'), 1) ?> 0%, <?= hex2rgba(get_theme_mod('color_1', '#fafafa'), 1) ?> 20%, #ffffff 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="<?= get_theme_mod('color_1', '#fafafa') ?>", endColorstr="<?= get_theme_mod('color_2', '#ffffff') ?>", GradientType=1);
    }

    header .main,
    header .header-menu,
    header .header-menu .sub-menu,
    header .header-menu .social-container a,
    footer .subscribe .form-input,
    footer .subscribe .form-submit {
        background: <?= get_theme_mod('color_2', '#ffffff') ?>;
    }

    header .main-right .contacts button,
    footer h2,
    footer p,
    footer .widget_nav_menu a,
    footer .subscribe .form-submit input,
    footer .subscribe .form-label label,
    footer .subscribe .ajax-loader:before {
        color: <?= get_theme_mod('color_2', '#ffffff') ?>;
    }

    header .main-right .contacts button,
    footer,
    footer .widget_nav_menu .sub-menu {
        background: <?= get_theme_mod('color_3', '#3a85c0') ?>;
    }

    header .languages-menu a,
    header .main-right .contacts a,
    header .header-menu .sub-menu a:hover {
        color: <?= get_theme_mod('color_3', '#3a85c0') ?>;
    }

    header .top-menu li a,
    header .languages-menu li.current-lang a,
    header .logo,
    header .main-right .search-input,
    header .header-menu .menu a {
        color: <?= get_theme_mod('color_4', '#222222') ?>;
    }

    footer .subscribe .form-submit input {
        background: <?= get_theme_mod('color_4', '#222222') ?>;
    }

</style>