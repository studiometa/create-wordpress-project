<?php
/**
 * The maintenance page.
 *
 * @package studiometa/create-wordpress-project
 * @since 1.0.0
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title><?php bloginfo( 'name' ) . ( ! empty( get_bloginfo( 'description' ) ) ? ' – ' . bloginfo( 'description' ) : '' ); ?></title>
		<link rel="stylesheet" href="<?php get_stylesheet_uri(); ?>/wp-content/maintenance.css">
	</head>

	<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>
		<h1><?php esc_html_e( 'Site under maintenance' ); ?></h1>
	</body>
</html>
