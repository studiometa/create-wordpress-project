# Studio Meta maintenance mode

Put your site under maintenance depends on server environment variables.

## Usage

1. The following server environment variables must be set in order to the maintenance be active:
```bash
MAINTENANCE_ENABLED=true|false # Enable/Disable maitenance mode.
MAINTENANCE_IPS=42.42.42.42.42 # Exclude a list of IPs from maitenance.
```
2. You can customize the maintenance page by adding a `maintenance.php` file in `WP_CONTENT_DIR` (see https://developer.wordpress.org/reference/functions/wp_maintenance/). You can find a maintenance page example in [this folder](`./example/maintenance.php`)

> If you use a cache plugin, don't forget to clean caches.
