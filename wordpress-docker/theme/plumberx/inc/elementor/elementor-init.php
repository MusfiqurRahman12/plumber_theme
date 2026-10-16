<?php
/**
 * Elementor Custom Widgets & Extensions Integration
 *
 * Provides drag-and-drop Elementor widgets with dynamic fields
 * for editing every homepage and theme section.
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Elementor_Extension {

    private static $_instance = null;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        // Register Widget Category
        add_action( 'elementor/elements/categories_registered', array( $this, 'add_widget_categories' ) );

        // Register Widgets
        add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );

        // Enqueue styles in Elementor editor preview
        add_action( 'elementor/preview/enqueue_styles', function() {
            wp_enqueue_style( 'plumberx-main', PLUMBERX_URI . '/assets/css/style.css', array(), PLUMBERX_VERSION );
        } );

        // Enqueue scripts in Elementor editor preview
        add_action( 'elementor/preview/enqueue_scripts', function() {
            wp_enqueue_script( 'plumberx-main-js', PLUMBERX_URI . '/assets/js/main.js', array(), PLUMBERX_VERSION, true );
        } );
    }

    /**
     * Add custom category for PlumberX widgets
     */
    public function add_widget_categories( $elements_manager ) {
        $elements_manager->add_category(
            'plumberx-elements',
            array(
                'title' => esc_html__( 'PlumberX Elements', 'plumberx' ),
                'icon'  => 'fa fa-wrench',
            )
        );
    }

    /**
     * Register Custom Elementor Widgets
     */
    public function register_widgets( $widgets_manager ) {
        // Include widget files
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/hero-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/promo-strip-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/certified-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/services-tabs-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/projects-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/coupon-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/team-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/testimonials-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/emergency-banner-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/blog-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/partners-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/subpage-banner-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/about-mission-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/about-features-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/service-expertise-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/featured-services-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/services-grid-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/services-icon-grid-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/service-details-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/projects-gallery-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/case-study-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/pricing-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/blog-hero-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/blog-list-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/contact-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/shop-hero-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/shop-highlights-widget.php';
        require_once PLUMBERX_DIR . '/inc/elementor/widgets/shop-products-widget.php';

        // Register with manager
        $widgets_manager->register( new \PlumberX_Hero_Widget() );
        $widgets_manager->register( new \PlumberX_Promo_Strip_Widget() );
        $widgets_manager->register( new \PlumberX_Certified_Widget() );
        $widgets_manager->register( new \PlumberX_Services_Tabs_Widget() );
        $widgets_manager->register( new \PlumberX_Projects_Widget() );
        $widgets_manager->register( new \PlumberX_Coupon_Widget() );
        $widgets_manager->register( new \PlumberX_Team_Widget() );
        $widgets_manager->register( new \PlumberX_Testimonials_Widget() );
        $widgets_manager->register( new \PlumberX_Emergency_Banner_Widget() );
        $widgets_manager->register( new \PlumberX_Blog_Widget() );
        $widgets_manager->register( new \PlumberX_Partners_Widget() );
        $widgets_manager->register( new \PlumberX_Subpage_Banner_Widget() );
        $widgets_manager->register( new \PlumberX_About_Mission_Widget() );
        $widgets_manager->register( new \PlumberX_About_Features_Widget() );
        $widgets_manager->register( new \PlumberX_Service_Expertise_Widget() );
        $widgets_manager->register( new \PlumberX_Featured_Services_Widget() );
        $widgets_manager->register( new \PlumberX_Services_Grid_Widget() );
        $widgets_manager->register( new \PlumberX_Services_Icon_Grid_Widget() );
        $widgets_manager->register( new \PlumberX_Service_Details_Widget() );
        $widgets_manager->register( new \PlumberX_Projects_Gallery_Widget() );
        $widgets_manager->register( new \PlumberX_Case_Study_Widget() );
        $widgets_manager->register( new \PlumberX_Pricing_Widget() );
        $widgets_manager->register( new \PlumberX_Blog_Hero_Widget() );
        $widgets_manager->register( new \PlumberX_Blog_List_Widget() );
        $widgets_manager->register( new \PlumberX_Contact_Widget() );
        $widgets_manager->register( new \PlumberX_Shop_Hero_Widget() );
        $widgets_manager->register( new \PlumberX_Shop_Highlights_Widget() );
        $widgets_manager->register( new \PlumberX_Shop_Products_Widget() );
    }
}

// Initialize when Elementor is loaded
function plumberx_elementor_init() {
    PlumberX_Elementor_Extension::instance();
}
add_action( 'elementor/init', 'plumberx_elementor_init' );
