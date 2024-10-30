<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
    <title><?= is_404() ? get_field('error-404-name-page',16) : (is_page_template('category-posts.php') ? get_the_title() . ' - ' . mb_strtolower(get_category($_GET['category_id'])->name) : (is_page_template('author.php') ? get_the_title() . ' - ' . get_userdata($_GET['author_id'])->display_name : (is_search() ? get_field('search-result-name',16) . ' - ' . $s : get_the_title() ) ) ); ?></title>

    <!-- Meta Tags -->
    <meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="">
    <meta name="description" content="">

    <!-- Dark mode -->
    <script>
        const storedTheme = localStorage.getItem('theme')

        const getPreferredTheme = () => {
            if (storedTheme) {
                return storedTheme
            }
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
        }

        const setTheme = function (theme) {
            if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.setAttribute('data-bs-theme', 'dark')
            } else {
                document.documentElement.setAttribute('data-bs-theme', theme)
            }
        }

        setTheme(getPreferredTheme())

        window.addEventListener('DOMContentLoaded', () => {
            var el = document.querySelector('.theme-icon-active');
            if(el != 'undefined' && el != null) {
                const showActiveTheme = theme => {
                    const activeThemeIcon = document.querySelector('.theme-icon-active use')
                    const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
                    const svgOfActiveBtn = btnToActive.querySelector('.mode-switch use').getAttribute('href')

                    document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
                        element.classList.remove('active')
                    })

                    btnToActive.classList.add('active')
                    activeThemeIcon.setAttribute('href', svgOfActiveBtn)
                }

                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                    if (storedTheme !== 'light' || storedTheme !== 'dark') {
                        setTheme(getPreferredTheme())
                    }
                })

                showActiveTheme(getPreferredTheme())

                document.querySelectorAll('[data-bs-theme-value]')
                    .forEach(toggle => {
                        toggle.addEventListener('click', () => {
                            const theme = toggle.getAttribute('data-bs-theme-value')
                            localStorage.setItem('theme', theme)
                            setTheme(theme)
                            showActiveTheme(theme)
                        })
                    })

            }
        })

    </script>

    <!-- Favicon -->
    <?php
    wp_site_icon();

    wp_head();
    ?>
</head>

<body>
<!-- =======================
Header START -->
<header class="navbar-light navbar-sticky header-static">
    <div class="navbar-top d-none d-lg-block small">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center my-2">
                <!-- Top bar left -->
                <?php
                wp_nav_menu([
                    'theme_location' => 'header-top-menu',
                    'container' => 'ul',
                    'menu_class' => 'nav',
                ]);
                ?>
                <!-- Top bar right -->
                <div class="d-flex align-items-center">
                    <!-- Font size accessibility START -->
                    <div class="btn-group me-3" role="group" aria-label="font size changer">
                        <?php
                        $sizeText = get_field('size-text', 16);
                        ?>
                        <input type="radio" class="btn-check" name="fntradio" id="font-sm">
                        <label class="btn btn-xs btn-outline-primary mb-0" for="font-sm"><?= $sizeText['size-text-value-1']; ?></label>

                        <input type="radio" class="btn-check" name="fntradio" id="font-default" checked>
                        <label class="btn btn-xs btn-outline-primary mb-0" for="font-default"><?= $sizeText['size-text-value-2']; ?></label>

                        <input type="radio" class="btn-check" name="fntradio" id="font-lg">
                        <label class="btn btn-xs btn-outline-primary mb-0" for="font-lg"><?= $sizeText['size-text-value-3']; ?></label>
                    </div>

                    <!-- Dark mode options START -->
                    <div class="nav-item dropdown mx-2">
                        <!-- Switch button -->
                        <button class="modeswitch" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" data-bs-display="static">
                            <svg class="theme-icon-active"><use href="#"></use></svg>
                        </button>
                        <!-- Dropdown items -->
                        <ul class="dropdown-menu min-w-auto dropdown-menu-end" aria-labelledby="bd-theme">
                            <?php
                            $themes = get_field('themes', 16);
                            ?>
                            <li class="mb-1">
                                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light">
                                    <svg width="16" height="16" fill="currentColor" class="bi bi-brightness-high-fill fa-fw mode-switch me-1" viewBox="0 0 16 16">
                                        <path d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
                                        <use href="#"></use>
                                    </svg><?= $themes['themes-title-1']; ?>
                                </button>
                            </li>
                            <li class="mb-1">
                                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-moon-stars-fill fa-fw mode-switch me-1" viewBox="0 0 16 16">
                                        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
                                        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
                                        <use href="#"></use>
                                    </svg><?= $themes['themes-title-2']; ?>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-half fa-fw mode-switch me-1" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
                                        <use href="#"></use>
                                    </svg><?= $themes['themes-title-3']; ?>
                                </button>
                            </li>
                        </ul>
                    </div>
                    <!-- Dark mode options END -->

                    <ul class="nav">
                        <?php
                        $social = get_field('social', 16);
                        ?>
                        <li class="nav-item">
                            <a class="nav-link px-2 fs-5" href="<?= $social['social-facebook']['social-facebook-link']; ?>"><?= $social['social-facebook']['social-facebook-icon']; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-2 fs-5" href="<?= $social['social-twitter']['social-twitter-link']; ?>"><?= $social['social-twitter']['social-twitter-icon']; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-2 fs-5" href="<?= $social['social-linkedin']['social-linkedin-link']; ?>"><?= $social['social-linkedin']['social-linkedin-icon']; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-2 fs-5" href="<?= $social['social-youtube']['social-youtube-link']; ?>"><?= $social['social-youtube']['social-youtube-icon']; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ps-2 pe-0 fs-5" href="<?= $social['social-vimeo']['social-vimeo-link']; ?>"><?= $social['social-vimeo']['social-vimeo-icon']; ?></a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Divider -->
            <div class="border-bottom border-2 border-primary opacity-1"></div>
        </div>
    </div>

    <!-- Logo Nav START -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo START -->
            <a class="navbar-brand" href="/">
                <img class="navbar-brand-item light-mode-item" src="<?php the_field('logo-dark', 16) ?>" alt="logo">
                <img class="navbar-brand-item dark-mode-item" src="<?php the_field('logo-light', 16) ?>" alt="logo">
            </a>
            <!-- Logo END -->

            <!-- Responsive navbar toggler -->
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="text-body h6 d-none d-sm-inline-block">Menu</span>
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbarCollapse">
                <?php
                wp_nav_menu([
                    'theme_location' => 'header-menu',
                    'container' => 'ul',
                    'menu_class' => 'navbar-nav navbar-nav-scroll mx-auto',
                    'walker' => new Walker_Nav_Menu
                ]);
                ?>
            </div>
            <!-- Main navbar END -->

            <!-- Nav right START -->
            <div class="nav flex-nowrap align-items-center">
                <!-- Nav Search -->
                <div class="nav-item dropdown dropdown-toggle-icon-none nav-search">
                    <a class="nav-link dropdown-toggle" role="button" href="#" id="navSearch" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= get_field('subscribe', 16)['subscribe-icon']; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end shadow rounded p-2" aria-labelledby="navSearch">
                        <?=
                        get_search_form();
                        ?>
                    </div>
                </div>
                <!-- Nav Button -->
                <div class="nav-item d-none d-md-block">
                    <a href="javascript:;" class="btn btn-sm btn-danger mb-0 mx-2"><?= get_field('subscribe', 16)['subscribe-btn-name']; ?></a>
                </div>
            </div>
            <!-- Nav right END -->
        </div>
    </nav>
    <!-- Logo Nav END -->
</header>
<!-- =======================
Header END -->