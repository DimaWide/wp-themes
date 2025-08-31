<?php

$title = get_field('title');

$group_1             = get_field('group_1');
$group_1_title       = $group_1['title'];
$group_1_description = $group_1['description'];

$group_2            = get_field('group_2');
$group_2_title      = $group_2['title'];
$group_2_note       = $group_2['note'];
?>
<!-- acf-11-instalation -->
<div class="acf-11-instalation">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <div class="data-b1 data-inner mod-one">
                    <?php if (!empty($group_1_title)): ?>
                        <h2 class="data-b1-title">
                            <?php echo $group_1_title; ?>
                        </h2>
                    <?php endif; ?>

                    <?php if (!empty($group_1_description)): ?>
                        <div class="data-b1-desc">
                            <?php echo $group_1_description; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="data-col">
                <div class="data-b2 data-inner mod-two">
                    <?php if (!empty($group_2_title)) : ?>
                        <h2 class="data-b2-title">
                            <?php echo $group_2_title; ?>
                        </h2>
                    <?php endif; ?>


                    <?php
                    $group_2 = get_field('group_2');
                    ?>
                    <div class="data-tabs-out">

                        <div class="data-tabs" id="tabs">
                            <?php foreach ($group_2['table'] as $index => $item): ?>
                                <button class="data-tabs-btn tablinks" onclick="openTab(event, 'tab<?php echo $index; ?>')"><?php echo $item['title']; ?></button>
                            <?php endforeach; ?>
                        </div>

                        <?php foreach ($group_2['table'] as $index => $item): ?>
                            <div id="tab<?php echo $index; ?>" class="data-tab-1 tabcontent">
                                <ul>
                                    <?php foreach ($item['list'] as $listItem): ?>
                                        <li><?php echo $listItem['item']; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <script>
                        function openTab(evt, tabName) {
                            var i, tabcontent, tablinks;
                            tabcontent = document.getElementsByClassName("tabcontent");
                            for (i = 0; i < tabcontent.length; i++) {
                                tabcontent[i].style.display = "none";
                            }

                            tablinks = document.getElementsByClassName("tablinks");
                            for (i = 0; i < tablinks.length; i++) {
                                tablinks[i].className = tablinks[i].className.replace(" active", "");
                            }

                            document.getElementById(tabName).style.display = "block";
                            evt.currentTarget.className += " active";
                        }

                        document.getElementsByClassName("tablinks")[0].click();
                    </script>





                    <?php
                    $table_count = 0;
                    ?>
                    <?php if (have_rows('group_2')) : ?>
                        <?php while (have_rows('group_2')) : the_row(); ?>
                            <?php if (have_rows('table')) : ?>
                                <?php
                                $table_count = 0;
                                while (have_rows('table')) : the_row();
                                    $table_count++;
                                ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>

                    <div class="data-b2-table-out <?php echo 'mod-' . $table_count; ?>">
                        <table class="data-b2-table">
                            <thead>
                                <tr>
                                    <?php if (have_rows('group_2')) : ?>
                                        <?php while (have_rows('group_2')) : the_row(); ?>
                                            <?php if (have_rows('table')) : ?>
                                                <?php while (have_rows('table')) : the_row(); ?>
                                                    <?php
                                                    $title = get_sub_field('title');
                                                    ?>
                                                    <th>
                                                        <?php echo $title; ?>
                                                    </th>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </tr>
                            </thead>

                            <?php
                            $teslas = [];


                            if (have_rows('group_2')) :
                                while (have_rows('group_2')) : the_row();
                                    if (have_rows('table')) :
                                        while (have_rows('table')) : the_row();
                                            $title = get_sub_field('title');
                                            if (!isset($teslas[$title])) {
                                                $teslas[$title] = [];
                                            }

                                            if (have_rows('list')) :
                                                while (have_rows('list')) : the_row();
                                                    $item = get_sub_field('item');
                                                    if ($item) {
                                                        $teslas[$title][] = $item;
                                                    }
                                                endwhile;
                                            endif;
                                        endwhile;
                                    endif;
                                endwhile;
                            endif;

                            $max_length = max(array_map('count', $teslas));
                            foreach ($teslas as &$tesla) {
                                $tesla = array_pad($tesla, $max_length, '');
                            }
                            ?>
                            <tbody>
                                <?php for ($i = 0; $i < $max_length; $i++) : ?>
                                    <tr>
                                        <?php foreach ($teslas as $title => $items): ?>
                                            <td><?php echo esc_html($items[$i]); ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="data-b2-link">
                        <a href="#" class="cmp-button mod-red generate-pdf">download PDF </a>
                        <a href="#" class="cmp-button mod-red generate-pdf">Share specs </a>
                    </div>

                    <?php if (!empty($group_2_note)) : ?>
                        <div class="data-b2-note">
                            <?php echo $group_2_note; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>






<div class="acf-11-instalation-2">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <div class="data-sidebar">
                    <div class="data-sidebar-title">
                        INSTALLATIONS
                    </div>

                    <div class="data-cats-out">
                        <div class="data-cats faq-tab-buttons">
                            <?php if (have_rows('list')) : ?>
                                <?php while (have_rows('list')) : the_row(); ?>
                                    <?php
                                    $name = get_sub_field('name');
                                    ?>
                                    <div class="data-cats-item">
                                        <button
                                            class="data-cats-item-btn cmp-button faq-tab-button <?php echo $name === 'SX-2 / TSX-2' ? 'active' : ''; ?>"
                                            data-tab="<?php echo esc_attr($name); ?>">
                                            <?php echo ucfirst($name);
                                            ?>
                                        </button>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="data-col">
                <div class="data-tabs faq-tab-content">

                    <?php if (have_rows('list')) : ?>
                        <?php while (have_rows('list')) : the_row(); ?>
                            <?php
                            $name = get_sub_field('name');
                            $content = get_sub_field('content');
                            ?>
                            <div
                                class="data-tab faq-tab-panel <?php echo $name === 'SX-2 / TSX-2' ? 'active' : ''; ?>"
                                id="tab-<?php echo esc_attr($name); ?>">
                                <?php
                                $index = 1;
                                ?>
                                <div class="data-tab-inner">
                                    <div class="data-tab-title">
                                        <?php if (!empty($name)) : ?>
                                            <h2 class="data-tab-title">
                                                INSTALLATION OF <?php echo $name; ?>
                                            </h2>
                                        <?php endif; ?>
                                    </div>

                                    <?php if (!empty($content)) : ?>
                                        <div class="data-tab-content">
                                            <?php echo $content; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>