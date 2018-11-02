<?= $this->render('layout/header'); ?>
<?= $this->render('layout/single_header', ['id' => $post->ID]); ?>
<main class="single col-offset-4 col-16 col-s-offset-2 col-s-20 col-xs-offset-1 col-xs-22">

<div class="blog_image col-8  col-m-offset-2 col-m-20 col-s-offset-2 col-s-20  col-xs-22" style="background-image:
    url('<?= get_field('blog_image', $blog->ID); ?>');">
</div>
<div class="blog_text col-offset-2 col-12 col-m-offset-2 col-m-20 col-s-offset-2 col-s-20 col-xs-22">
        <h1><?= get_the_title($blog->ID) ?></h1>
        <p><?= get_the_content($blog->ID) ?></p>
</div>
    

</main>
<?= $this->render('layout/frontpage_footer', ['id' => $post->ID]); ?>
<?= $this->render('layout/footer'); ?>