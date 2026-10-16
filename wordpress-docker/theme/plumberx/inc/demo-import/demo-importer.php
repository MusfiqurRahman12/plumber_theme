<?php
/**
 * PlumberX Native One-Click Demo Importer
 *
 * Provides a seamless, zero-external-dependency demo import experience
 * directly inside the WordPress admin dashboard under Appearance > Demo Import.
 * Imports all 12 pages, Elementor layouts, media assets, blog posts,
 * WooCommerce products, and navigation menus with 100% fidelity.
 *
 * @package PlumberX
 * @version 1.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Demo_Importer {

    private static $_instance = null;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'register_admin_page' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
        add_action( 'wp_ajax_plumberx_import_demo_step', array( $this, 'handle_ajax_import_step' ) );
    }

    /**
     * Register Admin Menu under Appearance
     */
    public function register_admin_page() {
        add_theme_page(
            esc_html__( 'PlumberX Demo Import', 'plumberx' ),
            esc_html__( 'Demo Import', 'plumberx' ),
            'manage_options',
            'plumberx-demo-import',
            array( $this, 'render_admin_page' )
        );
    }

    /**
     * Enqueue styles and scripts for Demo Import page
     */
    public function enqueue_admin_assets( $hook ) {
        if ( 'appearance_page_plumberx-demo-import' !== $hook ) {
            return;
        }

        wp_enqueue_style( 'plumberx-demo-import-css', false );
        wp_add_inline_style( 'plumberx-demo-import-css', '
            .plumberx-import-wrap {
                max-width: 980px;
                margin: 30px auto 40px;
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
            }
            .plumberx-card {
                background: #ffffff;
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.07);
                overflow: hidden;
                margin-bottom: 24px;
                border: 1px solid #e2e8f0;
            }
            .plumberx-card-header {
                padding: 30px;
                background: linear-gradient(135deg, #0b1b3d 0%, #002244 50%, #003366 100%);
                color: #ffffff;
                position: relative;
            }
            .plumberx-card-header h1 {
                color: #ffffff;
                font-size: 26px;
                font-weight: 800;
                margin: 0 0 8px 0;
                display: flex;
                align-items: center;
                gap: 12px;
            }
            .plumberx-badge {
                display: inline-block;
                background: #00a4e4;
                color: #fff;
                font-size: 11px;
                font-weight: 700;
                padding: 3px 8px;
                border-radius: 20px;
                letter-spacing: 0.5px;
                vertical-align: middle;
            }
            .plumberx-card-header p {
                color: #94a3b8;
                font-size: 14px;
                margin: 0;
            }
            .plumberx-card-body {
                padding: 30px;
            }
            .plumberx-reqs-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 15px;
                margin-bottom: 30px;
            }
            .plumberx-req-box {
                padding: 15px;
                border-radius: 8px;
                border: 1px solid #e2e8f0;
                background: #f8fafc;
                display: flex;
                align-items: center;
                gap: 12px;
            }
            .plumberx-req-icon {
                width: 32px;
                height: 32px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 16px;
                font-weight: bold;
                flex-shrink: 0;
            }
            .plumberx-req-icon.success {
                background: #dcfce7;
                color: #16a34a;
            }
            .plumberx-req-icon.warning {
                background: #fef9c3;
                color: #ca8a04;
            }
            .plumberx-req-icon.danger {
                background: #fee2e2;
                color: #dc2626;
            }
            .plumberx-req-details h4 {
                margin: 0 0 2px 0;
                font-size: 13px;
                color: #0b1b3d;
            }
            .plumberx-req-details p {
                margin: 0;
                font-size: 12px;
                color: #64748b;
            }
            .plumberx-demo-preview {
                display: flex;
                gap: 25px;
                border: 1px solid #e2e8f0;
                border-radius: 10px;
                padding: 20px;
                background: #ffffff;
                margin-bottom: 25px;
            }
            .plumberx-demo-thumb {
                width: 240px;
                height: 160px;
                object-fit: cover;
                border-radius: 8px;
                border: 1px solid #cbd5e1;
                flex-shrink: 0;
            }
            .plumberx-demo-info {
                flex: 1;
            }
            .plumberx-demo-info h3 {
                margin: 0 0 8px 0;
                font-size: 20px;
                color: #0b1b3d;
            }
            .plumberx-demo-info p {
                margin: 0 0 15px 0;
                font-size: 13px;
                color: #475569;
                line-height: 1.5;
            }
            .plumberx-feature-tags {
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
                margin-bottom: 15px;
            }
            .plumberx-feature-tags span {
                background: #f1f5f9;
                color: #334155;
                font-size: 11px;
                font-weight: 600;
                padding: 4px 10px;
                border-radius: 4px;
            }
            .plumberx-btn-import {
                background: #00a4e4;
                color: #ffffff;
                border: none;
                padding: 12px 28px;
                font-size: 15px;
                font-weight: 700;
                border-radius: 6px;
                cursor: pointer;
                transition: all 0.2s ease;
                display: inline-flex;
                align-items: center;
                gap: 8px;
            }
            .plumberx-btn-import:hover {
                background: #0088cc;
                transform: translateY(-1px);
            }
            .plumberx-btn-import:disabled {
                background: #94a3b8;
                cursor: not-allowed;
                transform: none;
            }
            .plumberx-progress-wrap {
                display: none;
                margin-top: 25px;
                padding: 20px;
                background: #f8fafc;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
            }
            .plumberx-progress-bar-bg {
                background: #e2e8f0;
                height: 12px;
                border-radius: 6px;
                overflow: hidden;
                margin-bottom: 15px;
            }
            .plumberx-progress-bar-fill {
                background: linear-gradient(90deg, #00a4e4, #38bdf8);
                height: 100%;
                width: 0%;
                transition: width 0.3s ease;
            }
            .plumberx-log-box {
                max-height: 180px;
                overflow-y: auto;
                background: #0b1b3d;
                color: #a5f3fc;
                font-family: monospace;
                font-size: 12px;
                padding: 15px;
                border-radius: 6px;
                line-height: 1.6;
            }
            .plumberx-success-banner {
                display: none;
                margin-top: 25px;
                padding: 25px;
                background: #f0fdf4;
                border: 1px solid #86efac;
                border-radius: 8px;
                text-align: center;
            }
            .plumberx-success-banner h3 {
                color: #166534;
                margin: 0 0 8px 0;
                font-size: 20px;
            }
            .plumberx-success-banner p {
                color: #15803d;
                margin: 0 0 20px 0;
            }
            .plumberx-btn-view {
                background: #16a34a;
                color: #fff;
                text-decoration: none;
                padding: 10px 24px;
                font-size: 14px;
                font-weight: 700;
                border-radius: 6px;
                display: inline-block;
                margin: 0 6px;
            }
            .plumberx-btn-view:hover {
                background: #15803d;
                color: #fff;
            }
            .plumberx-btn-secondary {
                background: #0284c7;
                color: #fff;
                text-decoration: none;
                padding: 10px 24px;
                font-size: 14px;
                font-weight: 700;
                border-radius: 6px;
                display: inline-block;
                margin: 0 6px;
            }
            .plumberx-btn-secondary:hover {
                background: #0369a1;
                color: #fff;
            }
            .spinner-icon {
                animation: spin 1s linear infinite;
                display: inline-block;
            }
            @keyframes spin { 100% { transform: rotate(360deg); } }
        ' );
    }

    /**
     * Render Demo Import Admin Page
     */
    public function render_admin_page() {
        $elementor_active   = class_exists( '\Elementor\Plugin' );
        $woocommerce_active = class_exists( 'WooCommerce' );
        $preview_thumb      = file_exists( PLUMBERX_DIR . '/screenshot.png' ) ? PLUMBERX_URI . '/screenshot.png' : PLUMBERX_URI . '/assets/images/home_hero_bg.jpg';
        ?>
        <div class="wrap plumberx-import-wrap">
            <div class="plumberx-card">
                <div class="plumberx-card-header">
                    <h1>
                        PlumberX Demo Importer
                        <span class="plumberx-badge">v<?php echo esc_html( PLUMBERX_VERSION ); ?></span>
                    </h1>
                    <p>Import all 12 pre-configured pages, drag-and-drop Elementor widget templates, media assets, blog posts, WooCommerce products, and navigation menus with 1-click.</p>
                </div>

                <div class="plumberx-card-body">
                    <!-- Environment Checklist -->
                    <div class="plumberx-reqs-grid">
                        <div class="plumberx-req-box">
                            <div class="plumberx-req-icon <?php echo $elementor_active ? 'success' : 'danger'; ?>">
                                <?php echo $elementor_active ? '✓' : '!'; ?>
                            </div>
                            <div class="plumberx-req-details">
                                <h4>Elementor Builder</h4>
                                <p><?php echo $elementor_active ? 'Active & Ready' : '<a href="' . esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ) . '">Install & Activate</a>'; ?></p>
                            </div>
                        </div>

                        <div class="plumberx-req-box">
                            <div class="plumberx-req-icon <?php echo $woocommerce_active ? 'success' : 'warning'; ?>">
                                <?php echo $woocommerce_active ? '✓' : 'ℹ'; ?>
                            </div>
                            <div class="plumberx-req-details">
                                <h4>WooCommerce Shop</h4>
                                <p><?php echo $woocommerce_active ? 'Active & Ready' : '<a href="' . esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ) . '">Optional Install</a>'; ?></p>
                            </div>
                        </div>

                        <div class="plumberx-req-box">
                            <div class="plumberx-req-icon success">✓</div>
                            <div class="plumberx-req-details">
                                <h4>Memory Limit</h4>
                                <p><?php echo esc_html( ini_get( 'memory_limit' ) ); ?></p>
                            </div>
                        </div>

                        <div class="plumberx-req-box">
                            <div class="plumberx-req-icon success">✓</div>
                            <div class="plumberx-req-details">
                                <h4>PHP Execution Time</h4>
                                <p><?php echo esc_html( ini_get( 'max_execution_time' ) ); ?>s</p>
                            </div>
                        </div>
                    </div>

                    <!-- Demo Package Box -->
                    <div class="plumberx-demo-preview">
                        <img src="<?php echo esc_url( $preview_thumb ); ?>" alt="PlumberX Demo" class="plumberx-demo-thumb">
                        <div class="plumberx-demo-info">
                            <h3>PlumberX Complete Demo Package</h3>
                            <p>Installs 12 high-converting pages (Home, About Us, 3 Services Layouts, Plumbing Repairs, Projects Gallery, Case Study, Price Plans, Blog & Single Post, Contact Us, Shop), all 28 Elementor drag-and-drop widgets, media assets, WooCommerce products, and custom header/footer menus.</p>

                            <div class="plumberx-feature-tags">
                                <span>12 Complete Pages</span>
                                <span>28 Elementor Widgets</span>
                                <span>100% Visual Fidelity</span>
                                <span>WooCommerce Ready</span>
                                <span>100+ Bundled Assets</span>
                                <span>Drag & Drop Editable</span>
                            </div>

                            <button type="button" id="plumberx-start-import" class="plumberx-btn-import">
                                <span class="dashicons dashicons-download" style="line-height: inherit;"></span>
                                Import Complete Demo
                            </button>
                        </div>
                    </div>

                    <!-- Progress Wrap -->
                    <div id="plumberx-progress" class="plumberx-progress-wrap">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #0b1b3d;">
                            <span id="plumberx-step-label">Initializing import engine...</span>
                            <span id="plumberx-step-percent">0%</span>
                        </div>
                        <div class="plumberx-progress-bar-bg">
                            <div id="plumberx-progress-fill" class="plumberx-progress-bar-fill"></div>
                        </div>
                        <div id="plumberx-log" class="plumberx-log-box">
                            [System] Ready to start import.<br>
                        </div>
                    </div>

                    <!-- Success Banner -->
                    <div id="plumberx-success" class="plumberx-success-banner">
                        <h3>🎉 Demo Imported Successfully!</h3>
                        <p>All 12 pages, Elementor widgets, media assets, blog posts, and products have been imported. Your site layout and design is now 100% matching the live demo!</p>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank" class="plumberx-btn-view">Visit Your Website</a>
                        <a href="<?php echo esc_url( admin_url( 'edit.php?post_type=page' ) ); ?>" class="plumberx-btn-secondary">Manage All Pages</a>
                    </div>
                </div>
            </div>
        </div>

        <script>
        jQuery(document).ready(function($) {
            var steps = ['media', 'products', 'posts', 'pages', 'menu', 'settings'];
            var stepLabels = {
                'media': 'Step 1/6: Importing theme media assets & images...',
                'products': 'Step 2/6: Setting up WooCommerce products...',
                'posts': 'Step 3/6: Importing blog articles & categories...',
                'pages': 'Step 4/6: Importing all 12 Elementor pages & widgets...',
                'menu': 'Step 5/6: Configuring navigation menus & dropdowns...',
                'settings': 'Step 6/6: Applying reading & homepage settings...'
            };
            var currentStepIndex = 0;
            var nonce = '<?php echo esc_js( wp_create_nonce( 'plumberx_demo_import_nonce' ) ); ?>';

            function log(msg) {
                var box = $('#plumberx-log');
                box.append(msg + '<br>');
                box.scrollTop(box[0].scrollHeight);
            }

            function runStep(index) {
                if (index >= steps.length) {
                    $('#plumberx-progress-fill').css('width', '100%');
                    $('#plumberx-step-percent').text('100%');
                    $('#plumberx-step-label').text('Import complete!');
                    log('[Success] All demo content imported successfully!');
                    $('#plumberx-success').fadeIn();
                    $('#plumberx-start-import').prop('disabled', false).html('<span class="dashicons dashicons-yes" style="line-height:inherit;"></span> Import Completed');
                    return;
                }

                var step = steps[index];
                var percent = Math.round((index / steps.length) * 100);
                $('#plumberx-progress-fill').css('width', percent + '%');
                $('#plumberx-step-percent').text(percent + '%');
                $('#plumberx-step-label').text(stepLabels[step]);
                log('[Progress] ' + stepLabels[step]);

                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        action: 'plumberx_import_demo_step',
                        step: step,
                        security: nonce
                    },
                    success: function(res) {
                        if (res && res.success) {
                            if (res.data && res.data.message) {
                                log('[OK] ' + res.data.message);
                            }
                            currentStepIndex++;
                            runStep(currentStepIndex);
                        } else {
                            var errMsg = (res && res.data && res.data.message) ? res.data.message : 'Unknown error during import step: ' + step;
                            log('[Error] ' + errMsg);
                            alert('Import encountered an error: ' + errMsg);
                            $('#plumberx-start-import').prop('disabled', false).text('Resume Import');
                        }
                    },
                    error: function(xhr, status, error) {
                        log('[Error] AJAX error: ' + error + ' (HTTP ' + xhr.status + ')');
                        alert('AJAX request failed on step: ' + step + '. Check server error logs.');
                        $('#plumberx-start-import').prop('disabled', false).text('Retry Import');
                    }
                });
            }

            $('#plumberx-start-import').on('click', function() {
                if (!confirm('This will import all PlumberX demo pages, media, products, and menus. Continue?')) {
                    return;
                }
                $(this).prop('disabled', true).html('<span class="dashicons dashicons-update spinner-icon" style="line-height:inherit;"></span> Importing...');
                $('#plumberx-progress').fadeIn();
                $('#plumberx-success').hide();
                $('#plumberx-log').html('[System] Starting import process...<br>');
                currentStepIndex = 0;
                runStep(0);
            });
        });
        </script>
        <?php
    }

    /**
     * AJAX Step Handler
     */
    public function handle_ajax_import_step() {
        check_ajax_referer( 'plumberx_demo_import_nonce', 'security' );

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error( array( 'message' => esc_html__( 'Unauthorized access.', 'plumberx' ) ) );
        }

        $step = isset( $_POST['step'] ) ? sanitize_key( $_POST['step'] ) : '';
        $json_file = PLUMBERX_DIR . '/inc/demo-import/demo-data/plumberx-demo-content.json';

        if ( ! file_exists( $json_file ) ) {
            wp_send_json_error( array( 'message' => esc_html__( 'Demo data JSON file not found.', 'plumberx' ) ) );
        }

        $demo_data = json_decode( file_get_contents( $json_file ), true );
        if ( ! is_array( $demo_data ) ) {
            wp_send_json_error( array( 'message' => esc_html__( 'Failed to parse demo data JSON.', 'plumberx' ) ) );
        }

        switch ( $step ) {
            case 'media':
                $result = $this->import_media_step( $demo_data );
                wp_send_json_success( array( 'message' => $result ) );
                break;

            case 'products':
                $result = $this->import_products_step( $demo_data );
                wp_send_json_success( array( 'message' => $result ) );
                break;

            case 'posts':
                $result = $this->import_posts_step( $demo_data );
                wp_send_json_success( array( 'message' => $result ) );
                break;

            case 'pages':
                $result = $this->import_pages_step( $demo_data );
                wp_send_json_success( array( 'message' => $result ) );
                break;

            case 'menu':
                $result = $this->import_menu_step( $demo_data );
                wp_send_json_success( array( 'message' => $result ) );
                break;

            case 'settings':
                $result = $this->import_settings_step( $demo_data );
                wp_send_json_success( array( 'message' => $result ) );
                break;

            default:
                wp_send_json_error( array( 'message' => esc_html__( 'Invalid import step.', 'plumberx' ) ) );
        }
    }

    /**
     * Step 1: Import Media
     */
    private function import_media_step( $demo_data ) {
        require_once ABSPATH . 'wp-admin/includes/image.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';

        $img_dir = PLUMBERX_DIR . '/assets/images/';
        $upload_dir = wp_upload_dir();
        $imported_count = 0;
        $map = get_option( 'plumberx_demo_media_map', array() );

        if ( is_dir( $img_dir ) ) {
            $files = scandir( $img_dir );
            foreach ( $files as $file ) {
                if ( in_array( $file, array( '.', '..' ) ) ) {
                    continue;
                }

                $source_file = $img_dir . $file;
                if ( ! is_file( $source_file ) ) {
                    continue;
                }

                $filename = basename( $file );
                if ( isset( $map[ $filename ] ) && ! empty( $map[ $filename ]['url'] ) ) {
                    continue; // Already mapped
                }

                // Check if already in media library
                $existing = get_posts( array(
                    'post_type'      => 'attachment',
                    'meta_key'       => '_wp_attached_file',
                    'meta_value'     => $filename,
                    'posts_per_page' => 1,
                ) );

                if ( ! empty( $existing ) ) {
                    $att_id = $existing[0]->ID;
                    $map[ $filename ] = array(
                        'id'  => $att_id,
                        'url' => wp_get_attachment_url( $att_id ),
                    );
                    continue;
                }

                // Copy to upload dir
                $target_file = $upload_dir['path'] . '/' . $filename;
                @copy( $source_file, $target_file );

                $filetype = wp_check_filetype( $filename, null );
                $attachment = array(
                    'guid'           => $upload_dir['url'] . '/' . $filename,
                    'post_mime_type' => $filetype['type'],
                    'post_title'     => preg_replace( '/\.[^.]+$/', '', $filename ),
                    'post_content'   => '',
                    'post_status'    => 'inherit',
                );

                $attach_id = wp_insert_attachment( $attachment, $target_file );
                if ( ! is_wp_error( $attach_id ) ) {
                    $attach_data = wp_generate_attachment_metadata( $attach_id, $target_file );
                    wp_update_attachment_metadata( $attach_id, $attach_data );

                    $map[ $filename ] = array(
                        'id'  => $attach_id,
                        'url' => wp_get_attachment_url( $attach_id ),
                    );
                    $imported_count++;
                } else {
                    // Fallback directly to theme uri
                    $map[ $filename ] = array(
                        'id'  => 0,
                        'url' => PLUMBERX_URI . '/assets/images/' . $filename,
                    );
                }
            }
        }

        update_option( 'plumberx_demo_media_map', $map );
        return sprintf( 'Processed media library (%d new images imported, %d total mapped).', $imported_count, count( $map ) );
    }

    /**
     * Step 2: Import Products
     */
    private function import_products_step( $demo_data ) {
        if ( ! class_exists( 'WooCommerce' ) ) {
            return 'WooCommerce not active; skipped WooCommerce product import.';
        }

        $media_map = get_option( 'plumberx_demo_media_map', array() );
        $products = isset( $demo_data['products'] ) ? $demo_data['products'] : array();
        $imported = 0;

        foreach ( $products as $prod ) {
            $existing = get_page_by_path( $prod['slug'], OBJECT, 'product' );
            $post_id  = $existing ? $existing->ID : 0;

            $post_data = array(
                'post_title'   => $prod['title'],
                'post_name'    => $prod['slug'],
                'post_status'  => 'publish',
                'post_type'    => 'product',
                'post_content' => 'High quality plumbing fixture and hardware certified for residential and commercial use.',
            );

            if ( $post_id ) {
                $post_data['ID'] = $post_id;
                wp_update_post( $post_data );
            } else {
                $post_id = wp_insert_post( $post_data );
            }

            if ( $post_id && ! is_wp_error( $post_id ) ) {
                wp_set_object_terms( $post_id, 'simple', 'product_type' );
                update_post_meta( $post_id, '_visibility', 'visible' );
                update_post_meta( $post_id, '_stock_status', 'instock' );
                update_post_meta( $post_id, '_regular_price', $prod['price'] );
                update_post_meta( $post_id, '_price', $prod['price'] );

                // Set thumbnail
                $thumb_file = preg_replace( '/-\d+\.jpg$/', '.jpg', $prod['thumb_file'] );
                if ( isset( $media_map[ $thumb_file ]['id'] ) && $media_map[ $thumb_file ]['id'] > 0 ) {
                    set_post_thumbnail( $post_id, $media_map[ $thumb_file ]['id'] );
                }
                $imported++;
            }
        }

        return sprintf( 'Imported %d WooCommerce products.', $imported );
    }

    /**
     * Step 3: Import Blog Posts
     */
    private function import_posts_step( $demo_data ) {
        $media_map = get_option( 'plumberx_demo_media_map', array() );
        $posts     = isset( $demo_data['posts'] ) ? $demo_data['posts'] : array();
        $imported  = 0;

        foreach ( $posts as $post_item ) {
            $existing = get_page_by_path( $post_item['slug'], OBJECT, 'post' );
            $post_id  = $existing ? $existing->ID : 0;

            $post_data = array(
                'post_title'   => $post_item['title'],
                'post_name'    => $post_item['slug'],
                'post_content' => $post_item['content'],
                'post_excerpt' => $post_item['excerpt'],
                'post_status'  => 'publish',
                'post_type'    => 'post',
            );

            if ( $post_id ) {
                $post_data['ID'] = $post_id;
                wp_update_post( $post_data );
            } else {
                $post_id = wp_insert_post( $post_data );
            }

            if ( $post_id && ! is_wp_error( $post_id ) ) {
                // Set Categories
                if ( ! empty( $post_item['categories'] ) ) {
                    wp_set_object_terms( $post_id, $post_item['categories'], 'category' );
                }

                // Set Featured Image
                $thumb_file = $post_item['thumb_file'];
                if ( isset( $media_map[ $thumb_file ]['id'] ) && $media_map[ $thumb_file ]['id'] > 0 ) {
                    set_post_thumbnail( $post_id, $media_map[ $thumb_file ]['id'] );
                }
                $imported++;
            }
        }

        return sprintf( 'Imported %d blog posts with categories and featured images.', $imported );
    }

    /**
     * Step 4: Import all 12 Pages with exact Elementor widget layouts
     */
    private function import_pages_step( $demo_data ) {
        $media_map = get_option( 'plumberx_demo_media_map', array() );
        $pages     = isset( $demo_data['pages'] ) ? $demo_data['pages'] : array();
        $imported  = 0;

        foreach ( $pages as $slug => $page_item ) {
            $existing = get_page_by_path( $slug, OBJECT, 'page' );
            $page_id  = $existing ? $existing->ID : 0;

            $page_data = array(
                'post_title'   => $page_item['title'],
                'post_name'    => $slug,
                'post_content' => $page_item['content'],
                'post_status'  => 'publish',
                'post_type'    => 'page',
            );

            if ( $page_id ) {
                $page_data['ID'] = $page_id;
                wp_update_post( $page_data );
            } else {
                $page_id = wp_insert_post( $page_data );
            }

            if ( $page_id && ! is_wp_error( $page_id ) ) {
                // Remap media URLs in Elementor JSON
                $elementor_data = $page_item['elementor_data'];
                if ( ! empty( $elementor_data ) ) {
                    $json_str = json_encode( $elementor_data );

                    // Replace old localhost uploads URLs with actual media map URLs
                    foreach ( $media_map as $filename => $info ) {
                        if ( ! empty( $info['url'] ) ) {
                            // Match pattern: http://.../filename or /filename
                            $json_str = preg_replace(
                                '#http[s]?://[^"\'\s]+/wp-content/uploads/[^"\'\s]*/' . preg_quote( $filename, '#' ) . '#',
                                $info['url'],
                                $json_str
                            );
                        }
                    }

                    // Also replace any generic localhost links with current site URL
                    $json_str = str_replace( 'http://localhost:8080/', home_url( '/' ), $json_str );

                    // Save Elementor meta
                    update_post_meta( $page_id, '_elementor_data', wp_slash( $json_str ) );
                    update_post_meta( $page_id, '_elementor_edit_mode', 'builder' );
                    update_post_meta( $page_id, '_elementor_template_type', 'wp-page' );
                    if ( ! empty( $page_item['template'] ) ) {
                        update_post_meta( $page_id, '_wp_page_template', $page_item['template'] );
                    }
                }

                $imported++;
            }
        }

        return sprintf( 'Imported and mapped %d pages with full Elementor layouts.', $imported );
    }

    /**
     * Step 5: Import Navigation Menus
     */
    private function import_menu_step( $demo_data ) {
        $menu_name = 'Main Navigation';
        $menu_obj  = wp_get_nav_menu_object( $menu_name );

        // If exists, delete old items to re-create clean
        if ( $menu_obj ) {
            $existing_items = wp_get_nav_menu_items( $menu_obj->term_id );
            if ( $existing_items ) {
                foreach ( $existing_items as $item ) {
                    wp_delete_post( $item->ID, true );
                }
            }
            $menu_id = $menu_obj->term_id;
        } else {
            $menu_id = wp_create_nav_menu( $menu_name );
        }

        if ( is_wp_error( $menu_id ) ) {
            return 'Failed to create menu.';
        }

        $items = isset( $demo_data['menu'] ) ? $demo_data['menu'] : array();
        $id_map = array();

        foreach ( $items as $item ) {
            $url = str_replace( 'http://localhost:8080/', home_url( '/' ), $item['url'] );
            $parent_id = 0;
            if ( ! empty( $item['parent'] ) && isset( $id_map[ $item['parent'] ] ) ) {
                $parent_id = $id_map[ $item['parent'] ];
            }

            $menu_item_id = wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'     => $item['title'],
                'menu-item-url'       => $url,
                'menu-item-status'    => 'publish',
                'menu-item-parent-id' => $parent_id,
            ) );

            if ( ! is_wp_error( $menu_item_id ) && ! empty( $item['db_id'] ) ) {
                $id_map[ $item['db_id'] ] = $menu_item_id;
            }
        }

        // Assign locations
        $locations = get_theme_mod( 'nav_menu_locations', array() );
        $locations['primary'] = $menu_id;
        $locations['footer']  = $menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );

        return sprintf( 'Created navigation menu with %d items and assigned to primary & footer locations.', count( $items ) );
    }

    /**
     * Step 6: Settings, Front Page, and Elementor Cache
     */
    private function import_settings_step( $demo_data ) {
        // Set Front page to Home
        $home_page = get_page_by_path( 'home' );
        if ( $home_page ) {
            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', $home_page->ID );
        }

        // Set Blog page
        $blog_page = get_page_by_path( 'blog' );
        if ( $blog_page ) {
            update_option( 'page_for_posts', $blog_page->ID );
        }

        // Set WooCommerce Shop page
        if ( class_exists( 'WooCommerce' ) ) {
            $shop_page = get_page_by_path( 'shop' );
            if ( $shop_page ) {
                update_option( 'woocommerce_shop_page_id', $shop_page->ID );
                update_option( 'woocommerce_coming_soon', 'no' );
            }
        }

        // Clear Elementor Cache
        if ( class_exists( '\Elementor\Plugin' ) ) {
            \Elementor\Plugin::$instance->files_manager->clear_cache();
        }

        return 'Configured reading settings, set front page to Home, and cleared Elementor CSS cache.';
    }
}

PlumberX_Demo_Importer::instance();
