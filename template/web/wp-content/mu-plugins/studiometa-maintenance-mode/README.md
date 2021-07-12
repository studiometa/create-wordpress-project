# Studio Meta maintenance mode

Put your site under maintenance with a 503 HTTP status and a dedicated page.

## Usage

1. The following server environment variables must be set in order to the maintenance be active:
```bash
MAINTENANCE_ENABLED=true|false # Enable/Disable maitenance mode.
MAINTENANCE_IPS=42.42.42.42.42 # Exclude a list of IPs from maitenance.
```
2. Customize the maintenance page thanks to `maintenance.php` and `maintenance.css` files.

> If you use a cache plugin, don't forget to clean caches.
