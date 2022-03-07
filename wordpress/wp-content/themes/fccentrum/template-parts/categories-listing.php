<?php

// Get the current queried object
// $term    = get_queried_object();
// $term_id = ( isset( $term->term_id ) ) ? (int) $term->term_id : 0;

$categories = get_categories( array(
    'taxonomy'   => 'category', // Taxonomy to retrieve terms for. We want 'category'. Note that this parameter is default to 'category', so you can omit it
    'orderby'    => 'name',
    'parent'     => 0,
    'hide_empty' => 0, // change to 1 to hide categores not having a single post
) );
?>
<ul class="categories-block">
    <?php
    foreach ( $categories as $category ) {
        get_template_part( 'template-parts/category-teaser', null, ['category' => $category] );
    }
    ?>
</ul>