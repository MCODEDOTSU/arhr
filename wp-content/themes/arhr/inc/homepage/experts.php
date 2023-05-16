<?php $experts = arhr_experts_get(pll_current_language()) ?>

<?php if (count($experts) != 0): ?>

    <div class="arhr-experts fix">

        <h2 class="title"><?= __('Gallery of experts', 'arhr') ?></h2>

        <div class="items"><!--

            <?php foreach($experts as $expert): ?>

                --><div class="arhr-experts-item">

                    <div class="container animate">

                        <?php if (!empty($expert['photo'])): ?>
                            <img src="<?= wp_get_attachment_url($expert['photo']) ?>"
                                 alt="<?= $expert['lastname'] ?> <?= $expert['firstname'] ?> <?= $expert['middlename'] ?>" />
                        <?php else: ?>
                            <img src="<?= get_template_directory_uri() . '/img/thumb-150-150.png' ?>"
                                 alt="<?= $expert['lastname'] ?> <?= $expert['firstname'] ?> <?= $expert['middlename'] ?>" />
                        <?php endif; ?>

                        <h2 class="lastname"><?= $expert['lastname'] ?></h2>
                        <h2><?= $expert['firstname'] ?> <?= $expert['middlename'] ?></h2>
                        <h3><?= $expert['post'] ?></h3>

                    </div>

                </div><!--

            <?php endforeach; ?>

        --></div>

    </div>

<?php endif; ?>
