<?php
/**
 * Hero Section Template Part
 *
 * @package PlumberX
 */

$hero_subtitle = get_theme_mod( 'plumberx_hero_subtitle', 'Expertise' );
$hero_title    = get_theme_mod( 'plumberx_hero_title', 'You Can Trust' );
$hero_desc     = get_theme_mod( 'plumberx_hero_desc', 'Our plumbing professionals are thoroughly trained to assess the situation and effectively respond in a way that treats the source of the problems.' );
$hero_image    = get_theme_mod( 'plumberx_hero_image' );
if ( ! $hero_image ) {
    $hero_image = PLUMBERX_URI . '/assets/images/home_hero_plumber.png';
}
?>

<!-- Hero Section -->
<section class="home-hero">
  <div class="container hero-grid">
    <div class="hero-text-col">
      <h2 class="hero-subtitle"><?php echo esc_html( $hero_subtitle ); ?></h2>
      <h1 class="hero-title"><?php echo esc_html( $hero_title ); ?></h1>
      <p class="hero-desc"><?php echo esc_html( $hero_desc ); ?></p>
      <a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="btn-hero-learn"><?php esc_html_e( 'Learn More', 'plumberx' ); ?></a>
    </div>

    <div class="hero-plumber-col">
      <img src="<?php echo esc_url( $hero_image ); ?>" alt="<?php esc_attr_e( 'Expert Plumber', 'plumberx' ); ?>" class="hero-plumber-img">
    </div>

    <div class="hero-form-col">
      <div class="hero-quote-card">
        <div class="quote-tabs">
          <button class="quote-tab-btn active" data-type="residential"><?php esc_html_e( 'RESIDENTIAL', 'plumberx' ); ?></button>
          <button class="quote-tab-btn" data-type="commercial"><?php esc_html_e( 'COMMERCIAL', 'plumberx' ); ?></button>
        </div>
        <div class="quote-form-body">
          <h3 class="quote-form-header"><?php esc_html_e( 'REQUEST A FREE QUOTE', 'plumberx' ); ?></h3>
          <form id="heroQuoteForm">
            <input type="hidden" id="quoteServiceType" value="residential">
            <div class="form-group">
              <input type="text" class="form-input" placeholder="<?php esc_attr_e( 'Name:', 'plumberx' ); ?>" required>
            </div>
            <div class="form-group">
              <input type="email" class="form-input" placeholder="<?php esc_attr_e( 'Email:', 'plumberx' ); ?>" required>
            </div>
            <div class="form-group">
              <input type="tel" class="form-input" placeholder="<?php esc_attr_e( 'Phone:', 'plumberx' ); ?>" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-input" placeholder="<?php esc_attr_e( 'City:', 'plumberx' ); ?>" required>
            </div>
            <button type="submit" class="btn-quote-submit"><?php esc_html_e( 'GET A QUOTE', 'plumberx' ); ?></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
