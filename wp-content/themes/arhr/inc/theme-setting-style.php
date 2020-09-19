<style rel="stylesheet" type="text/css">

    .fix {
        max-width: <?= get_theme_mod('max_width', '1340') ?>px;
    }

    header .logo,
    #mobile-panel .logo {
        <?php
            $locate = get_locale();
            $back = get_theme_mod('logo_image_' . get_locale(), '') == '' ?
                get_template_directory_uri() . "/img/logo_header_$locate.svg" :
                get_theme_mod('logo_image_' . get_locale(), ''); ?>
        background-image: url('<?= $back ?>');
    }

    .homepage .map {
        <?php $back = get_theme_mod('map_back_image', '') == '' ? get_template_directory_uri() . "/img/back.png" : get_theme_mod('map_back_image', ''); ?>
        background-image: url('<?= $back ?>');
    }

    header,
    .page-content.category .post-item:first-child,
    .page-content.category .post-item.main,
    .contact-form input,
    .contact-form textarea,
    .homepage .map {
        background-color: <?= get_theme_mod('color_1', '#fafafa') ?>;
    }

    header .main,
    header .header-menu,
    header .header-menu .sub-menu,
    header .header-menu .social-container a,
    footer .subscribe .form-input,
    footer .subscribe .form-submit,
    #mobile-menu > .mobile-menu,
    #mobile-panel,
    .homepage .map-description .btn.btn-2,
    .homepage .map-item {
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
    footer a,
    footer .widget_nav_menu a,
    footer .subscribe .form-submit input,
    footer .subscribe .form-label label,
    footer .subscribe .ajax-loader:before,
    #mobile-panel li a,
    .mcode-calendar table.calendar td.current div,
    .arhr-advantages .arhr-advantages-item:hover,
    .arhr-advantages .arhr-advantages-item:hover h2,
    .arhr-advantages .arhr-advantages-item:hover h3,
    .arhr-advantages .arhr-advantages-item:hover .container,
    .page-content .post-tags a:hover,
    .contact-form input[type="submit"],
    .homepage .map-description .btn,
    .homepage .map-description .btn:hover,
    .homepage .map-description .btn.btn-2:hover,
    .homepage .calendar-container .event-item.today,
    .calendar-grid td.current,
    .mcode_calendar-days_month .empty {
        color: <?= get_theme_mod('color_2', '#ffffff') ?>;
    }

    .arhr-advantages-item:hover svg path {
        fill: <?= get_theme_mod('color_2', '#ffffff') ?>;
    }

    header .main-right .contacts button,
    footer,
    footer .widget_nav_menu .sub-menu,
    .contact-form input[type="submit"],
    header .main-right .contacts .btn,
    .mcode-calendar table.calendar td.current div,
    .arhr-advantages .arhr-advantages-item:hover .container,
    .page-content .post-tags a:hover,
    .homepage .map-description .btn,
    .homepage .calendar-container .event-item.today,
    .calendar-grid td.current,
    .mcode_calendar-days_month .empty,
    .arhr-advantages .arhr-advantages-item:hover .container {
        background: <?= get_theme_mod('color_3', '#3a85c0') ?>;
    }

    header .languages-menu a,
    header .main-right .contacts a,
    header .header-menu .sub-menu a:hover,
    .page-content.single .comment-list .comment-author a,
    .page-content.single .comment-list .comment-meta a,
    .page-content.single .comment-list .reply a,
    .page-content.single .comment-respond .logged-in-as a,
    .page-content.single .cptch_block .cptch_time_limit_notice,
    .page-content a,
    #mobile-panel .contacts a,
    header .top-menu li a:hover,
    header .header-menu .menu a:hover,
    .btn-link,
    .homepage .map-item .map-item-count span,
    .homepage .map-item a,
    .homepage .news-container a.news-category,
    .arhr-partners .arhr-partners-more,
    header .header-menu .menu li.current-menu-item a {
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

    .mcode-calendar table.calendar td.current div,
    .arhr-advantages .arhr-advantages-item:hover .container,
    .page-content .post-tags a,
    .homepage .map-description .btn,
    .arhr-advantages .arhr-advantages-item:hover .container,
    .page-content.category .post-categories a {
        border-color: <?= get_theme_mod('color_3', '#3a85c0') ?>;
    }

    .arhr-advantages-item svg path {
        fill: <?= get_theme_mod('color_3', '#3a85c0') ?>;
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
    #mobile-menu .menu-container a,
    .contact-form textarea,
    .mcode-calendar .dw,
    #mobile-menu .languages-menu a,
    #mobile-menu .account-link,
    .mcode-calendar .actions button,
    .mcode-calendar table td > a,
    .mcode-calendar table td input[type="submit"],
    .page-content .post-tags a,
    .breadcrumbs a,
    .homepage .map-description a,
    .homepage .map-description .btn.btn-2,
    .homepage .news-item .news-data,
    .homepage .calendar-container a {
        color: <?= get_theme_mod('color_4', '#222222') ?>;
    }

    footer .subscribe .form-submit input,
    header .header-menu .menu > li > a:before,
    #mobile-menu .menu > li.menu-item-has-children > a:before,
    header .main-right .contacts .btn:hover,
    .homepage .map-description .btn:hover {
        background: <?= get_theme_mod('color_4', '#222222') ?>;
    }

    .page-content.single .comment-form-comment textarea,
    .page-content.single .comment-form-author input,
    .page-content.single .comment-form-email input,
    .page-content.single .comment-form-cookies-consent input[type="checkbox"],
    .page-content.searchpage .search-input,
    .mcode-calendar table th > div,
    .mcode-calendar table td > div,
    .arhr-advantages .arhr-advantages-item .container,
    .page-content.category .post-item.main,
    .homepage .map-description .btn:hover,
    .homepage .map-description .btn:hover,
    .mcode_calendar-full .calendar-grid th,
    .mcode_calendar-full .calendar-grid td {
        border-color: <?= get_theme_mod('color_4', '#222222') ?>;
    }

    .members-list li:before {
        background: <?= get_theme_mod('color_5', '#bbbbbb') ?>;
    }

    header .main-right .search-input,
    .contact-form .row,
    .page-content.category .post-item:first-child,
    .page-content .border,
    .breadcrumbs,
    .page-content .member-items .member-item .member-item-close,
    .page-content .member-items .member-item .member-item-open,
    .homepage .calendar-container,
    .homepage .calendar-container,
    .homepage .news-item:first-child,
    .calendar-grid td,
    .arhr-advantages .arhr-advantages-item .container {
        border-color: <?= get_theme_mod('color_5', '#bbbbbb') ?>;
    }

</style>