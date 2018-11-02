
    <?php if(get_field('articles', $id)) : ?>
        <div class="article_area">
            <?php foreach($articles['value'] as $article) : ?>
            
                <?php if($article['article_size'] == 1) :?>
                    <a class="col-8 col-m-12 col-s-24 col-xs-24" href="<?= get_permalink($article['article']) ?>">
                        <div class="article_box_small" style="background-image:
                            url('<?= get_field('article_image', $article['article']); ?>');">
                            <div class="shader"></div>
                            <div class="article_text">
                                <h3><?= get_the_title($article['article']) ?></h3>
                            </div>
                        </div>
                    </a> 
                <?php else : ?>
                    <a class="col-16 col-m-12 col-s-24 col-xs-24" href="<?= get_permalink($article['article']) ?>">
                        <div class="article_box_big" style="background-image:
                            url('<?= get_field('article_image', $article['article']); ?>');">
                            <div class="shader_big"></div>
                            <div class="article_text_big">
                                <h3><?= get_the_title($article['article']) ?></h3>
                            </div>
                        </div>
                    </a> 
                <?php endif ?>
            <?php endforeach ?>
        </div>
    <?php endif ?>
