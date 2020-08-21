<?php $partners = arhr_partners_get(pll_current_language()) ?>

<?php if (count($partners) != 0): ?>

    <div class="arhr-partners fix">

        <h2 class="title"><?= __('Our partners', 'arhr') ?></h2>

        <div class="items"><!--

            <?php foreach($partners as $partner): ?>

                --><div class="arhr-partners-item">

                <div class="container animate"><!--

                    <?php if (!empty($partner['image'])): ?>
                        --><img src="<?= wp_get_attachment_image_src($partner['image'], 'thumbnail')[0] ?>"
                             alt="<?= $partner['name'] ?>" /><!--
                    <?php else: ?>
                        --><img src="<?= get_template_directory_uri() . '/img/thumb-150-150.png' ?>"
                             alt="<?= $partner['name'] ?>" /><!--
                    <?php endif; ?>

                    --><h2><?= $partner['name'] ?></h2>

                </div>

            </div><!--

            <?php endforeach; ?>

        --></div>

        <?php if(!empty(get_post_meta(get_the_ID(), 'homepage_parners_link', true))): ?>

            <a class="arhr-partners-more" href="<?= get_post_meta(get_the_ID(), 'homepage_parners_link', true) ?>"><?= __('watch more', 'arhr') ?></a>

        <?php endif; ?>

    </div>

<?php endif; ?>