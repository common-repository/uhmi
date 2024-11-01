<?php

/**
 * Add Uhmi column.
 *
 * @param  array  $columns
 * @return array
 */
function uhmi__add_column($columns)
{
	$new_columns = array();
	$before = 'author'; // Set Uhmi before this column

	foreach($columns as $key => $value) {

		if ($key == $before) {
			$new_columns['uhmi'] = 'Uhmi';
		}

		$new_columns[$key] = $value;
	}

	return $new_columns;
}

add_filter( 'manage_posts_columns', 'uhmi__add_column' );
add_filter( 'manage_pages_columns', 'uhmi__add_column' );

/**
 * Set Uhmi column value.
 *
 * @param  string  $column
 * @param  int     $post_id
 * @return string
 */
function uhmi__set_column_value($column, $post_id)
{
	switch ($column) {
		case 'uhmi':

			$active = get_post_meta( $post_id, 'uhmi_is_active', true );

			if (is_numeric($active)) {
				echo esc_html( number_format_i18n( (float) $active, 2 ) );
			} else {
				echo '—';
			}

			break;
	}
}

add_action( 'manage_post_posts_custom_column', 'uhmi__set_column_value', 10, 2 );
add_action( 'manage_page_posts_custom_column', 'uhmi__set_column_value', 10, 2 );

/**
 * Set sortable Uhmi column.
 *
 * @param  array  $columns
 * @return array
 */
function uhmi__set_sortable_columns($columns)
{
	$columns['uhmi'] = 'uhmi';

	return $columns;
}

add_filter( 'manage_edit-post_sortable_columns', 'uhmi__set_sortable_columns' );
add_filter( 'manage_edit-page_sortable_columns', 'uhmi__set_sortable_columns' );

/**
 * Set orderby for Uhmi column.
 *
 * @param  object  $query
 * @return void
 */
function uhmi__set_orderby($query)
{
	global $pagenow;

	if ($pagenow !== 'edit.php' && $query->query['post_type'] !== 'post' && $query->query['post_type'] !== 'page') {
		return;
	}

	$orderby = $query->get('orderby');

	switch ($orderby) {
		case 'uhmi':
			$query->set( 'meta_query', array(
				'relation' => 'OR',
				array(
					'key' => 'uhmi_is_active',
					'compare' => 'NOT EXISTS',
				),
				array(
					'key' => 'uhmi_is_active',
					'type' => 'numeric',
					'compare' => '=',
				)
			));

			$query->set( 'orderby', 'meta_value_num' );
			break;
	}
}

add_action( 'pre_get_posts', 'uhmi__set_orderby' );
add_action( 'pre_get_pages', 'uhmi__set_orderby' );
