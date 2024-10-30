<?php
/*
Template Name: post-list
*/
get_header();
?>
<!-- **************** MAIN CONTENT START **************** -->
<main>

<!-- =======================
Inner intro START -->
<section class="pt-4">
	<div class="container">
		<div class="row">
      <div class="col-12">
				<div class="border p-4 text-center rounded-3">
					<h1><?= get_the_title(); ?></h1>
					<div class="mt-3" aria-label="breadcrumb">
                    <?php
                    bcn_display($return = false, $linked = true, $reverse = false, $force = false);
                    ?>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="grid-menu">
                                <ul class="nav nav-pills justify-content-center">
                                    <?php
                                    $thisPageUrl = get_page_link();
                                    ?>
                                    <li class="nav-item"> <span class="nav-link disabled ps-0 mb-0"><?= CFS()->get('all-posts-sort-title'); ?></span> </li>
                                    <li class="nav-item"> <a class="nav-link <?= isset($_GET['sort']) ? '' : 'active'; ?> mb-0" href="<?= $thisPageUrl ?>"><?= CFS()->get('all-posts-sort-btn-all-name'); ?></a></li>
                                    <?php
                                    $categoryAll = get_categories([
                                        'taxonomy' => 'category',
                                        'type' => 'post',
                                        'child_of' => 4,
                                        'order' => 'DESC'
                                    ]);
                                    foreach ($categoryAll as $item){
                                    ?>
                                    <li class="nav-item"><a class="nav-link mb-0 <?= isset($_GET['sort']) && $_GET['sort'] == $item->term_id ? 'active' : ''; ?>" href="<?= $thisPageUrl . '?sort=' . $item->term_id; ?>"><?= $item->name; ?></a></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
				</div>
      </div>
    </div>
	</div>
</section>
<!-- =======================
Inner intro END -->

<!-- =======================
Main content START -->
<section class="position-relative pt-0">
	<div class="container" data-sticky-container>
		<div class="row">
			<!-- Main Post START -->
			<div class="col-lg-9">
                <?php
                $colorArray = ['text-bg-danger','text-bg-warning','text-bg-success','bg-primary'];
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $query = new WP_Query( array(
                    'cat' => isset($_GET['sort']) ? $_GET['sort'] : null,
                    'posts_per_page' => 4,
                    'child_of' => 4,
                    'post_type' => 'post',
                    'paged' => $paged,
                ) );
                if ( $query->have_posts() ) :
                while ( $query->have_posts() ) :
                    $query->the_post();
                    $postCategory = get_the_category(get_the_id());
                ?>
				<div class="card mb-4">
					<div class="row">
						<div class="col-md-5">
                            <?= get_the_post_thumbnail(null,'large',['class' => 'rounded-3']) ?>
						</div>
						<div class="col-md-7 mt-3 mt-md-0">
                            <?php
                            foreach ($postCategory as $item){
                                ?>
                                <a href="<?= get_page_link(266) . '?category_id=' . $item->term_id; ?>" class="z-index-99 position-relative badge <?= $colorArray[rand(0,count($colorArray) - 1)]; ?> mb-2"><i class="fas fa-circle me-2 small fw-bold"></i><?= $item->name; ?></a>
                                <?php
                            }
                            ?>
							<h3><a href="<?= get_the_permalink(); ?>" class="btn-link stretched-link text-reset text-cut text-cut-2"><?= get_the_title(); ?></a></h3>
							<p class="text-cut text-cut-3"><?= get_the_excerpt(); ?></p>
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
								<li class="nav-item"><?= get_the_date('M d, Y');  ?></li>
							</ul>
						</div>
					</div>
				</div>
                <?php endwhile; wp_reset_postdata(); ?>

				<nav class="my-5" aria-label="navigation">
                    <?php
                    $pageIndexNum = max( 1, get_query_var( 'paged' ) );
                    $pageAllNum = $query->max_num_pages;
                    $links_data = kama_paginate_links_data( [
                        'total'    => $pageAllNum,
                        'current'  => $pageIndexNum,
                        'url_base' => '/all-posts/page/{pagenum}',
                        'mid_size' => 2,
                        'prev_next' => True,
                        'prev_text'    => __('« Previous'),
                        'next_text'    => __('Next »'),
                    ] );
                    if( $links_data ){
                        ?>

                        <ul class="pagination d-inline-block d-md-flex justify-content-center">
                            <li class="page-item <?= $pageIndexNum == 1 ? 'disabled' : ''; ?>">
                                <a class="page-link" href="/all-posts/page/<?= $pageIndexNum - 1 . (isset($_GET['sort']) ? '?sort=' . $_GET['sort'] : '') ?>" tabindex="-1" aria-disabled="true">Назад</a>
                            </li>
                            <?php foreach( $links_data as $link ) { ?>
                                <li class="page-item <?= $link->is_current ? 'disabled active' : ($link->link_text == '…' ? 'disabled' : ''); ?>">
                                    <a class="page-link" href="<?php esc_attr_e( $link->url . (isset($_GET['sort']) ? '?sort=' . $_GET['sort'] : '') ) ?>"><?php _e( $link->link_text ) ?></a>
                                </li>
                            <?php } ?>
                            <li class="page-item <?= $pageIndexNum == $pageAllNum ? 'disabled' : ''; ?>">
                                <a class="page-link" href="/all-posts/page/<?= $pageIndexNum + 1 . (isset($_GET['sort']) ? '?sort=' . $_GET['sort'] : '') ?>">Далее</a>
                            </li>
                        </ul>

                        <?php
                    }
                    ?>
				</nav>
                <?php endif; ?>
				<!-- Pagination END -->
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



</main>
<!-- **************** MAIN CONTENT END **************** -->

<?php
get_footer();
?>