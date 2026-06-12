<?php
/**
 * Pattern: Veterinary Services Grid (3 cards).
 *
 * @package Dr_Manobendro_Portfolio
 */
?>
<!-- wp:group {"align":"full","backgroundColor":"mist","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-mist-background-color has-background" style="padding-top:4rem;padding-bottom:4rem">
<!-- wp:paragraph {"align":"center","className":"dmp-section-label"} -->
<p class="has-text-align-center dmp-section-label">What I Do</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center">Veterinary &amp; Extension Services</h2>
<!-- /wp:heading -->

<!-- wp:columns -->
<div class="wp-block-columns">
<!-- wp:column {"className":"dmp-card"} -->
<div class="wp-block-column dmp-card" style="padding:2rem">
<!-- wp:image {"width":"72px","sizeSlug":"full"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo dmp_image( 'icon-cattle.svg' ); ?>" alt="Cattle care icon" style="width:72px"/></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Livestock Treatment</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Clinical diagnosis and treatment of cattle, buffalo, goats and sheep at the upazila veterinary hospital and on-farm visits.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

<!-- wp:column {"className":"dmp-card"} -->
<div class="wp-block-column dmp-card" style="padding:2rem">
<!-- wp:image {"width":"72px","sizeSlug":"full"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo dmp_image( 'icon-vaccine.svg' ); ?>" alt="Vaccination icon" style="width:72px"/></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Vaccination Programs</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Planning and delivery of government vaccination campaigns against FMD, anthrax, PPR, and poultry diseases.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

<!-- wp:column {"className":"dmp-card"} -->
<div class="wp-block-column dmp-card" style="padding:2rem">
<!-- wp:image {"width":"72px","sizeSlug":"full"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo dmp_image( 'icon-training.svg' ); ?>" alt="Training icon" style="width:72px"/></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Farmer Training</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Hands-on training for smallholder farmers on dairy management, fodder cultivation and biosecurity.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->
