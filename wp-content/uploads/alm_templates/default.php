<?php
$colorArrayCard = ['text-bg-danger','text-bg-warning','text-bg-success','bg-primary'];
$postCategory = get_the_category(get_the_id());
?>
<!-- Card item START -->
<div class="col-sm-6">
	<div class="card">
		<!-- Card img -->
		<div class="position-relative">
             <?= get_the_post_thumbnail(null,'large',['class' => 'card-img']) ?>
			<div class="card-img-overlay d-flex align-items-start flex-column p-3">
			<!-- Card overlay bottom -->
			<div class="w-100 mt-auto">
			<!-- Card category -->
			 <?php
             foreach ($postCategory as $item){
             ?>
             <a href="<?= get_page_link(266) . '?category_id=' . $item->term_id; ?>" class="badge mb-2 <?= $colorArrayCard[rand(0,count($colorArrayCard) - 1)]; ?> position-relative z-index-99"><i class="fas fa-circle me-2 small fw-bold"></i><?= $item->name ?></a>
             <?php
             }
             ?>
			</div>
			</div>
		</div>
		<div class="card-body px-0 pt-3">
		<h4 class="card-title mt-2"><a href="<?= get_the_permalink(); ?>" class="btn-link text-reset fw-bold text-cut text-cut-2"><?= get_the_title(); ?></a></h4>
		<p class="card-text text-cut text-cut-3"><?= get_the_excerpt(); ?></p>
		<!-- Card info -->
		<ul class="nav nav-divider align-items-center d-none d-sm-inline-block">
			<li class="nav-item">
				<div class="nav-link">
					<div class="d-flex align-items-center position-relative">
						<div class="avatar avatar-xs"><?= get_avatar(get_the_author_meta('ID'),'','','',['class' => 'avatar-img rounded-circle']); ?>
						</div>
						<span class="ms-3"><a href="<?= get_page_link(277) . '?author_id=' . get_the_author_meta('ID'); ?>" class="stretched-link text-reset btn-link"><?= get_the_author(); ?></a></span>
						</div>
					</div>
			</li>
			<li class="nav-item"><?= get_the_date('M d, Y'); ?></li>
		</ul>
		</div>
	</div>
</div>
<!-- Card item END -->