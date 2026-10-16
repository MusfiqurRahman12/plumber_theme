<?php
/**
 * Elementor Widget: PlumberX Team Specialists
 *
 * @package PlumberX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PlumberX_Team_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'plumberx_team';
    }

    public function get_title() {
        return esc_html__( 'PlumberX: Team Specialists', 'plumberx' );
    }

    public function get_icon() {
        return 'eicon-person';
    }

    public function get_categories() {
        return array( 'plumberx-elements' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'header_section',
            array(
                'label' => esc_html__( 'Section Header', 'plumberx' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'section_title',
            array(
                'label'   => esc_html__( 'Section Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Meet Our Specialists', 'plumberx' ),
            )
        );

        $this->add_control(
            'source',
            array(
                'label'   => esc_html__( 'Data Source', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'cpt',
                'options' => array(
                    'cpt'    => esc_html__( 'Dynamic: Team Members CPT', 'plumberx' ),
                    'manual' => esc_html__( 'Manual: Custom Repeater Members', 'plumberx' ),
                ),
            )
        );

        $this->end_controls_section();

        // Repeater for manual members
        $this->start_controls_section(
            'members_section',
            array(
                'label'     => esc_html__( 'Custom Members', 'plumberx' ),
                'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => array( 'source' => 'manual' ),
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'member_name',
            array(
                'label'   => esc_html__( 'Name', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Tim Cock', 'plumberx' ),
            )
        );

        $repeater->add_control(
            'member_role',
            array(
                'label'   => esc_html__( 'Role / Title', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Plumbing Mechanic', 'plumberx' ),
            )
        );

        $repeater->add_control(
            'member_photo',
            array(
                'label'   => esc_html__( 'Photo', 'plumberx' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => PLUMBERX_URI . '/assets/images/team_tim_cock.png',
                ),
            )
        );

        $this->add_control(
            'custom_members',
            array(
                'label'       => esc_html__( 'Team Members', 'plumberx' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ member_name }}} - {{{ member_role }}}',
                'default'     => array(
                    array( 'member_name' => 'Tim Cock', 'member_role' => 'Plumbing Mechanic' ),
                    array( 'member_name' => 'Rock Lelu', 'member_role' => 'Plumbing Mechanic' ),
                    array( 'member_name' => 'Michale Rock', 'member_role' => 'Plumbing Mechanic' ),
                    array( 'member_name' => 'Rock Lelu', 'member_role' => 'Plumbing Mechanic' ),
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $source   = $settings['source'];
        $members  = array();

        if ( 'cpt' === $source ) {
            $team_query = plumberx_get_team_members( 4 );
            if ( $team_query->have_posts() ) {
                $idx = 0;
                $fallback_imgs = array( 'team_tim_cock.png', 'team_rock_lelu.png', 'team_michale_rock.png', 'team_rock_lelu_2.png' );
                while ( $team_query->have_posts() ) {
                    $team_query->the_post();
                    $idx++;
                    $members[] = array(
                        'name'  => get_the_title(),
                        'role'  => get_post_meta( get_the_ID(), '_team_role', true ) ?: 'Plumbing Mechanic',
                        'photo' => get_the_post_thumbnail_url( get_the_ID(), 'plumberx-team' ) ?: PLUMBERX_URI . '/assets/images/' . $fallback_imgs[ ( $idx - 1 ) % 4 ],
                    );
                }
                wp_reset_postdata();
            }
        } else {
            foreach ( $settings['custom_members'] as $m ) {
                $members[] = array(
                    'name'  => $m['member_name'],
                    'role'  => $m['member_role'],
                    'photo' => ! empty( $m['member_photo']['url'] ) ? $m['member_photo']['url'] : PLUMBERX_URI . '/assets/images/team_tim_cock.png',
                );
            }
        }

        if ( empty( $members ) ) {
            $members = array(
                array( 'name' => 'Tim Cock', 'role' => 'Plumbing Mechanic', 'photo' => PLUMBERX_URI . '/assets/images/team_tim_cock.png' ),
                array( 'name' => 'Rock Lelu', 'role' => 'Plumbing Mechanic', 'photo' => PLUMBERX_URI . '/assets/images/team_rock_lelu.png' ),
                array( 'name' => 'Michale Rock', 'role' => 'Plumbing Mechanic', 'photo' => PLUMBERX_URI . '/assets/images/team_michale_rock.png' ),
                array( 'name' => 'Rock Lelu', 'role' => 'Plumbing Mechanic', 'photo' => PLUMBERX_URI . '/assets/images/team_rock_lelu_2.png' ),
            );
        }
        ?>
        <section class="team-section">
          <div class="container">
            <?php if ( ! empty( $settings['section_title'] ) ) : ?>
              <div class="section-header">
                <h2 class="section-title decorated"><?php echo esc_html( $settings['section_title'] ); ?></h2>
              </div>
            <?php endif; ?>

            <div class="team-grid">
              <?php foreach ( $members as $member ) : ?>
                <div class="team-card">
                  <div class="team-img-wrap">
                    <img src="<?php echo esc_url( $member['photo'] ); ?>" alt="<?php echo esc_attr( $member['name'] ); ?>">
                  </div>
                  <div class="team-banner">
                    <h3 class="team-name"><?php echo esc_html( $member['name'] ); ?></h3>
                    <p class="team-role"><?php echo esc_html( $member['role'] ); ?></p>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </section>
        <?php
    }
}
