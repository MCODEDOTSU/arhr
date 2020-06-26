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

    header .main,
    header .header-menu,
    header .header-menu .sub-menu,
    header .header-menu .social-container a,
    footer .subscribe .form-input,
    footer .subscribe .form-submit,
    #mobile-menu > .mobile-menu {
        background: <?= get_theme_mod('color_2', '#ffffff') ?>;
    }

    header .main {
        background: -moz-linear-gradient(0deg, <?= hex2rgba(get_theme_mod('color_1', '#fafafa'), 1) ?> 0%, <?= hex2rgba(get_theme_mod('color_1', '#fafafa'), 1) ?> 20%, #ffffff 100%);
        background: -webkit-linear-gradient(0deg, <?= hex2rgba(get_theme_mod('color_1', '#fafafa'), 1) ?> 0%, <?= hex2rgba(get_theme_mod('color_1', '#fafafa'), 1) ?> 20%, #ffffff 100%);
        background: linear-gradient(0deg, <?= hex2rgba(get_theme_mod('color_1', '#fafafa'), 1) ?> 0%, <?= hex2rgba(get_theme_mod('color_1', '#fafafa'), 1) ?> 20%, #ffffff 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="<?= get_theme_mod('color_1', '#fafafa') ?>", endColorstr="<?= get_theme_mod('color_2', '#ffffff') ?>", GradientType=1);
    }

    header .main-right .contacts button,
    footer h2,
    footer p,
    footer .widget_nav_menu a,
    footer .subscribe .form-submit input,
    footer .subscribe .form-label label,
    footer .subscribe .ajax-loader:before,
    #mobile-panel li a {
        color: <?= get_theme_mod('color_2', '#ffffff') ?>;
    }

    header .main-right .contacts button,
    footer,
    footer .widget_nav_menu .sub-menu,
    #mobile-panel {
        background: <?= get_theme_mod('color_3', '#3a85c0') ?>;
    }

    header .languages-menu a,
    header .main-right .contacts a,
    header .header-menu .sub-menu a:hover,
    .page-content.single .comment-list .comment-author a,
    .page-content.single .comment-list .comment-meta a,
    .page-content.single .comment-list .reply a,
    .page-content.single .comment-respond .logged-in-as a,
    .page-content.single .cptch_block .cptch_time_limit_notice {
        color: <?= get_theme_mod('color_3', '#3a85c0') ?>;
    }

    blockquote,
    q {
        background: <?= hex2rgba(get_theme_mod('color_3', '#3a85c0'), 0.2); ?>;
    }

    blockquote:before,
    q:before,
    blockquote:after,
    q:after {
        color: <?= hex2rgba(get_theme_mod('color_3', '#3a85c0'), 0.2); ?>;
    }

    header .top-menu li a,
    header .languages-menu li.current-lang a,
    header .logo,
    header .main-right .search-input,
    header .header-menu .menu a,
    #mobile-panel li.current-lang a,
    .post-data,
    .pagination .page-numbers,
    .page-content.single .comment-form-comment label,
    .page-content.single .comment-form-comment textarea,
    .page-content.single .comment-notes span,
    .page-content.single .comment-form-author label,
    .page-content.single .comment-form-email label,
    .page-content.single .comment-form-author input,
    .page-content.single .comment-form-email input,
    .page-content.single .comment-form-cookies-consent input[type="checkbox"],
    .page-content.single .comment-form-cookies-consent label,
    .page-content.single .cptch_block .cptch_title,
    .page-content.single .cptch_block .cptch_wrap,
    .page-content.searchpage .search-input,
    #mobile-menu .menu-container a {
        color: <?= get_theme_mod('color_4', '#222222') ?>;
    }

    footer .subscribe .form-submit input {
        background: <?= get_theme_mod('color_4', '#222222') ?>;
    }

    .page-content.single .comment-form-comment textarea,
    .page-content.single .comment-form-author input,
    .page-content.single .comment-form-email input,
    .page-content.single .comment-form-cookies-consent input[type="checkbox"],
    .page-content.searchpage .search-input {
        border-color: <?= get_theme_mod('color_4', '#222222') ?>;
    }

</style>