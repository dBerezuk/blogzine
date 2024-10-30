<?php
/*
Template Name: contact-us
*/
get_header();
?>

<!-- **************** MAIN CONTENT START **************** -->
<main>

<!-- =======================
Inner intro START -->
<section>
	<div class="container">
		<div class="row">
      <div class="col-md-9 mx-auto text-center">
        <h1 class="display-4 mb-3"><?= get_the_title(); ?></h1>
        <!-- breadcrumb -->
        <?php
          bcn_display($return = false, $linked = true, $reverse = false, $force = false);
        ?>
      </div>
    </div>
	</div>
</section>
<!-- =======================
Inner intro END -->

<!-- =======================
Contact info START -->
<section class="pt-4">
	<div class="container">
		<div class="row">
      <div class="col-xl-9 mx-auto">
        <?= CFS()->get('contacts-map'); ?>
        
        <div class="row mt-5">
          <div class="col-sm-6 mb-5 mb-sm-0">
              <?= CFS()->get('contacts-info-sponsorships'); ?>
          </div>
          <div class="col-sm-6">
              <?= CFS()->get('contacts-info-information'); ?>
          </div>
        </div>
        
        <hr class="my-5">
        
        <div class="row">
          <div class="col-12">
          <h2><?= CFS()->get('contacts-form-title'); ?></h2>
          <p><?= CFS()->get('contacts-form-text'); ?></p>
          <!-- Form START -->
          <?php echo do_shortcode('[contact-form-7 id="322" title="contacts-form"]'); ?>
		  <!-- Form END -->
          </div>
        </div>
      </div>  <!-- Col END -->
     </div>
  </div>
</section>
<!-- =======================
Contact info END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->

<?php
get_footer();
?>