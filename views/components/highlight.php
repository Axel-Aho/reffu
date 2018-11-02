<div class="highlight">
    <div class="icon">
        <svg role="img" aria-hidden=“true”>
            <use xlink:href="<?= a('/images/iconpack.svg#icon-map-marker'); ?>"></use>
        </svg>
    </div>
    <div class="content">
        <div class="text">
            <h2><?= get_field('highlight_text', $id); ?></h2>
        </div>
        <div class="link">
            <a href="<?= get_field('link', $id); ?>">
                <p><?= get_field('link_text', $id); ?></p>
            </a>
        </div>
    </div>
</div>