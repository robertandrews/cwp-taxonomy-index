<?php
/**
 * Plugin Name: CWP Taxonomy Index
 * Description: A plugin to show an index page for each taxonomy, including both custom and standard taxonomies.
 * Version: 1.0
 * Author: Robert Andrews
 * Author URI: https://www.robertandrews.co.uk
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

function taxonomy_index_rewrite_rules()
{
    $taxonomies = get_taxonomies();

    foreach ($taxonomies as $taxonomy) {
        add_rewrite_rule(
            $taxonomy . '/?$',
            'index.php?taxonomy_index=' . $taxonomy,
            'top'
        );
    }
}
add_action('init', 'taxonomy_index_rewrite_rules');

function taxonomy_index_query_vars($query_vars)
{
    $query_vars[] = 'taxonomy_index';
    return $query_vars;
}
add_filter('query_vars', 'taxonomy_index_query_vars');

function taxonomy_index_template_redirect()
{
    $taxonomy = get_query_var('taxonomy_index');

    if ($taxonomy) {
        $template = locate_template('template-' . $taxonomy . '-index.php');

        if (!$template) {
            $template = plugin_dir_path(__FILE__) . 'templates/template-index.php';
        }

        load_template($template);
        exit;
    }
}
add_action('template_redirect', 'taxonomy_index_template_redirect');




/*

You can have custom templates for different taxonomies. To create custom templates
for each taxonomy, follow these steps:

1. In your active theme's folder (usually located in the `wp-content/themes/your-theme`),
create new PHP files with the naming convention `taxonomy-{taxonomy}-index.php`. Replace `{taxonomy}`
with the slug of the specific custom or standard taxonomy for which you want to create
a custom template.

For example, if you have a custom taxonomy called "company" with the singular slug "company",
create a file named `taxonomy-company-index.php` in your active theme's folder.

2. In each of these custom template files, you can write the specific HTML, PHP, or styling
needed to display your taxonomy index page. This template will solely be used for the
index page of the corresponding taxonomy.

When your plugin loads the taxonomy index page, it will first look for a template file in your
theme's folder specific to that taxonomy (i.e., `taxonomy-{taxonomy}-index.php`). If it
doesn't find a specific template, it will fall back to using the `template-index.php` file
provided in the plugin's templates folder.

By following this approach, you can create custom index templates for each taxonomy, both
custom and standard, while still providing a default template for those taxonomies that
don’t have a custom template in the active theme.

 */
