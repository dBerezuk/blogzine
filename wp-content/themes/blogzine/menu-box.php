<!-- Sidebar START -->
<div class="col-lg-3 mt-5 mt-lg-0">
    <div data-sticky data-margin-top="80" data-sticky-for="767">

        <!-- Social widget START -->
<!--        <div class="row g-2">-->
<!--            <div class="col-4">-->
<!--                <a href="index.php#" class="bg-facebook rounded text-center text-white-force p-3 d-block">-->
<!--                    <i class="fab fa-facebook-square fs-5 mb-2"></i>-->
<!--                    <h6 class="m-0">1.5K</h6>-->
<!--                    <span class="small">Fans</span>-->
<!--                </a>-->
<!--            </div>-->
<!--            <div class="col-4">-->
<!--                <a href="index.php#" class="bg-instagram-gradient rounded text-center text-white-force p-3 d-block">-->
<!--                    <i class="fab fa-instagram fs-5 mb-2"></i>-->
<!--                    <h6 class="m-0">1.8M</h6>-->
<!--                    <span class="small">Followers</span>-->
<!--                </a>-->
<!--            </div>-->
<!--            <div class="col-4">-->
<!--                <a href="index.php#" class="bg-youtube rounded text-center text-white-force p-3 d-block">-->
<!--                    <i class="fab fa-youtube-square fs-5 mb-2"></i>-->
<!--                    <h6 class="m-0">22K</h6>-->
<!--                    <span class="small">Subs</span>-->
<!--                </a>-->
<!--            </div>-->
<!--        </div>-->
        <!-- Social widget END -->

        <!-- Trending topics widget START -->
        <div>
            <h4 class="mt-4 mb-3"><?= get_field('side-block-category-title',16); ?></h4>
            <!-- Category item -->
            <?php
            $categoryAll = get_categories([
                'taxonomy' => 'category',
                'type' => 'post',
                'child_of' => 4,
                'order' => 'DESC'
            ]);
            foreach ($categoryAll as $item){
                $post = get_posts(['numberposts' => 1,'category' => $item->term_id,'suppress_filters' => true]);
                $postId = wp_list_pluck($post,"ID")[0];
                wp_reset_postdata();
                ?>
                <div class="text-center mb-3 card-bg-scale position-relative overflow-hidden rounded bg-dark-overlay-4 " style="background-image:url(<?= get_the_post_thumbnail_url($postId); ?>); background-position: center left; background-size: cover;">
                    <div class="p-3">
                        <a href="<?= get_page_link(266) . '?category_id=' . $item->term_id; ?>" class="stretched-link btn-link fw-bold text-white h5"><?= $item->name ?></a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <!-- Trending topics widget END -->

        <div class="row">
            <!-- Recent post widget START -->
            <div class="col-12 col-sm-6 col-lg-12">
                <h4 class="mt-4 mb-3"><?= get_field('side-block-post-title',16); ?></h4>
                <?php
                $posts = get_posts(
                    [
                        'numberposts' => 4,
                        'suppress_filters' => true
                    ]
                );
                foreach ($posts as $post){
                    setup_postdata($post);
                    ?>
                    <!-- Recent post item -->
                    <div class="card mb-3">
                        <div class="row g-3">
                            <div class="col-4">
                                <?= get_the_post_thumbnail(null,'large',['class' => 'rounded']) ?>
                            </div>
                            <div class="col-8">
                                <h6><a href="<?= get_the_permalink(); ?>" class="btn-link stretched-link text-reset fw-bold text-cut text-cut-2"><?= get_the_title(); ?></a></h6>
                                <div class="small mt-1"><?= get_the_date('M d, Y');  ?></div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                wp_reset_postdata();
                ?>
            </div>
            <!-- Recent post widget END -->

            <!-- ADV widget START -->
            <div class="col-12 col-sm-6 col-lg-12 my-4">
                <?php
                if(get_field('advertising-image',16) && get_field('advertising-link',16) && get_field('advertising-text-title',16) && get_field('advertising-text-value',16)){
                    ?>
                    <a href="<?= get_field('advertising-link',16); ?>" class="d-block card-img-flash">
                        <img src="<?= get_field('advertising-image',16); ?>" alt="">
                    </a>
                    <div class="smaller text-end mt-2"><?= get_field('advertising-text-title',16); ?> <a href="<?= get_field('advertising-link',16); ?>" class="text-body"><u><?= get_field('advertising-text-value',16); ?></u></a></div>
                    <?php
                }
                ?>
            </div>
            <!-- ADV widget END -->
        </div>
    </div>
</div>
<!-- Sidebar END -->
