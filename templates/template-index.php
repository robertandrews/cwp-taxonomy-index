<?php

// Add a custom filter to set the taxonomy index page title
function taxonomy_index_document_title_parts($title_parts)
{
    $taxonomy = get_query_var('taxonomy_index');
    $tax_obj = get_taxonomy($taxonomy);
    $tax_name = is_object($tax_obj) ? $tax_obj->labels->name : ucwords($taxonomy);

    $title_parts['title'] = $tax_name;
    $title_parts['site'] = get_bloginfo('name');

    return $title_parts;
}

add_filter('document_title_parts', 'taxonomy_index_document_title_parts');

get_header();
get_template_part('template-parts/container-start');

$taxonomy = get_query_var('taxonomy_index');
$terms = get_terms($taxonomy);

/*
if (function_exists('custom_breadcrumbs')) {
custom_breadcrumbs();
}
 */

?>
<header class="header pb-3">
    <div class="d-flex">
        <div class="flex-grow-1">
            <h1 class="entry-title h3" itemprop="name">
                <?php
// echo $taxonomy name
$tax = get_taxonomy($taxonomy);
echo $tax->labels->name;
?>
                <span class="badge ms-2 text-body-tertiary border rounded-pill">
                    <?php echo number_format(wp_count_terms($taxonomy)); ?>
                </span>
            </h1>
            <!--
            <div class="archive-meta d-none d-md-block" itemprop="description">
                <?php if ('' != get_the_archive_description()) {echo get_the_archive_description();}?>
            </div>
            -->
        </div>
    </div>
</header>

<?php
if (!empty($terms) && !is_wp_error($terms)) {

    echo '<ul>';

    foreach ($terms as $term) {
        $parent_id = $term->parent;

        if ($parent_id == 0) {
            echo '<li><a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';

            $children = get_term_children($term->term_id, $term->taxonomy);

            if (!empty($children) && !is_wp_error($children)) {
                echo '<ul>';

                foreach ($children as $child_id) {
                    $child_term = get_term_by('id', $child_id, $term->taxonomy);
                    echo '<li><a href="' . esc_url(get_term_link($child_term)) . '">' . esc_html($child_term->name) . '</a></li>';
                }

                echo '</ul>';
            }

            echo '</li>';
        }
    }

    echo '</ul>';
} else {
    echo '<p>No terms found.</p>';
}

?>

<?php
get_template_part('template-parts/container-end');
get_template_part('nav', 'below');

// Remove the custom filter after the title has been rendered
remove_filter('document_title_parts', 'taxonomy_index_document_title_parts');

get_footer();