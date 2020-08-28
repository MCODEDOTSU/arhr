<?php $advantages = arhr_advantages_get(pll_current_language()) ?>

<?php if (count($advantages) != 0): ?>

<div class="arhr-advantages fix">

    <h2 class="title"><?= __('Our values', 'arhr') ?></h2>

    <div class="items"><!--

        <?php foreach($advantages as $advantage): ?>

            --><div class="arhr-advantages-item">

                <div class="container animate">

                    <?php

                    $icon = wp_unslash(htmlspecialchars_decode($advantage['svg']));
                    if (empty($icon)) {
                        $src = wp_get_attachment_url($advantage['image']);
                        $icon = "<img src='$src' alt='{$advantage['name']}' />";
                    }
                    ?>

                    <?= $icon ?>
                    <h2><?= $advantage['name'] ?></h2>
                    <h3><?= $advantage['description'] ?></h3>

                </div>

            </div><!--

        <?php endforeach; ?>

    --></div>

</div>

<?php endif; ?>