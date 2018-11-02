<?= $this->render('layout/header'); ?>

<?= $this->render('layout/frontpage_header', ['id' => $post->ID]); ?>
<main class="col-offset-4 col-16 col-s-offset-2 col-s-20 col-xs-offset-1 col-xs-22">

    <?= $this->render('components/highlight', ['id' => $post->ID]); ?>
    
    <?= $this->render('components/article_archive'); ?> 
    
    <?= $this->render('components/calendar'); ?>
    
    <?= $this->render('components/blog_archive', ['blog' => $blog]); ?>

    <!-- <?= $this->render('components/piechart', ['chart' => $chart]); ?> -->
    
</main>
<?= $this->render('layout/frontpage_footer', ['id' => $post->ID]); ?>
<?= $this->render('layout/footer'); ?>
