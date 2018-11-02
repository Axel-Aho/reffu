<div class="pie_wrapper">
    <div id="chartContainer"></div>
    <div id="pie_info">
        <?php $chart = get_post(get_field('chart_link', $id))?>
            <?= get_the_title($chart); ?>
            <?php if( have_rows('charts', $chart) ): ?>
                    <ul class="row">
                        <?php $i = 1;
                        while( have_rows('charts', $chart) ): the_row();
                            $name = get_sub_field('name');
                            $percent = get_sub_field('percent'); ?>
                            <li class="slide" id="<?= $i ?>" value="<?= $percent; ?>" name="<?= $name; ?>">
                                <p><?php echo $name; ?> <?php echo $percent; ?>%<p>
                            </li>
                            <?php $i++;
                        endwhile; ?>
                    </ul>
                <?php endif; ?> 
    </div>
</div>