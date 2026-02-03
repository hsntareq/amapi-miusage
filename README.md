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

## Requirements

- WordPress 5.0 or higher (for Gutenberg block support)
- PHP 7.0 or higher
- WP-CLI (optional, for command-line data synchronization)

## Usage

After activating the plugin, you can create events using the event post type. You can then view and manage these events in the WordPress admin area by navigating to "Hasan Miusage" under the "Events" menu in the admin sidebar or by visiting the URL `wp-admin/admin.php?page=hasan-miusage`.

### Gutenberg Block Usage

1. Edit any post or page in the WordPress editor
2. Click the plus button and search for "Hasan Miusage" block
3. Add the block to display challenge data
4. The block will automatically display the latest fetched challenge information

### WP-CLI Commands

Trigger manual data synchronization using WP-CLI:

```bash
wp miusage sync
```

This command fetches the latest challenge data from the Miusage API and updates your WordPress site immediately.

## Configuration

The plugin works with minimal configuration:

- **Manual Refresh**: Use the admin page to manually refresh challenge data from the API (AJAX)
- **WP-CLI Command**: Use `wp amapi refresh` from command line to fetch latest data
- **Hourly Cooldown**: After each refresh, the plugin enforces a 1-hour cooldown before the next refresh can be triggered via AJAX (wp-cli bypass this limit)
- **Auto Display**: The Gutenberg block automatically displays the latest fetched challenge data

Access the plugin dashboard at **WordPress Admin > Hasan Miusage**

## Features in Detail

### Automated Hourly Sync

The plugin uses WordPress scheduling (wp_cron) to fetch challenge data every hour automatically. No manual intervention needed.

### Gutenberg Block Integration

Display challenge data anywhere on your site using the custom Gutenberg block with full flexibility in post/page layouts.

### Data Management

- Create, read, update, and delete challenge records
- Bulk operations for managing multiple records
- Search and filter functionality for easy navigation

## Troubleshooting

### Data Not Updating

- Check WordPress cron is enabled: `wp cron test`
- Verify API endpoint is accessible: `wp miusage sync --dry-run`
- Check error logs in WordPress admin

### Block Not Appearing

- Ensure WordPress 5.0+ is installed
- Clear browser cache and reload the editor
- Deactivate and reactivate the plugin

## Version

1.0.0

## Stable Tag

1.0.0

## License

This plugin is released under the GNU General Public License v2 or later. See the [GPLv2 or later](https://www.gnu.org/licenses/old-licenses/gpl-2.0.html) file for details.

## Author

Hasan Tareq

## Contributing

We welcome contributions! Please feel free to submit pull requests or open issues for bug reports and feature requests.

## Changelog

### Version 1.0.0

- Initial release
- Automated hourly data retrieval from Miusage API
- WP-CLI integration for manual synchronization
- Gutenberg block for displaying challenge data
- Full CRUD admin interface
- Flexible configuration options

## Support

For support or questions, please [contact us](mailto:hsntareq@gmail.com).
