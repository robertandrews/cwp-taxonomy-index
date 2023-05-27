# CWP Taxonomy Index

This repository contains a WordPress plugin called CWP Taxonomy Index. It provides functionality to display an index page for each taxonomy, including both custom and standard taxonomies.

## Features

- Generates index pages for taxonomies
- Supports custom and standard taxonomies
- Provides a fallback template for taxonomies without a custom template
- Easy customization of index page templates

## Installation

1. Download the repository as a ZIP file.
2. In your WordPress admin panel, navigate to **Plugins** → **Add New**.
3. Click on the **Upload Plugin** button, and select the ZIP file you downloaded.
4. Activate the plugin.

## Usage

The plugin automatically creates index pages for all taxonomies in your WordPress installation. To view the index page for a specific taxonomy, simply visit the corresponding URL. The URL structure for taxonomy index pages is `http://your-site.com/{taxonomy-slug}/`.

## Customizing Templates

You can have custom templates for different taxonomies. To create custom templates for each taxonomy, follow these steps:

1. In your active theme's folder (usually located in the `wp-content/themes/your-theme` directory), create new PHP files with the naming convention `taxonomy-{taxonomy}-index.php`. Replace `{taxonomy}` with the slug of the specific custom or standard taxonomy for which you want to create a custom template.

   For example, if you have a custom taxonomy called "company" with the singular slug "company", create a file named `taxonomy-company-index.php` in your active theme's folder.

2. In each of these custom template files, you can write the specific HTML, PHP, or styling needed to display your taxonomy index page. This template will solely be used for the index page of the corresponding taxonomy.

   When your plugin loads the taxonomy index page, it will first look for a template file in your theme's folder specific to that taxonomy (i.e., `taxonomy-{taxonomy}-index.php`). If it doesn't find a specific template, it will fall back to using the `template-index.php` file provided in the plugin's templates folder.

   By following this approach, you can create custom index templates for each taxonomy, both custom and standard, while still providing a default template for those taxonomies that don’t have a custom template in the active theme.

## License

This plugin is licensed under the GPL-2.0+ License. You can find the full license text in the [LICENSE](LICENSE) file.

## Author

CWP Taxonomy Index is developed by Robert Andrews. You can find more information about the author on the [author's website](https://www.robertandrews.co.uk).
