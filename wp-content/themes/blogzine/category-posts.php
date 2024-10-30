<?php
/*
Template Name: category-posts
*/
get_header();
$category = get_category($_GET['category_id']);
?>

<!-- **************** MAIN CONTENT START **************** -->
<main>

<!-- =======================
Inner intro START -->
<section class="pt-4">
	<div class="container">
		<div class="row justify-content-center text-center">
			<div class="col-md-8">
				<div class="display-1 text-primary">#<?= $category->name; ?></div>
				<p><?= padeg_wplife(['статья','статьи','статей'],$category->count) ?> в этой категории</p>
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
			<div class="col-12">
				<div class="row gy-4">
                    <?php
                    $btnLoadMoreTitle = get_field('btn-load-more-title',16);
                    $btnLoadMoreIcon = get_field('btn-load-more-icon',16);
                    $btnLoadMoreLoading = get_field('btn-load-more-title-loading',16);
                    echo do_shortcode('[ajax_load_more category=' . $category->slug . ' posts_per_page="6" scroll="false" container_type="div" transition_container_classes="row gy-4" post_type="post" button_label="' . $btnLoadMoreTitle . esc_html($btnLoadMoreIcon) . '" button_loading_label="' . $btnLoadMoreLoading . esc_html($btnLoadMoreIcon) . '"]');
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

<?php
get_footer();
?>