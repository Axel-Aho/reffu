<div class="front_header">
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
    <div class="video_area">
        <div class="text_content">
            <div class="headline">
                <h1><?= get_field('header', $id); ?></h1>
            </div>
            <div class="join_area">
                <p><?= get_field('higlight_header', $id); ?></p>
                <button href="<?= get_field('header_link', $id); ?>"><?= get_field('header_link_text', $id); ?></button>
            </div>
        </div>
        <div class="video">
            <iframe width="640" height="360" 
                src="https://www.youtube.com/embed/P5_GlAOCHyE?rel=0&amp;controls=0&amp;showinfo=0&amp;loop=1&amp;autoplay=1&amp;mute=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
            </iframe>
        </div>
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