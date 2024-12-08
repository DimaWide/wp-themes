<?php


$image   = get_the_post_thumbnail($post->ID, 'image-size-12');
$tags    = get_the_terms($post->ID, 'post_tag');
$primary = wcl_get_primary_cat();

$stories = get_field('pages', 'option');
$stories = $stories['stories'];


$mo_has_image = '';
if (empty($image)) {
    $mo_has_image = 'mo-has-image';
}
?>
<div class="wcl-single-banner <?php echo $mo_has_image; ?>">
    <div class="data-container">
        <div class="data-row">
            <div class="data-col">
                <?php if (!empty($image)) : ?>
                    <div class="data-img">
                        <?php echo $image; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-col">
                <div class="data-a">
                    <?php if (!empty($tags)) : ?>
                        <div class="data-tags">
                            <?php foreach ($tags as $key => $tag) : ?>
                                <?php
                                if ($key > 3) {
                                    break;
                                }
                                ?>
                                <div class="data-tags-item">
                                    <a href="<?php echo get_permalink($stories) . $tag->slug; ?>" class="wcl-link-cat" data-id="<?php echo $tag->slug; ?>">
                                        <?php echo $tag->name; ?>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <h1 class="data-title">
                        <?php echo get_the_title(); ?>
                    </h1>

                    <?php if (!empty($primary)) : ?>
                        <?php
                        $cat  = get_term_by('id', $primary, 'category');
                        $name = get_field('name', 'term_' . $cat->term_id);
                        ?>
                        <div class="data-cat">
                            <a href="<?php echo get_term_link((int)$cat->term_id); ?>" data-id="<?php echo $cat->slug; ?>">
                                <?php if (!empty($name)) : ?>
                                    <?php echo 'All ' . $name; ?>
                                <?php else : ?>
                                    <?php echo 'All ' . $cat->name; ?>
                                <?php endif; ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>