<?php
/*
Template Name: author
*/
if(!isset($_GET['author_id'])){
    header('Location: /');
}

get_header();

$author = get_userdata($_GET['author_id']);
?>

<!-- **************** MAIN CONTENT START **************** -->
<main>

<!-- =======================
Inner intro START -->
<section class="pt-4">
	<div class="container">
		<div class="row">
      <div class="col-12">
        <!-- Author info START -->
		<div class="bg-primary bg-opacity-10 d-md-flex p-3 p-sm-4 my-3 text-center text-md-start align-items-center rounded">
					<!-- Avatar -->
          <div class=" me-0 me-md-4">
            <div class="avatar avatar-xxl">
                <?= get_avatar($_GET['author_id'],'','','',['class' => 'avatar-img rounded-circle']); ?>
            </div>
            <!-- Post count -->
            <div class="text-center mt-n3 position-relative">
              <span class="badge bg-danger fs-6"><?= padeg_wplife(['статья','статьи','статей'], count_user_posts($_GET['author_id'])); ?></span>
            </div>
          </div>
					<!-- Info -->
					<div>
            <h2 class="m-0"><?= $author->display_name; ?></h2>
            <ul class="list-inline">
              <li class="list-inline-item"><i class="bi bi-person-fill me-1"></i> Редактор <?= bloginfo('name'); ?></li>
            </ul>
						<p class="my-2"><?= $author->user_description; ?></p>
						<!-- Social icons -->
<!--						<ul class="nav justify-content-center justify-content-md-start">-->
<!--							<li class="nav-item">-->
<!--								<a class="nav-link ps-0 pe-2 fs-5" href="author.php#"><i class="fab fa-facebook-square"></i></a>-->
<!--							</li>-->
<!--							<li class="nav-item">-->
<!--								<a class="nav-link px-2 fs-5" href="author.php#"><i class="fab fa-twitter-square"></i></a>-->
<!--							</li>-->
<!--							<li class="nav-item">-->
<!--								<a class="nav-link px-2 fs-5" href="author.php#"><i class="fab fa-linkedin"></i></a>-->
<!--							</li>-->
<!--						</ul>					-->
					</div>
				</div>
				<!-- Author info END -->
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
      <div class="col-12 mb-3">
        <h2><?= CFS()->get('author-post-title'); ?></h2>
      </div>
			<!-- Main Post START -->
			<div class="col-12">
				<div class="row gy-4">
                    <?php
                    $btnLoadMoreTitle = get_field('btn-load-more-title',16);
                    $btnLoadMoreIcon = get_field('btn-load-more-icon',16);
                    $btnLoadMoreLoading = get_field('btn-load-more-title-loading',16);
                    echo do_shortcode('[ajax_load_more author="' . $_GET['author_id'] . '" posts_per_page="6" scroll="false" container_type="div" transition_container_classes="row gy-4" post_type="post" button_label="' . $btnLoadMoreTitle . esc_html($btnLoadMoreIcon) . '" button_loading_label="' . $btnLoadMoreLoading . esc_html($btnLoadMoreIcon) . '"]');
                    ?>

				</div>
			</div>
			<!-- Main Post END -->
		</div> <!-- Row end -->
	</div>
</section>
<!-- =======================
Main content END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->

<!-- =======================
<?php
get_footer();
?>