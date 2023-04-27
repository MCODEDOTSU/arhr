<div class="wrap mcode-arhr mcode-arhr-partners" data-type="partners">

    <h1>Партнёры <a href="#add" class="page-title-action add-item">Добавить нового</a></h1>

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

        <?php foreach ($partners as $i => $partner): ?>

            <tr class="short-item-data">

                <td class="title column-title has-row-actions column-primary page-title">
                    <strong><?= $partner['name'] ?></strong>
                    <div class="row-actions">
                        <span class="edit"><a data-id="<?= $partner['id'] ?>" href="#edit" aria-label="Редактировать «<?= $partner['name'] ?>»">Изменить</a> | </span>
                        <span class="delete"><a data-id="<?= $partner['id'] ?>" href="#delete" aria-label="Удалить «<?= $partner['name'] ?>»">Удалить</a></span>
                    </div>
                </td>
                <td class="title column-title"><?= $partner['description'] ?></td>
                <td class="title column-title"><?= $partner['lang'] ?></td>
                <td class="title column-title">
                    <?php if ($partner['is_published']): ?>
                        <span class="deactivate"><a data-id="<?= $partner['id'] ?>" href="#deactivate" aria-label="Деактивировать «<?= $partner['name'] ?>»">Деактивировать</a></span>
                    <?php else: ?>
                        <span class="activate"><a data-id="<?= $partner['id'] ?>" href="#activate" aria-label="Активировать «<?= $partner['name'] ?>»">Активировать</a></span>
                    <?php endif; ?>
                </td>

            </tr>

            <tr class="item-dialog" id="item-dialog-<?= $partner['id'] ?>">

                <td class="title column-title has-row-actions column-primary page-title" colspan="3">

                    <table width="100%" class="wp-list-table widefat fixed striped posts item-data">
                        <tr>
                            <td rowspan="3" class="item-image-container">

                                <div class="image-container-list">

                                    <?php if (!empty($partner['image'])): ?>

                                        <?php $url = wp_get_attachment_url($partner['image']); ?>

                                        <div class="image-container image">
                                            <img src="<?= $url ?>" class="item-image"/>
                                            <button class="delete-image page-title-action">Удалить</button>
                                        </div>

                                    <?php endif; ?>
                                </div>

                                <div class="add-image page-title-action">Выбрать</div>

                                <input class="images-text-list item-field" name="image" type="hidden" value="<?= $partner['image'] ?>" data-save="<?= $partner['image'] ?>"  />
                                <input name="photo-url" class="image-url" type="hidden" value="<?= $url ?>"  />

                            </td>
                            <td>Наименование: *</td>
                            <td class="input">
                                <input type="text" name="name" value="<?= $partner['name'] ?>" data-save="<?= $partner['name'] ?>" class="item-field" />
                            </td>
                        </tr>
                        <tr>
                            <td>Адрес страницы:</td>
                            <td class="input">
                                <input type="text" name="url" value="<?= $partner['url'] ?>" data-save="<?= $partner['url'] ?>"  class="item-field" />
                            </td>
                        </tr>
                        <tr>
                            <td>Описание:</td>
                            <td class="input">
                                <textarea name="description" data-save="<?= $partner['description'] ?>" class="item-field"><?= $partner['description'] ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Язык:</td>
                            <td class="input">
                                <select name="lang" data-save="<?= $partner['lang'] ?>" class="item-field">
                                    <?php foreach ($languages as $lang): ?>
                                        <option value="<?= $lang ?>" <?= selected($partner['lang'], $lang); ?>><?= $lang ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td align="right">
                                <a href="#cansel" class="page-title-action button-cansel">Закрыть без сохранения</a>
                                <a href="#ok" class="page-title-action button-primary button-ok">Сохранить</a>
                                <input type="hidden" name="id" value="<?= $partner['id'] ?>"/>
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
                        <td>Адрес страницы:</td>
                        <td class="input">
                            <input type="text" name="url" data-save=""  class="item-field" />
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

    <input type="hidden" name="table" value="partners"/>

</div>