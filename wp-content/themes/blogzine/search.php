<?php
$s = get_query_var('s');
if($s == ''){
    header('Location: /');
}

get_header();

?>

<!-- =======================
Inner intro START -->
<section class="pt-4">
	<div class="container">
		<div class="row">
      <div class="col-lg-9 mx-auto text-center py-5">
          <span><?= get_field('search-result-name',16); ?></span>
          <h2 class="display-5"><?= $s; ?></h2>
          <?php
          $query = new WP_Query( array(
              'posts_per_page' => 4,
              's' => $s
          ) );
          ?>
          <span class="lead"><?= padeg_wplife(['статья','статьи','статей'],$query->found_posts); ?></span>
          <!-- Search -->
          <div class="row">
            <div class="col-sm-8 col-md-6 col-lg-5 mx-auto">
              <form class="input-group mt-4" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
                  <input class="form-control form-control-lg border-success" required type="search" placeholder="<?= $s; ?>" name="s" id="s" />
                  <input class="btn btn-success btn-lg m-0" type="submit" id="searchsubmit" value="<?= get_field('subscribe', 16)['subscribe-form-btn']; ?>" />
              </form>
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
	<div class="container">
		<div class="row">
			<!-- Main Post START -->
			<div class="col-lg-9 mx-auto">
				<!-- Card item START -->
                <?php
                $colorArray = ['text-bg-danger','text-bg-warning','text-bg-success','bg-primary'];
                $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
                $query = new WP_Query( array(
                    'posts_per_page' => 4,
                    'post_type' => 'post',
                    'child_of' => 4,
                    's' => $s,
                    'suppress_filters' => true,
                    'paged' => $paged,
                ) );
                if ( $query->have_posts() ) :
                    while ( $query->have_posts() ) :
                        $query->the_post();
                        $postCategory = get_the_category(get_the_id());
                ?>
				<div class="card border rounded-3 up-hover p-4 mb-4">
					<div class="row g-3">
						<div class="col-sm-9">
							<!-- Categories -->
                            <?php
                            foreach ($postCategory as $item){
                                ?>
                                <a href="<?= get_page_link(266) . '?category_id=' . $item->term_id; ?>" class="z-index-99 position-relative badge <?= $colorArray[rand(0,count($colorArray) - 1)]; ?> mb-2"><i class="fas fa-circle me-2 small fw-bold"></i><?= $item->name; ?></a>
                                <?php
                            }
                            ?>
							<!-- Title -->
							<h3 class="card-title">
								<a href="<?= get_the_permalink(); ?>" class="btn-link text-reset stretched-link text-cut text-cut-2"><?= get_the_title(); ?></a>
							</h3>
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
						<!-- Image -->
						<div class="col-sm-3">
                            <?= get_the_post_thumbnail(null,'large',['class' => 'rounded-3']) ?>
						</div>
					</div>
				</div>
				<!-- Card item END -->
                <?php endwhile; wp_reset_postdata(); ?>

                <nav class="my-5" aria-label="navigation">
                    <!-- Load more -->
                    <?php
                    $pageIndexNum = max( 1, get_query_var( 'page' ) );
                    $pageAllNum = $query->max_num_pages;
                    $links_data = kama_paginate_links_data( [
                        'total'    => $pageAllNum,
                        'current'  => $pageIndexNum,
                        'url_base' => '?s=' . $s . '&page={pagenum}',
                        'mid_size' => 2,
                        'prev_next' => True,
                        'prev_text'    => __('« Previous'),
                        'next_text'    => __('Next »'),
                    ] );
                    if( $links_data ){
                        ?>

                        <ul class="pagination d-inline-block d-md-flex justify-content-center">
                            <li class="page-item <?= $pageIndexNum == 1 ? 'disabled' : ''; ?>">
                                <a class="page-link" href="<?= "?s=" . $s . "&page=" . $pageIndexNum - 1 ?>" tabindex="-1" aria-disabled="true">Назад</a>
                            </li>
                            <?php foreach( $links_data as $link ) { ?>
                                <li class="page-item <?= $link->is_current ? 'disabled active' : ($link->link_text == '…' ? 'disabled' : ''); ?>">
                                    <a class="page-link" href="<?php esc_attr_e( $link->url ) ?>"><?php _e( $link->link_text ) ?></a>
                                </li>
                            <?php } ?>
                            <li class="page-item <?= $pageIndexNum == $pageAllNum ? 'disabled' : ''; ?>">
                                <a class="page-link" href="<?= "?s=" . $s . "&page=" . $pageIndexNum + 1 ?>">Далее</a>
                            </li>
                        </ul>

                        <?php
                    }
                    ?>
                </nav>
                <?php endif; ?>
			</div>
			<!-- Main Post END -->
		</div> <!-- Row end -->
	</div>
</section>
<?php get_footer(); ?>
