<?php
/*
Template Name: about-us
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
        <div class="card bg-dark-overlay-4 overflow-hidden card-bg-scale h-400 text-center" style="background-image:url(<?= CFS()->get('about-image') ?>); background-position: center; background-size: cover;">
          <!-- Card Image overlay -->
          <div class="card-img-overlay d-flex align-items-center p-3 p-sm-4"> 
            <div class="w-100 my-auto">
              <h1 class="text-white display-4 mb-3"><?= get_the_title(); ?></h1>
              <!-- breadcrumb -->
              <?php
                bcn_display($return = false, $linked = true, $reverse = false, $force = false);
              ?>
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
About START -->
<section class="pt-4 pb-0">
	<div class="container">
		<div class="row">
      <div class="col-xl-9 mx-auto">
          <?= CFS()->get('about-content'); ?>
        <!-- Team START -->
        <h3 class="mb-3 mt-5"><?= CFS()->get('about-team-title'); ?></h3>
        <div class="row g-4">
          <!-- Team item-->
          <?php
          foreach (CFS()->get('about-team-user') as $item){
          ?>
          <div class="col-sm-6 col-lg-3">
            <div class="text-center">
            	<!-- Avatar img -->
              <div class="avatar avatar-xxl mb-2">
                <img class="avatar-img rounded-circle" src="<?= $item['about-team-user-logo']; ?>" alt="avatar">
              </div>
              <h5><?= $item['about-team-user-name']; ?></h5>
              <p class="m-0"><?= $item['about-team-user-specialist']; ?></p>
              <ul class="nav justify-content-center">
                <?php
                foreach ($item['about-team-user-social'] as $social){
                ?>
                <li class="nav-item">
                  <a class="nav-link px-2 fs-5" href="<?= $social['about-team-user-social-link']; ?>"><?= $social['about-team-user-social-icon']; ?></a>
                </li>
                <?php
                }
                ?>
              </ul>
            </div>
          </div>
          <?php
          }
          ?>
        <!-- Team END -->
        <!-- Service START -->
        <h3 class="mb-3 mt-5"><?= CFS()->get('we-do-box-title'); ?></h3>
        <div class="row">
          <!-- Service item-->
          <?php
          foreach(CFS()->get('we-do-boxs') as $item){
          ?>
          <div class="col-md-6 col-lg-4 mb-4">
            <img class="rounded" src="<?= $item['we-do-box-image']; ?>" alt="Card image">
            <h4 class="mt-3"><?= $item['we-do-box-title']; ?></h4>
            <p><?= $item['we-do-box-text']; ?></p>
          </div>
          <?php
          }
          ?>
        </div>
        <!-- Service END -->
      </div>  <!-- Col END -->
     </div>
  </div>
</section>
<!-- =======================
About END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->

<?php
get_footer();
?>