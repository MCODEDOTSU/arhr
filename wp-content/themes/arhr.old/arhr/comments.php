
<?php if (have_comments()) : global $wp_query; ?>

    <h2 class="comment-title">Обсуждение</h2>

    <ul class="comment-list">
        <?php wp_list_comments(); ?>
    </ul>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
        <nav>
            <div class="nav-previous"><?php previous_comments_link(); ?></div>
            <div class="nav-next"><?php next_comments_link(); ?></div>
        </nav>
    <?php endif; ?>

<?php endif; ?>

<?php if (comments_open()) {
    comment_form();
} ?>

