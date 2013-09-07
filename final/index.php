<?php
/*
Plugin Name: CatIcon
Description: Adds category-based icons next to post titles.
Version: 1.0
Author: Novalyyn
Author URI: http://webcrittercreative.com
*/

// Created with heavy referencing of http://pippinsplugins.com/adding-custom-meta-fields-to-taxonomies/


/******************
** TO DO:
** !- i18n
** !- improve security
** !- make it easy to adjust styles to fit
** - display image by cat in admin cat page
** - better removal of "next/last post" icon
** - enforce size & shape consistency
** - allow icon selection for multi-cat posts
** - allow multi-icon display
** - ensure input is a complete link to an image
******************/


//Bring in styles
function blj_caticon_styles() {
  wp_enqueue_style( 'caticon', plugins_url( 'caticon-styles.css', __FILE__ ) );
}

add_action( 'wp_enqueue_scripts', 'blj_caticon_styles' );

// Add input to new term page
function blj_new_add_icon_field() {
  wp_nonce_field( plugins_url( __FILE__ ), 'blj_noncename' );
  ?>
  <div class="form-field">
    <label for="caticon"><?php _e( 'Icon URL', 'novalyyn' ); ?></label>
    <input type="text" name="term_meta[blj_caticon_value]" id="caticon" value="">
    <p class="description"><?php _e( 'Enter the complete image URL','novalyyn' ); ?></p>
  </div>
<?php
}

add_action( 'category_add_form_fields', 'blj_new_add_icon_field', 10, 2 );

// Add input to edit term page
function blj_edit_add_icon_field($term) {
  wp_nonce_field( plugins_url( __FILE__ ), 'blj_noncename' );
  $t_id = $term->term_id;
  $term_meta = get_option( "taxonomy_$t_id" ); ?>
  <tr class="form-field">
  <th scope="row" valign="top"><label for="caticon"><?php _e( 'Icon URL', 'novalyyn' ); ?></label></th>
    <td>
      <input type="text" name="term_meta[blj_caticon_value]" id="caticon" value="<?php echo esc_attr( $term_meta['blj_caticon_value'] ) ? esc_attr( $term_meta['blj_caticon_value'] ) : ''; ?>">
      <p class="description"><?php _e( 'Enter the complete image URL','novalyyn' ); ?></p>
    </td>
  </tr>
<?php
}

add_action( 'category_edit_form_fields', 'blj_edit_add_icon_field', 10, 2 );

// Save fields
//Check security against teacher's
function blj_save_icon_url( $term_id ) {
  if ( isset( $_POST['term_meta'] ) ) {
    $t_id = $term_id;
    $term_meta = get_option( "taxonomy_$t_id" );
    $cat_keys = array_keys( $_POST['term_meta'] );
    foreach ( $cat_keys as $key ) {
      if ( isset ( $_POST['term_meta'][$key] ) ) {
        $term_meta[$key] = $_POST['term_meta'][$key];
      }
    }
    if ( isset( $_POST[ 'blj_noncename' ] ) && wp_verify_nonce( $_POST[ 'blj_noncename' ], plugins_url( __FILE__ ) ) ) {
      update_option( "taxonomy_$t_id", $term_meta );
    }
  }
}  

add_action( 'edited_category', 'blj_save_icon_url', 10, 2 );  
add_action( 'create_category', 'blj_save_icon_url', 10, 2 );

function blj_display_icon( $title ) {
  //only displays first category
  //only show on/for single posts
  if ( is_single() && in_the_loop() ) {
    //steps to get cat icon value
    $s1 = get_the_category();
    $s2 = $s1[0]->term_id;
    $s3 = get_option( "taxonomy_$s2" );
    $cat_url = $s3['blj_caticon_value'];
    //check for value to show
    if ( $cat_url ) {
      $cat_icon = '<img src="' . esc_url( $cat_url ) . '" alt="' . esc_attr( $s1[0]->name ) . '" title="' . esc_attr( $s1[0]->name ) . '" class="blj-caticon" />';
      $title = $cat_icon . $title;
    }
  }

  return $title;
}

add_filter( 'the_title', 'blj_display_icon' );