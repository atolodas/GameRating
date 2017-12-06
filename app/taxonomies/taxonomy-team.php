<?php
namespace Taxonomy;
use Optilab;
// Register Custom Taxonomy
function taxonomy_team() {

	$labels = array(
		'name'                       => _x( 'Teams', 'Taxonomy General Name', 'optilab' ),
		'singular_name'              => _x( 'Team', 'Taxonomy Singular Name', 'optilab' ),
		'menu_name'                  => __( 'Teams', 'optilab' ),
		'all_items'                  => __( 'All Teams', 'optilab' ),
		'parent_item'                => __( 'Parent Team', 'optilab' ),
		'parent_item_colon'          => __( 'Parent Team:', 'optilab' ),
		'new_item_name'              => __( 'New Team Name', 'optilab' ),
		'add_new_item'               => __( 'Add New Team', 'optilab' ),
		'edit_item'                  => __( 'Edit Team', 'optilab' ),
		'update_item'                => __( 'Update Team', 'optilab' ),
		'view_item'                  => __( 'View Team', 'optilab' ),
		'separate_items_with_commas' => __( 'Separate teams with commas', 'optilab' ),
		'add_or_remove_items'        => __( 'Add or remove teams', 'optilab' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'optilab' ),
		'popular_items'              => __( 'Popular Teams', 'optilab' ),
		'search_items'               => __( 'Search Teams', 'optilab' ),
		'not_found'                  => __( 'Not Found', 'optilab' ),
		'no_terms'                   => __( 'No teams', 'optilab' ),
		'items_list'                 => __( 'Teams list', 'optilab' ),
		'items_list_navigation'      => __( 'Teams list navigation', 'optilab' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'show_in_rest'               => true,
		'order_by'					=> 'term_order'
	);
	register_taxonomy( 'team', array( 'game' ), $args );
}
add_action( 'init', __NAMESPACE__ . '\\taxonomy_team', 0 );

add_action( 'team_add_form_fields', function($taxonomy) {
	?>
  <div class="form-field term-short_name-wrap">
    <label for="short_name"><?php _e( 'Team Short Name', 'sage' ); ?>
	<input type="text" name="short_name" id="shortName" value="">
	<p class="description"><?php _e( 'Short name for team','sage' ); ?></p>
  </div>
<?php
});

add_action( 'team_edit_form_fields', function($term) {
  $short_name = get_term_meta( $term->term_id, 'short_name', true );
?>
  <tr class="form-field term-short_name-wrap">
    <th scope="row"><label for="short_name"><?php _e( 'Team Short Name', 'sage' ); ?></th>
    <td>
      <input type="text" name="short_name" id="short_name" value="<?= $short_name; ?>">
      <p class="description"><?php _e( 'Short name for team','sage' ); ?></p>
    </td>
  </tr>
<?php
});

/** Save Custom Field Of Category Form */
add_action( 'created_team', __NAMESPACE__ . '\\team_form_custom_field_save', 10, 2 );
add_action( 'edited_team', __NAMESPACE__ . '\\team_form_custom_field_save', 10, 2 );
function team_form_custom_field_save( $term_id, $tt_id ) {
    if ( isset( $_POST['short_name'] ) ) {
      update_term_meta( $term_id, 'short_name', $_POST['short_name'] );
    }
}