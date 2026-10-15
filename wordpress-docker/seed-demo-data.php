<?php
/**
 * Seeding Script for PlumberX Demo Content
 */

// 1. Create WooCommerce Sample Products
if ( class_exists( 'WC_Product_Simple' ) ) {
    $products = array(
        array(
            'name'        => 'High-Arc Commercial Kitchen Faucet',
            'price'       => '189.00',
            'description' => 'Solid brass high-arc commercial kitchen faucet with dual-mode pull-down spray wand and corrosion-resistant brushed nickel finish.',
            'category'    => 'Faucets & Fixtures',
        ),
        array(
            'name'        => 'Heavy Duty Submersible Sump Pump 1/2 HP',
            'price'       => '249.50',
            'description' => 'Industrial grade cast iron submersible sump pump with vertical float switch. Pumps up to 4,200 gallons per hour.',
            'category'    => 'Pumps & Drainage',
        ),
        array(
            'name'        => 'Tankless Ultra-Efficient Hot Water Heater',
            'price'       => '599.00',
            'description' => 'Indoor condensing tankless water heater providing continuous on-demand hot water with smart digital temperature control.',
            'category'    => 'Water Heaters',
        ),
        array(
            'name'        => 'Professional Cast Iron Pipe Wrench 14-Inch',
            'price'       => '34.99',
            'description' => 'Heavy-duty plumber pipe wrench featuring hardened alloy steel jaws with precision self-cleaning threads.',
            'category'    => 'Plumbing Tools',
        ),
        array(
            'name'        => 'Dual-Flush Water-Saving Toilet Suite',
            'price'       => '320.00',
            'description' => 'Comfort-height elongated dual flush toilet suite with powerful siphon jet flushing action and soft-close seat.',
            'category'    => 'Toilets & Bidets',
        ),
        array(
            'name'        => 'Lead-Free Brass Backflow Preventer Valve',
            'price'       => '75.00',
            'description' => 'Commercial grade reduced pressure principle backflow preventer for drinking water protection.',
            'category'    => 'Valves & Fittings',
        ),
    );

    foreach ( $products as $p ) {
        $existing = get_page_by_title( $p['name'], OBJECT, 'product' );
        if ( ! $existing ) {
            $product = new WC_Product_Simple();
            $product->set_name( $p['name'] );
            $product->set_regular_price( $p['price'] );
            $product->set_description( $p['description'] );
            $product->set_short_description( wp_trim_words( $p['description'], 15 ) );
            $product->set_status( 'publish' );
            $product->set_catalog_visibility( 'visible' );
            $product->save();
            echo "Created Product: " . $p['name'] . "\n";
        }
    }
}

// 2. Create Sample Services
$services = array(
    array(
        'title'     => 'Kitchen Plumbing',
        'desc'      => 'From garbage disposals to faucet installations and leak detection, we keep your kitchen flowing smoothly with zero hassle.',
        'checklist' => "Diagnosis and Check-ups\nInstallations and Upgrades\nSystem Maintenance\nClog Clearing & Pipe Repair",
    ),
    array(
        'title'     => 'Bathroom Plumbing',
        'desc'      => 'Expert repairs and installations for toilets, sinks, showers, bathtubs, and concealed in-wall water supply piping.',
        'checklist' => "Toilet Installation & Repair\nShower Valve Replacement\nFaucet & Sink Upgrades\nBathroom Remodel Rough-in",
    ),
    array(
        'title'     => 'Drain Cleaning & Hydro-Jetting',
        'desc'      => 'High-pressure hydro-jetting and advanced video camera inspections clear tree roots, grease, and heavy blockages completely.',
        'checklist' => "High-Pressure Hydro Jetting\nHD Video Sewer Inspection\nRoot Intrusion Removal\nPreventative Drain Treatment",
    ),
    array(
        'title'     => 'Water Heater Services',
        'desc'      => 'Same-day repair and replacement for conventional tank and modern energy-efficient tankless water heating systems.',
        'checklist' => "Tankless System Installations\nEmergency Element Replacement\nAnode Rod Inspection\nAnnual Flush & Descaling",
    ),
);

foreach ( $services as $s ) {
    $existing = get_page_by_title( $s['title'], OBJECT, 'plumberx_service' );
    if ( ! $existing ) {
        $post_id = wp_insert_post( array(
            'post_title'   => $s['title'],
            'post_content' => $s['desc'],
            'post_excerpt' => wp_trim_words( $s['desc'], 20 ),
            'post_type'    => 'plumberx_service',
            'post_status'  => 'publish',
        ) );
        if ( $post_id ) {
            update_post_meta( $post_id, '_service_checklist', $s['checklist'] );
            echo "Created Service: " . $s['title'] . "\n";
        }
    }
}

// 3. Create Sample Projects
$projects = array(
    array( 'title' => 'Commercial Piping System', 'subtitle' => 'Commercial Plumbing', 'cat' => 'commercial' ),
    array( 'title' => 'Residential Kitchen Remodel', 'subtitle' => 'Residential Plumbing', 'cat' => 'residential' ),
    array( 'title' => 'Underground Sewer Line Overhaul', 'subtitle' => 'Emergency Excavation', 'cat' => 'emergency' ),
    array( 'title' => 'Industrial Boiler & Manifold Piping', 'subtitle' => 'Industrial Plumbing', 'cat' => 'industrial' ),
    array( 'title' => 'Luxury Hotel Fixture Upgrades', 'subtitle' => 'Commercial Plumbing', 'cat' => 'commercial' ),
    array( 'title' => 'Suburban Home Water Filtration', 'subtitle' => 'Residential Plumbing', 'cat' => 'residential' ),
    array( 'title' => 'Restaurant Grease Trap System', 'subtitle' => 'Commercial Plumbing', 'cat' => 'commercial' ),
    array( 'title' => 'Rapid Storm Drain Clearing', 'subtitle' => 'Emergency Service', 'cat' => 'emergency' ),
);

foreach ( $projects as $pr ) {
    $existing = get_page_by_title( $pr['title'], OBJECT, 'plumberx_project' );
    if ( ! $existing ) {
        $post_id = wp_insert_post( array(
            'post_title'   => $pr['title'],
            'post_type'    => 'plumberx_project',
            'post_status'  => 'publish',
        ) );
        if ( $post_id ) {
            update_post_meta( $post_id, '_project_subtitle', $pr['subtitle'] );
            wp_set_object_terms( $post_id, $pr['cat'], 'project_category', true );
            echo "Created Project: " . $pr['title'] . "\n";
        }
    }
}

// 4. Create Sample Team Members
$team = array(
    array( 'name' => 'Michale Rock', 'role' => 'Plumbing Mechanic' ),
    array( 'name' => 'Rock Lelu', 'role' => 'Master Plumber' ),
    array( 'name' => 'Tim Cock', 'role' => 'Pipe Specialist' ),
    array( 'name' => 'David Vance', 'role' => 'Diagnostic Technician' ),
);

foreach ( $team as $tm ) {
    $existing = get_page_by_title( $tm['name'], OBJECT, 'plumberx_team' );
    if ( ! $existing ) {
        $post_id = wp_insert_post( array(
            'post_title'  => $tm['name'],
            'post_type'   => 'plumberx_team',
            'post_status' => 'publish',
        ) );
        if ( $post_id ) {
            update_post_meta( $post_id, '_team_role', $tm['role'] );
            echo "Created Team Member: " . $tm['name'] . "\n";
        }
    }
}

// 5. Create Sample Testimonials
$testimonials = array(
    array(
        'name'     => 'Sarah Jenkins',
        'location' => 'Austin, TX',
        'service'  => 'Emergency Pipe Burst',
        'rating'   => '5',
        'content'  => 'Arrived within 35 minutes on a Sunday night when our main pipe burst. Extremely professional and courteous!',
    ),
    array(
        'name'     => 'Marcus Vance',
        'location' => 'Round Rock, TX',
        'service'  => 'Commercial Hydro-Jetting',
        'rating'   => '5',
        'content'  => 'Our restaurant kitchen lines were fully backed up. PlumberX arrived with high-pressure hydro-jetters and resolved the issue before the dinner rush.',
    ),
    array(
        'name'     => 'Elena Rostova',
        'location' => 'Cedar Park, TX',
        'service'  => 'Tankless Water Heater',
        'rating'   => '5',
        'content'  => 'Flawless install, polite crew, and upfront flat-rate pricing. Exactly what they quoted with no hidden surprise charges!',
    ),
    array(
        'name'     => 'Robert Fox',
        'location' => 'Westlake Hills, TX',
        'service'  => 'Sump Pump Replacement',
        'rating'   => '5',
        'content'  => 'Saved our basement from severe flooding during the storm. Top tier equipment and master craftsmanship.',
    ),
);

foreach ( $testimonials as $ts ) {
    $existing = get_page_by_title( $ts['name'], OBJECT, 'plumberx_testimonial' );
    if ( ! $existing ) {
        $post_id = wp_insert_post( array(
            'post_title'   => $ts['name'],
            'post_content' => $ts['content'],
            'post_type'    => 'plumberx_testimonial',
            'post_status'  => 'publish',
        ) );
        if ( $post_id ) {
            update_post_meta( $post_id, '_testimonial_location', $ts['location'] );
            update_post_meta( $post_id, '_testimonial_service_type', $ts['service'] );
            update_post_meta( $post_id, '_testimonial_rating', $ts['rating'] );
            update_post_meta( $post_id, '_testimonial_verified', '1' );
            update_post_meta( $post_id, '_testimonial_badge_text', 'Verified Customer' );
            echo "Created Testimonial: " . $ts['name'] . "\n";
        }
    }
}

echo "Seeding completed successfully!\n";
