<?= $this->render('layout/header'); ?>
<?= $this->render('layout/single_header', ['id' => $post->ID]); ?>
<main class="single col-offset-4 col-16 col-s-offset-2 col-s-20 col-xs-offset-1 col-xs-22">
<div class="placeholder">
    <h1>placeholder sivu.</h1>
</div>

</main>
<?= $this->render('layout/frontpage_footer', ['id' => $post->ID]); ?>
<?= $this->render('layout/footer'); ?>