<?= $this->render('layout/header'); ?>
<?= $this->render('layout/single_header', ['id' => $post->ID]); ?>
<main class="single col-offset-4 col-16 col-s-offset-2 col-s-20 col-xs-offset-1 col-xs-22">

<div class="article_image" style="background-image:
    url('<?= get_field('article_image', $article['article']); ?>');">
</div>
<div class="article_text">
        <h1><?= get_the_title($article['article']) ?></h1>
        <p><?= get_the_content($article['article']) ?></p>
</div>

   
</main>
<?= $this->render('layout/frontpage_footer', ['id' => $post->ID]); ?>
<?= $this->render('layout/footer'); ?>