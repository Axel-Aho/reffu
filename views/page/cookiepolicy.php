<?= $this->render('layout/header'); ?>
<?php if( isset( $content ) ): ?>
	<?= $content ?>
<?php endif; ?>
<?= $this->render('layout/footer'); ?>