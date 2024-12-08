<?php

$description = get_field('description');

$post_date      = get_the_date('Y-m-d H:i:s');
$formatted_date = date_i18n('l, F j, Y | g:ia', strtotime($post_date));

$content           = get_the_content();
$table_of_contents = generate_post_table_of_contents($content);

$content_empty           = '';
$table_of_contents_empty = '';

if (empty($content)) {
    $content_empty = 'mod-empty-content';
}

if (empty($table_of_contents)) {
    $table_of_contents_empty = 'mod-empty-table';
}
?>
<!-- sct-2-content -->
<div class="sct-2-content <?php echo $table_of_contents_empty . ' ' . $content_empty; ?>">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <?php if (!empty($table_of_contents)): ?>
                    <div class="data-sidebar">
                        <div class="data-sidebar-item mod-table-contents">
                            <div class="data-table-contents">
                                <h3 class="data-table-contents-title data-sidebar-item-title">
                                    Table of contents
                                </h3>

                                <?php if (!empty($table_of_contents)) : ?>
                                    <?php echo $table_of_contents; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-col">
                <div class="data-content cmp-content">
                    <?php
                    $content = get_post_field('post_content', get_the_ID());
                    echo apply_filters('the_content', $content);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>