<div class="wrap mcode-arhr mcode-arhr-advantages" data-type="advantages">

    <h1>Преимущества <a href="#add" class="page-title-action add-item">Добавить новое</a></h1>

    <div class="error notice">
        <p></p>
    </div>

    <div class="updated notice">
        <p></p>
    </div>

    <table class="wp-list-table widefat fixed striped posts items-list" role="presentation">

        <thead>
        <tr>
            <th class="manage-column column-cb">Наименование</th>
            <th class="manage-column column-title column-primary">Описание</th>
            <th class="manage-column column-title">Язык</th>
            <th class="manage-column column-title"></th>
        </tr>
        </thead>

        <tbody>

        <?php foreach ($advantages as $i => $advantage): ?>

            <tr class="short-item-data">

                <td class="title column-title has-row-actions column-primary page-title">
                    <strong><?= $advantage['name'] ?></strong>
                    <div class="row-actions">
                        <span class="edit"><a data-id="<?= $advantage['id'] ?>" href="#edit" aria-label="Редактировать «<?= $advantage['name'] ?>»">Изменить</a> | </span>
                        <span class="delete"><a data-id="<?= $advantage['id'] ?>" href="#delete" aria-label="Удалить «<?= $advantage['name'] ?>»">Удалить</a></span>
                    </div>
                </td>
                <td class="title column-title"><?= $advantage['description'] ?></td>
                <td class="title column-title"><?= $advantage['lang'] ?></td>
                <td class="title column-title">
                    <?php if ($advantage['is_published']): ?>
                        <span class="deactivate"><a data-id="<?= $advantage['id'] ?>" href="#deactivate" aria-label="Деактивировать «<?= $advantage['name'] ?>»">Деактивировать</a></span>
                    <?php else: ?>
                        <span class="activate"><a data-id="<?= $advantage['id'] ?>" href="#activate" aria-label="Активировать «<?= $advantage['name'] ?>»">Активировать</a></span>
                    <?php endif; ?>
                </td>

            </tr>

            <tr class="item-dialog" id="item-dialog-<?= $advantage['id'] ?>">

                <td class="title column-title has-row-actions column-primary page-title" colspan="3">

                    <table width="100%" class="wp-list-table widefat fixed striped posts item-data">
                        <tr>
                            <td rowspan="3" class="item-image-container">

                                <div class="image-container-list">

                                    <?php if (!empty($advantage['image'])): ?>

                                        <?php $url = wp_get_attachment_url($advantage['image']); ?>

                                        <div class="image-container image">
                                            <img src="<?= $url ?>" class="item-image"/>
                                            <button class="delete-image page-title-action">Удалить</button>
                                        </div>

                                    <?php endif; ?>
                                </div>

                                <div class="add-image page-title-action">Выбрать</div>

                                <input class="images-text-list item-field" name="image" type="hidden" value="<?= $advantage['image'] ?>" data-save="<?= $advantage['image'] ?>"  />
                                <input name="photo-url" class="image-url" type="hidden" value="<?= $url ?>"  />

                            </td>
                            <td>Наименование: *</td>
                            <td class="input">
                                <input type="text" name="name" value="<?= $advantage['name'] ?>" data-save="<?= $advantage['name'] ?>" class="item-field" />
                            </td>
                        </tr>
                        <tr>
                            <td>SVG-иконка:</td>
                            <td class="input">
                                <textarea name="svg" data-save="<?= wp_unslash($advantage['svg']) ?>" class="item-field"><?= wp_unslash($advantage['svg']) ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Описание:</td>
                            <td class="input">
                                <textarea name="description" data-save="<?= $advantage['description'] ?>" class="item-field"><?= $advantage['description'] ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Язык:</td>
                            <td class="input">
                                <select name="lang" data-save="<?= $advantage['lang'] ?>" class="item-field">
                                    <?php foreach ($languages as $lang): ?>
                                        <option value="<?= $lang ?>" <?= selected($advantage['lang'], $lang); ?>><?= $lang ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td align="right">
                                <a href="#cansel" class="page-title-action button-cansel">Закрыть без сохранения</a>
                                <a href="#ok" class="page-title-action button-primary button-ok">Сохранить</a>
                                <input type="hidden" name="id" value="<?= $advantage['id'] ?>"/>
                            </td>
                        </tr>
                    </table>

                </td>

            </tr>

        <?php endforeach; ?>

        <tr class="item-dialog" id="item-dialog-0">

            <td class="title column-title has-row-actions column-primary page-title" colspan="3">

                <table width="100%" class="wp-list-table widefat fixed striped posts item-data">
                    <tr>
                        <td rowspan="3" class="item-image-container">

                            <div class="image-container-list"></div>

                            <div class="add-image page-title-action">Выбрать</div>

                            <input class="images-text-list item-field" name="image" type="hidden" data-save=""  />
                            <input name="photo-url" type="hidden" />

                        </td>
                        <td>Наименование: *</td>
                        <td class="input">
                            <input type="text" name="name" data-save="" class="item-field" />
                        </td>
                    </tr>
                    <tr>
                        <td>SVG-иконка:</td>
                        <td class="input">
                            <textarea name="svg" data-save="" class="item-field"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Описание:</td>
                        <td class="input">
                            <textarea name="description" data-save="" class="item-field"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Язык:</td>
                        <td class="input">
                            <select name="lang" data-save="<?= $languages[0] ?>" class="item-field">
                                <?php foreach ($languages as $lang): ?>
                                    <option value="<?= $lang ?>"><?= $lang ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td align="right">
                            <a href="#cansel" class="page-title-action button-cansel">Закрыть без сохранения</a>
                            <a href="#ok" class="page-title-action button-primary button-ok">Сохранить</a>
                            <input type="hidden" name="id" value="0"/>
                        </td>
                    </tr>
                </table>

            </td>

        </tr>

        </tbody>

    </table>

    <input type="hidden" name="table" value="advantages"/>

</div>