<?php
/*
Template Name: Home
*/
?>
<?php
get_header();
?>
<!-- **************** MAIN CONTENT START **************** -->
<main>
<!-- =======================
Trending START -->
<?php
$quotes = CFS()->get('quotes-box-text-all');
if($quotes > 0){
?>
<section class="py-2">
	<div class="container">
		<div class="row g-0">
			<div class="col-12 bg-primary bg-opacity-10 p-2 rounded">
				<div class="d-sm-flex align-items-center text-center text-sm-start">
					<!-- Title -->
					<div class="me-3">
						<span class="badge bg-primary p-2 px-3"><?= CFS()->get('quotes-box-title') ?></span>
					</div>
					<!-- Slider -->
					<div class="tiny-slider arrow-end arrow-xs arrow-white arrow-round arrow-md-none">
						<div class="tiny-slider-inner" data-autoplay="true" data-hoverpause="true" data-gutter="0" data-arrow="true" data-dots="false" data-items="1">
							<!-- Slider items -->
                            <?php
                            foreach ($quotes as $item){
                            ?>
							<div class="text-reset"><?= $item['quotes-box-text'] ?></div>
                            <?php
                            }
                            ?>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- Row END -->
	</div>
</section>
<?php
}
//массив цветов
$colorArray = ['text-bg-danger','text-bg-warning','text-bg-success','bg-primary'];
?>
<!-- =======================
Trending END -->

<!-- =======================
Main hero START -->
<section class="pt-4 pb-0 card-grid">
	<div class="container">
		<div class="row g-4">
			<!-- Left big card -->
			<div class="col-lg-6">
                <?php
                $postOne = get_posts([
                    'numberposts' => 1,
                    'suppress_filters' => true,
                ]);
                foreach ($postOne as $post){
                    setup_postdata($post);
                    $postCategory = get_the_category(get_the_id());
                ?>
				<div class="card card-overlay-bottom card-grid-lg card-bg-scale" style="background-image:url(<?= get_the_post_thumbnail_url(); ?>); background-position: center; background-size: cover;">
					<!-- Card featured -->
					<span class="card-featured" title="Featured post"><i class="fas fa-star"></i></span>
					<!-- Card Image overlay -->
					<div class="card-img-overlay d-flex align-items-center p-3 p-sm-4">
						<div class="w-100 mt-auto">
							<!-- Card category -->
                            <?php
                            foreach ($postCategory as $item){
                            ?>
							    <a href="<?= get_page_link(266) . '?category_id=' . $item->term_id; ?>" class="badge mb-2 <?= $colorArray[rand(0,count($colorArray) - 1)]; ?> position-relative z-index-99"><i class="fas fa-circle me-2 small fw-bold"></i><?= $item->name ?></a>
                            <?php
                            }
                            ?>
							<!-- Card title -->
							<h2 class="text-white h1"><a href="<?= get_the_permalink() ?>" class="btn-link stretched-link text-reset text-cut text-cut-2"><?= get_the_title(); ?></a></h2>
							<p class="text-white text-cut text-cut-3"><?= get_the_excerpt(); ?></p>
							<!-- Card info -->
							<ul class="nav nav-divider text-white-force align-items-center d-none d-sm-inline-block">
								<li class="nav-item">
									<div class="nav-link">
										<div class="d-flex align-items-center text-white position-relative">
											<div class="avatar avatar-sm">
												<?= get_avatar(get_the_author_meta('ID'),'','','',['class' => 'avatar-img rounded-circle']); ?>
											</div>
											<span class="ms-3"><a href="<?= get_page_link(277) . '?author_id=' . get_the_author_meta('ID'); ?>" class="stretched-link text-reset btn-link"><?= get_the_author(); ?></a></span>
										</div>
									</div>
								</li>
								<li class="nav-item"><?= get_the_date('M d, Y');  ?></li>
								<li class="nav-item"><?= get_reading_time(get_the_content()); ?></li>
							</ul>
						</div>
					</div>
				</div>
                <?php
                }
                wp_reset_postdata();
                ?>
			</div>
			<!-- Right small cards -->
			<div class="col-lg-6">
				<div class="row g-4">
					<!-- Card item START -->
					<div class="col-12">
                        <?php
                        $postTwo = get_posts([
                            'numberposts' => 1,
                            'offset' => 1,
                            'suppress_filters' => true,
                        ]);
                        foreach ($postTwo as $post){
                        setup_postdata($post);
                        $postCategory = get_the_category(get_the_id());
                        ?>
						<div class="card card-overlay-bottom card-grid-sm card-bg-scale" style="background-image:url(<?= get_the_post_thumbnail_url(); ?>); background-position: center; background-size: cover;">
							<!-- Card Image -->
							<!-- Card Image overlay -->
							<div class="card-img-overlay d-flex align-items-center p-3 p-sm-4">
								<div class="w-100 mt-auto">
									<!-- Card category -->
                                    <?php
                                    foreach ($postCategory as $item){
                                        ?>
                                        <a href="<?= get_page_link(266) . '?category_id=' . $item->term_id; ?>" class="badge mb-2 <?= $colorArray[rand(0,count($colorArray) - 1)]; ?> position-relative z-index-99"><i class="fas fa-circle me-2 small fw-bold"></i><?= $item->name ?></a>
                                    <?php
                                    }
                                    ?>
                                    <!-- Card title -->
									<h4 class="text-white"><a href="<?= get_the_permalink(); ?>" class="btn-link stretched-link text-reset text-cut text-cut-2"><?= get_the_title(); ?></a></h4>
									<!-- Card info -->
									<ul class="nav nav-divider text-white-force align-items-center d-none d-sm-inline-block">
										<li class="nav-item position-relative">
											<div class="nav-link"><a href="<?= get_page_link(277) . '?author_id=' . get_the_author_meta('ID'); ?>" class="stretched-link text-reset btn-link"><?= get_the_author(); ?></a>
											</div>
										</li>
										<li class="nav-item"><?= get_the_date('M d, Y');  ?></li>
									</ul>
								</div>
							</div>
						</div>
                        <?php
                        }
                        wp_reset_postdata();
                        ?>
					</div>
					<!-- Card item END -->
                    <?php
                    $posThree = get_posts([
                        'numberposts' => 2,
                        'offset' => 2,
                        'suppress_filters' => true,
                    ]);
                    foreach ($posThree as $post){
                    setup_postdata($post);
                    $postCategory = get_the_category(get_the_id());
                    ?>
                    <!-- Card item START -->
					<div class="col-md-6">
						<div class="card card-overlay-bottom card-grid-sm card-bg-scale" style="background-image:url(<?= get_the_post_thumbnail_url(); ?>); background-position: center; background-size: cover;">
							<!-- Card Image overlay -->
							<div class="card-img-overlay d-flex align-items-center p-3 p-sm-4">
								<div class="w-100 mt-auto">
									<!-- Card category -->
                                    <?php
                                    foreach ($postCategory as $item){
                                        ?>
                                        <a href="<?= get_page_link(266) . '?category_id=' . $item->term_id; ?>" class="badge mb-2 <?= $colorArray[rand(0,count($colorArray) - 1)]; ?> position-relative z-index-99"><i class="fas fa-circle me-2 small fw-bold"></i><?= $item->name ?></a>
                                    <?php
                                    }
                                    ?>
									<!-- Card title -->
									<h4 class="text-white"><a href="<?= get_the_permalink(); ?>" class="btn-link stretched-link text-reset text-cut text-cut-2"><?= get_the_title(); ?></a></h4>
									<!-- Card info -->
									<ul class="nav nav-divider text-white-force align-items-center d-none d-sm-inline-block">
										<li class="nav-item position-relative">
											<div class="nav-link"><a href="<?= get_page_link(277) . '?author_id=' . get_the_author_meta('ID'); ?>" class="stretched-link text-reset btn-link"><?= get_the_author(); ?></a>
											</div>
										</li>
										<li class="nav-item"><?= get_the_date('M d, Y');  ?></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
                    <!-- Card item END -->
                    <?php
                    }
                    wp_reset_postdata();
                    ?>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- =======================
Main hero END -->

<!-- =======================
Main content START -->
<section class="position-relative">
	<div class="container" data-sticky-container>
		<div class="row">
			<!-- Main Post START -->
			<div class="col-lg-9">
				<!-- Title -->
				<div class="mb-4">
					<h2 class="m-0">
                        <?php
                        echo CFS()->get('articles-title-icon');
                        echo CFS()->get('articles-title');
                        ?>
                    </h2>
					<p><?= CFS()->get('articles-text'); ?></p>
				</div>
                <?php
                $btnLoadMoreTitle = get_field('btn-load-more-title',16);
                $btnLoadMoreIcon = get_field('btn-load-more-icon',16);
                $btnLoadMoreLoading = get_field('btn-load-more-title-loading',16);
                echo do_shortcode('[ajax_load_more posts_per_page="6" scroll="false" container_type="div" transition_container_classes="row gy-4" post_type="post" button_label="' . $btnLoadMoreTitle . esc_html($btnLoadMoreIcon) . '" button_loading_label="' . $btnLoadMoreLoading . esc_html($btnLoadMoreIcon) . '"]');
                ?>
			</div>
			<!-- Main Post END -->
            <?php
            get_template_part('menu-box');
            ?>
		</div> <!-- Row end -->
	</div>
</section>
<!-- =======================
Main content END -->

<!-- Divider -->
<div class="container"><div class="border-bottom border-primary border-2 opacity-1"></div></div>

<!-- =======================
Section START -->
<section class="pt-4">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Title -->
				<div class="mb-4 d-md-flex justify-content-between align-items-center">
					<h2 class="m-0"><?= CFS()->get('articles-bottom-title-icon') . ' ' . CFS()->get('articles-bottom-title') ?></h2>
				</div>
				<div class="tiny-slider arrow-hover arrow-blur arrow-dark arrow-round">
					<div class="tiny-slider-inner" data-autoplay="true" data-hoverpause="true" data-gutter="24" data-arrow="true" data-dots="false" data-items-xl="4" data-items-md="3" data-items-sm="2" data-items-xs="1">
                        <?php
                        $posts = query_posts(
                            [
                                'post_type' => 'post',
                                'meta_query' => [
                                    'relation' => 'OR',
                                    [
                                       'key' => 'views',
                                       'compare' => 'EXISTS',
                                    ],
                                    [
                                       'key' => 'views',
                                       'compare' => 'NOT EXISTS',
                                    ]
                                ],
                                'orderby' => 'meta_value_num',
                                'suppress_filters' => true
                            ]
                        );
                        foreach ($posts as $post){
                        setup_postdata($post);
                        $postCategory = get_the_category(get_the_id());
                        ?>
						<!-- Card item START -->
						<div class="card">
							<!-- Card img -->
							<div class="position-relative">
                                <?= get_the_post_thumbnail(null,'large',['class' => 'card-img']) ?>
								<div class="card-img-overlay d-flex align-items-start flex-column p-3">
									<!-- Card overlay bottom -->
                                    <div class="w-100 mt-auto">
                                    <?php
                                    foreach ($postCategory as $item){
                                    ?>
										<a href="<?= get_page_link(266) . '?category_id=' . $item->term_id; ?>" class="badge <?= $colorArray[rand(0,count($colorArray) - 1)]; ?> mb-2"><i class="fas fa-circle me-2 small fw-bold"></i><?= $item->name; ?></a>
                                    <?php
                                    }
                                    ?>
                                    </div>
								</div>
							</div>
							<div class="card-body px-0 pt-3">
								<h5 class="card-title"><a href="<?= get_the_permalink(); ?>" class="btn-link text-reset fw-bold"><?= get_the_title(); ?></a></h5>
								<!-- Card info -->
								<ul class="nav nav-divider align-items-center d-none d-sm-inline-block">
									<li class="nav-item">
										<div class="nav-link">
											<div class="d-flex align-items-center position-relative">
												<div class="avatar avatar-xs">
                                                    <?= get_avatar(get_the_author_meta('ID'),'','','',['class' => 'avatar-img rounded-circle']); ?>
												</div>
												<span class="ms-3"><a href="<?= get_page_link(277) . '?author_id=' . get_the_author_meta('ID'); ?>" class="stretched-link text-reset btn-link"><?= get_the_author(); ?></a></span>
											</div>
										</div>
									</li>
									<li class="nav-item"><?= get_the_date('M d, Y'); ?></li>
								</ul>
							</div>
						</div>
                        <?php
                        }
                        wp_reset_postdata();
                        ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- =======================
Section END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->
<?php
get_footer();
?>