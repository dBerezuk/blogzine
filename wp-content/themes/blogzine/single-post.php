<?php
/*
Template Name: single-post
*/
get_header();
?>
<!-- **************** MAIN CONTENT START **************** -->
<main>
<!-- =======================
Inner intro START -->
<section class="pt-2">
	<div class="container">
		<div class="row">
      <div class="col-12">
        <div class="card bg-dark-overlay-5 overflow-hidden card-bg-scale h-400 text-center" style="background-image:url(<?= get_field('post-image'); ?>); background-position: center; background-size: cover;">
          <!-- Card Image overlay -->
          <div class="card-img-overlay d-flex align-items-center p-3 p-sm-4"> 
            <div class="w-100 my-auto">
              <!-- Card category -->
              <?php
                $postCategory = get_the_category(get_the_id());
                $authorId = get_post_field('post_author', get_the_id());
                foreach ($postCategory as $item){
              ?>
              <a href="<?= get_page_link(266) . '?category_id=' . $item->term_id; ?>" class="badge text-bg-danger mb-2"><i class="fas fa-circle me-2 small fw-bold"></i><?= $item->name ?></a>
              <?php
                }
              ?>
              <!-- Card title -->
              <h2 class="text-white display-5"><?= get_the_title(); ?></h2>
              <!-- Card info -->
              <ul class="nav nav-divider text-white-force align-items-center justify-content-center">
                <li class="nav-item">
                  <div class="nav-link">
                    <div class="d-flex align-items-center text-white position-relative">
                      <div class="avatar avatar-sm">
                          <?= get_avatar($authorId,'','','',['class' => 'avatar-img rounded-circle']); ?>
                      </div>
                      <span class="ms-3"><a href="<?= get_page_link(277) . '?author_id=' . $authorId; ?>" class="stretched-link text-reset btn-link"><?= get_user_by('ID', $authorId)->display_name; ?></a></span>
                    </div>
                  </div>
                </li>
                <li class="nav-item"><?= get_the_date('M d, Y'); ?></li>
                <li class="nav-item"><?= get_reading_time(get_the_content()); ?></li>
              </ul>
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
Main START -->
<section class="pt-0">
	<div class="container position-relative" data-sticky-container>
		<div class="row">
			<!-- Main Content START -->
			<div class="col-lg-9 mb-5">
                <div class="single-content">
                    <?= get_the_content(); ?>
                </div>
				<!-- Author info START -->
				<div class="d-flex p-2 p-md-4 my-3 bg-primary bg-opacity-10 rounded align-items-center">
					<!-- Avatar -->
					<a href="<?= get_page_link(277) . '?author_id=' . $authorId; ?>">
						<div class="avatar avatar-xxl me-2 me-md-4">
                            <?= get_avatar($authorId,'','','',['class' => 'avatar-img rounded-circle']); ?>
						</div>
					</a>
					<!-- Info -->
					<div class="w-100">
						<div class="d-sm-flex align-items-center justify-content-between w-100">
							<div>
								<h4 class="m-0"><a href="<?= get_page_link(277) . '?author_id=' . $authorId; ?>"><?= get_user_by('ID', $authorId)->display_name; ?></a></h4>
								<small>Редактор <?php bloginfo('name'); ?></small>
							</div>
							<a href="<?= get_page_link(277) . '?author_id=' . $authorId; ?>" class="btn btn-xs btn-primary-soft">Посмотреть ещё статьи </a>
						</div>
						<p class="my-2"><?= get_user_by('ID', $authorId)->description; ?></p>
						<!-- Social icons -->
<!--						<ul class="nav">-->
<!--							<li class="nav-item">-->
<!--								<a class="nav-link ps-0 pe-2 fs-5" href="single-post.php#"><i class="fab fa-facebook-square"></i></a>-->
<!--							</li>-->
<!--							<li class="nav-item">-->
<!--								<a class="nav-link px-2 fs-5" href="single-post.php#"><i class="fab fa-twitter-square"></i></a>-->
<!--							</li>-->
<!--							<li class="nav-item">-->
<!--								<a class="nav-link px-2 fs-5" href="single-post.php#"><i class="fab fa-linkedin"></i></a>-->
<!--							</li>-->
<!--						</ul>-->
					</div>
				</div>
				<!-- Author info END -->
                <?php
                comments_template();
                ?>
			</div>
			<!-- Main Content END -->
			
			<!-- Right sidebar START -->
			<div class="col-lg-3">
				<div data-sticky data-margin-top="80" data-sticky-for="991">
          <!-- Categories -->
	      	<div class="row g-2">
                <h5><?= get_field('post-box-category-title',16); ?></h5>
                <?php
                    $colorArray = ['warning','info','danger','primary','success'];
                    $categoryAll = get_categories([
                        'taxonomy' => 'category',
	                    'type' => 'post',
                        'child_of' => 4,
                        'order' => 'DESC'
                        ]);
                    foreach ($categoryAll as $item){
                    $productsCategoryCount = $item->count;
                    $colorRand = $colorArray[rand(0,count($colorArray) - 1)];
                ?>
                <div class="d-flex justify-content-between align-items-center bg-<?= $colorRand; ?> bg-opacity-15 rounded p-2 position-relative">
                    <h6 class="m-0 text-<?= $colorRand; ?>"><?= $item->name; ?></h6>
                    <a href="<?= get_page_link(266) . '?category_id=' . $item->term_id; ?>" class="badge bg-<?= $colorRand; ?> text-dark stretched-link"><?= $productsCategoryCount < 10 ? 0 . $productsCategoryCount : $productsCategoryCount ; ?></a>
                </div>
                <?php
                   }
                ?>
			</div>
					
					<!-- Newsletter START -->
					<div class="bg-light p-4 mt-4 rounded-3 text-center">
						<h4><?= get_field('post-box-form-email-title',16); ?></h4>
						<form>
							<div class="mb-3">
								<input type="email" class="form-control" placeholder="Email">
							</div>
							<button type="submit" class="btn btn-primary">Подписаться</button>
						</form>
                        <div class="form-text"><?= get_field('post-box-form-email-text',16); ?></div>
					</div>
					<!-- Newsletter END -->

					<!-- Advertisement -->
					<div class="mt-4">
                        <?php
                        if(get_field('advertising-image',16) && get_field('advertising-link',16) && get_field('advertising-text-title',16) && get_field('advertising-text-value',16)){
                        ?>
						<a href="<?= get_field('advertising-link',16); ?>" class="d-block card-img-flash">
							<img src="<?= get_field('advertising-image',16); ?>" alt="">
						</a>
                        <?php
                        }
                        ?>
					</div>
				</div>
			</div>
			<!-- Right sidebar END -->
		</div>
	</div>
</section>
<!-- =======================
Main END -->

<?php
$nextPost = get_adjacent_post();

if($nextPost){
?>
<!-- =======================
Sticky post START -->
<div class="sticky-post bg-light border p-4 mb-5 text-sm-end rounded d-none d-xxl-block">
  <div class="d-flex align-items-center">
    <!-- Title -->
    <div class="me-3">
      <span><?= get_field('post-sticky-next-text',16) ?><i class="bi bi-arrow-right ms-3"></i></span>
      <h6 class="m-0"> <a href="<?= get_permalink($nextPost) ?>" class="stretched-link btn-link text-reset"><?= wp_trim_words(get_the_title($nextPost),5,'...'); ?></a></h6>
    </div>
    <!-- image -->
    <div class="col-4 d-none d-md-block">
      <?= get_the_post_thumbnail($nextPost,'large',null) ?>
    </div>
  </div>
</div>
<!-- =======================
Sticky post END -->
<?php
}
?>

</main>
<?php
get_footer();
?>