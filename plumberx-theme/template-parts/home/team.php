<?php
/**
 * Team Section Template Part
 * @package PlumberX
 */
$team = plumberx_get_team_members( 4 );
?>
<section class="team-section">
  <div class="container">
    <?php plumberx_section_header( 'Meet Our Specialists', '', true ); ?>

    <div class="team-grid">
      <?php if ( $team->have_posts() ) : while ( $team->have_posts() ) : $team->the_post();
        $role = get_post_meta( get_the_ID(), '_team_role', true );
      ?>
        <div class="team-card">
          <?php if ( has_post_thumbnail() ) : ?>
          <div class="team-img-wrap">
            <?php the_post_thumbnail( 'plumberx-team' ); ?>
          </div>
          <?php endif; ?>
          <div class="team-banner">
            <h3 class="team-name"><?php the_title(); ?></h3>
            <?php if ( $role ) : ?>
              <p class="team-role"><?php echo esc_html( $role ); ?></p>
            <?php endif; ?>
          </div>
        </div>
      <?php endwhile; wp_reset_postdata(); else : ?>
        <!-- Fallback static team -->
        <?php
        $fallback_team = array(
            array( 'name' => 'Tim Cock', 'role' => 'Plumbing Mechanic', 'img' => 'team_tim_cock.png' ),
            array( 'name' => 'Rock Lelu', 'role' => 'Plumbing Mechanic', 'img' => 'team_rock_lelu.png' ),
            array( 'name' => 'Michale Rock', 'role' => 'Plumbing Mechanic', 'img' => 'team_michale_rock.png' ),
            array( 'name' => 'Rock Lelu', 'role' => 'Plumbing Mechanic', 'img' => 'team_rock_lelu_2.png' ),
        );
        foreach ( $fallback_team as $member ) :
        ?>
        <div class="team-card">
          <div class="team-img-wrap">
            <img src="<?php echo PLUMBERX_URI; ?>/assets/images/<?php echo esc_attr( $member['img'] ); ?>" alt="<?php echo esc_attr( $member['name'] ); ?>">
          </div>
          <div class="team-banner">
            <h3 class="team-name"><?php echo esc_html( $member['name'] ); ?></h3>
            <p class="team-role"><?php echo esc_html( $member['role'] ); ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>
