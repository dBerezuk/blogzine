<!-- =======================
Footer START -->
<footer class="pb-0">
    <div class="container">
        <hr>
        <!-- Widgets START -->
        <div class="row pt-5">
            <!-- Footer Widget -->
            <div class="col-md-6 col-lg-4 mb-4">
                <img class="light-mode-item" src="<?php the_field('logo-dark', 16) ?>" alt="logo">
                <img class="dark-mode-item" src="<?php the_field('logo-light', 16) ?>" alt="logo">
                <p class="mt-3"><?= get_field('footer-text', 16); ?></p>
                <div class="mt-4"><?= get_field('footer-copyright-text', 16); ?></div>
            </div>

            <!-- Footer Widget -->
            <div class="col-md-6 col-lg-3 mb-4">
                <h5 class="mb-4"><?= get_field('footer-navigation-title', 16); ?></h5>
                <div class="row">
                    <div class="col-6">
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'footer-menu-page',
                            'container' => 'ul',
                            'menu_class' => 'nav flex-column',
                        ]);
                        ?>
                    </div>
                    <div class="col-6">
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'footer-menu-platform',
                            'container' => 'ul',
                            'menu_class' => 'nav flex-column',
                        ]);
                        ?>
                    </div>
                </div>
            </div>

            <!-- Footer Widget -->
            <div class="col-sm-6 col-lg-3 mb-4">
                <h5 class="mb-4"><?= get_field('footer-category-title', 16); ?></h5>
                <ul class="list-inline">
                    <?php
                    $categoryAll = get_categories([
                        'taxonomy' => 'category',
                        'type' => 'post',
                        'child_of' => 4,
                        'order' => 'DESC'
                    ]);
                    $categoryColors = ['btn-primary-soft','btn-warning-soft','btn-success-soft','btn-danger-soft','btn-info-soft'];
                    foreach ($categoryAll as $category){
                    $categoryColorsRandom = rand(0,count($categoryColors) - 1);
                    ?>
                        <li class="list-inline-item"><a href="<?= get_page_link(266) . '?category_id=' . $category->term_id; ?>" class="btn btn-sm <?= $categoryColors[$categoryColorsRandom]; ?>"><?= $category->name; ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>

            <!-- Footer Widget -->
            <div class="col-sm-6 col-lg-2 mb-4">
                <h5 class="mb-4"><?= get_field('footer-social-title', 16); ?></h5>
                <ul class="nav flex-column">
                    <?php
                    $social = get_field('social', 16);
                    ?>
                    <li class="nav-item"><a class="nav-link pt-0" href="<?= $social['social-facebook']['social-facebook-link']; ?>"><?= $social['social-facebook']['social-facebook-icon']; ?><span class="ms-3"><?= $social['social-facebook']['social-facebook-name']; ?></span></a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $social['social-twitter']['social-twitter-link']; ?>"><?= $social['social-twitter']['social-twitter-icon']; ?><span class="ms-3"><?= $social['social-twitter']['social-twitter-name']; ?></span></a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $social['social-linkedin']['social-linkedin-link']; ?>"><?= $social['social-linkedin']['social-linkedin-icon']; ?><span class="ms-3"><?= $social['social-linkedin']['social-linkedin-name']; ?></span></a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $social['social-youtube']['social-youtube-link']; ?>"><?= $social['social-youtube']['social-youtube-icon']; ?><span class="ms-3"><?= $social['social-youtube']['social-youtube-name']; ?></span></a></li>
                </ul>
            </div>
        </div>
        <!-- Widgets END -->
    </div>
</footer>
<!-- =======================
Footer END -->

<!-- Back to top -->
<div class="back-top"><i class="bi bi-arrow-up-short"></i></div>

<!-- =======================
JS libraries, plugins and custom scripts -->
<?php wp_footer(); ?>
</body>
</html>