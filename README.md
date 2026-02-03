# Hasan Miusage

This "Hasan Miusage" plugin allows you to seamlessly integrate challenge data from the Miusage API (<https://miusage.com/>) into your WordPress website. The plugin automatically retrieves challenge information on an hourly basis and updates your WordPress site with the latest data using WordPress hooks and wp-cli integration for efficient data synchronization. It provides a comprehensive CRUD interface within the WordPress admin panel, allowing you to manage and view challenge-related content directly from the admin dashboard.

## Key Features

- **Automated Data Retrieval**: Automatically fetches challenge data from <https://miusage.com/v1/challenge/1/> every hour
- **WP-CLI Integration**: Support for wp-cli commands to trigger manual data updates and synchronization
- **Gutenberg Block**: Custom Gutenberg block to display fetched challenge data directly on your posts and pages
- **Admin Dashboard**: Full CRUD operations accessible through a dedicated admin page under "Hasan Miusage"
- **Data Management**: Easy-to-use interface for viewing, creating, updating, and deleting challenge records
- **Flexible Configuration**: Customizable settings to fine-tune the plugin behavior and data handling

## Installation

To install the plugin, follow these steps:

1. Download the plugin zip file
2. Upload & install the plugin
3. Activate the plugin through the 'Plugins' menu in WordPress.

## Usage

After activating the plugin, you can create events using the event post type. You can then view and manage these events in the WordPress admin area by navigating to "Hasan Miusage" under the "Events" menu in the admin sidebar or by visiting the URL `wp-admin/admin.php?page=hasan-miusage`.

## Configuration

The plugin provides a settings page where you can configure various options, such as the number of related posts to display and the order in which they should be shown.

## Stable Tag

1.0.0

## License

This plugin is released under the GNU General Public License v2 or later. See the [GPLv2 or later](https://www.gnu.org/licenses/old-licenses/gpl-2.0.html) file for details.

## Support

For support or questions, please [contact us](mailto:hsntareq@gmail.com).
