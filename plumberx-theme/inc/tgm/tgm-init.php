<?php
/**
 * TGM Plugin Activation configuration for PlumberX Theme
 *
 * Recommends and installs Elementor, WooCommerce, and One Click Demo Import.
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once PLUMBERX_DIR . '/inc/tgm/class-tgm-plugin-activation.php';

function plumberx_register_required_plugins() {
    $plugins = array(
        array(
            'name'     => 'Elementor Website Builder',
            'slug'     => 'elementor',
            'required' => true,
        ),
        array(
            'name'     => 'WooCommerce',
            'slug'     => 'woocommerce',
            'required' => false,
        ),
        array(
            'name'     => 'One Click Demo Import',
            'slug'     => 'one-click-demo-import',
            'required' => false,
        ),
    );

    $config = array(
        'id'           => 'plumberx',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'parent_slug'  => 'themes.php',
        'capability'   => 'edit_theme_options',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => true,
        'message'      => '',
    );

    tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'plumberx_register_required_plugins' );
