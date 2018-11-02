<div class="single_header">
    <div class="header_area">
        <div class="logo">
            Referenssi
        </div>
        <div class="infos">
            <div class="members">
                <button><?= pll__('members_only') ?></button>
            </div>
            <div class="language">
                <?php pll_the_languages( array( 'dropdown' => 1, 'display_names_as' => 'slug' ) ); ?>
            </div>
        </div>
    </div>
    <div class="image" style="background-image:
            url('<?= ot_get_option( 'header_img', 'option'); ?>')">
        </div>
    <div class="nav_area">
        <div class="nav">
            <?php wp_nav_menu( array('theme_location' => 'header menu') ); ?>
        </div>
        <div class="links">
            <a href="<?= ot_get_option('facebook', 'option'); ?>">
                <svg role="img" aria-hidden=“true”>
                    <use xlink:href="<?= a('/images/iconpack.svg#icon-facebook'); ?>"></use>
                </svg>
            </a>
            <a href="<?= ot_get_option('twitter', 'option'); ?>">
                <svg role="img" aria-hidden=“true”>
                    <use xlink:href="<?= a('/images/iconpack.svg#icon-twitter'); ?>"></use>
                </svg>
            </a>
            <a href="">
                <svg role="img" aria-hidden=“true”>
                    <use xlink:href="<?= a('/images/iconpack.svg#icon-graduation-cap'); ?>"></use>
                </svg>
            </a>
            <a href="">
                <svg role="img" aria-hidden=“true”>
                    <use xlink:href="<?= a('/images/iconpack.svg#icon-cogs'); ?>"></use>
                </svg>
            </a>
        </div>
    </div>
</div>