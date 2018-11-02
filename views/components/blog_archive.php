<div class="row">
    <div class="blogs col-16 col-s-24 col-xs-24">
        <div class="flex_filter">
            <?php 
                if( $terms = get_terms( 'category', 'orderby=name' ) ) :
                    foreach ( $terms as $term ) : ?>
                        <button class="filters" value="<?= $term->term_id?>" name="categoryfilter"><?= $term->name ?></button>
                <?php endforeach; 
                endif; 
            ?>
        </div>

        <div class="blog_area" id="response">  
            <?php foreach ($blog as $b) : ?>
            <div class="blog_box col-12 col-l-8 col-m-24 col-s-24 col-xs-24">
            <p class="date"><?= get_the_date(); ?></p>   
                <a href="<?= get_permalink($b) ?>">
                    <div class="blog_img" style="background-image:
                        url('<?= get_field('blog_image', $b); ?>');">
                    </div>
                    <div class="blog_text">
                        <h3><?= get_the_title($b) ?></h3>
                    </div>
                    
                </a> 
            </div>  
            <?php endforeach ?>
        </div>
    </div>
    <div class="info col-8 col-s-24 col-xs-24">
        <h2><?= ot_get_option('heading', 'option'); ?></h2>
        <p><?= ot_get_option('ingress', 'option'); ?></p>
        <?php gravity_form(1, false, false, false, '', true, 12); ?>
    </div>
</div>
