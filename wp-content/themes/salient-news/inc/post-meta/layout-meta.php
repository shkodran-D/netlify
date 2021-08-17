<?php
/**
 * salient-news Custom Metabox
 *
 * @package salient-news
 */
$salient_news_post_types = array(
    'post',
    'page'
);

add_action('add_meta_boxes', 'salient_news_add_layout_metabox');
function salient_news_add_layout_metabox() {
    global $post;
    $frontpage_id = get_option('page_on_front');
    if( $post->ID == $frontpage_id ){
        return;
    }

    global$salient_news_post_types;
    foreach ($salient_news_post_types as $post_type ) {
        add_meta_box(
            'salient_news_layout_options', // $id
            __( 'Layout options', 'salient-news' ), // $title
            'salient_news_layout_options_callback', // $callback
            $post_type, // $page
            'normal', // $context
            'high'// $priority
        );
    }

}
/* salient-news sidebar layout */
$salient_news_default_layout_options = array(
    'left-sidebar' => array(
        'value'     => 'left-sidebar',
        'thumbnail' => get_template_directory_uri() . '/inc/images/left-sidebar.png'
    ),
    'right-sidebar' => array(
        'value' => 'right-sidebar',
        'thumbnail' => get_template_directory_uri() . '/inc/images/right-sidebar.png'
    ),
    'no-sidebar' => array(
        'value'     => 'no-sidebar',
        'thumbnail' => get_template_directory_uri() . '/inc/images/no-sidebar.png'
    )
);
/* salient-news featured layout */
$salient_news_single_post_image_align_options = array(
    'full' => array(
        'value' => 'full',
        'label' => __( 'Full', 'salient-news' )
    ),
    'right' => array(
        'value' => 'right',
        'label' => __( 'Right ', 'salient-news' ),
    ),
    'left' => array(
        'value'     => 'left',
        'label' => __( 'Left', 'salient-news' ),
    ),
    'no-image' => array(
        'value'     => 'no-image',
        'label' => __( 'No Image', 'salient-news' )
    )
);

function salient_news_layout_options_callback() {

    global $post ,$salient_news_default_layout_options,$salient_news_single_post_image_align_options;
   $salient_news_customizer_saved_values = salient_news_get_all_options(1);

    /*salient-news-single-post-image-align*/
   $salient_news_single_post_image_align =$salient_news_customizer_saved_values['salient-news-single-post-image-align'];

    /*salient-news default layout*/
   $salient_news_single_sidebar_layout =$salient_news_customizer_saved_values['salient-news-default-layout'];

    wp_nonce_field( basename( __FILE__ ), 'salient_news_layout_options_nonce' );
    ?>
    <table class="form-table page-meta-box">
        <!--Image alignment-->
        <tr>
            <td colspan="4"><em class="f13"><?php esc_html_e( 'Choose Sidebar Template', 'salient-news' ); ?></em></td>
        </tr>
        <tr>
            <td>
                <?php
               $salient_news_single_sidebar_layout_meta = get_post_meta( $post->ID, 'salient-news-default-layout', true );
                if( false !=$salient_news_single_sidebar_layout_meta ){
                  $salient_news_single_sidebar_layout =$salient_news_single_sidebar_layout_meta;
                }
                foreach ($salient_news_default_layout_options as $field) {
                    ?>
                    <div class="hide-radio radio-image-wrapper" style="float:left; margin-right:30px;">
                        <input id="<?php echo esc_attr( $field['value'] ); ?>" type="radio" name="salient-news-default-layout"
                               value="<?php echo esc_attr( $field['value'] ); ?>"
                            <?php checked( $field['value'],$salient_news_single_sidebar_layout ); ?>/>
                        <label class="description" for="<?php echo esc_attr( $field['value'] ); ?>">
                            <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" />
                        </label>
                    </div>
                <?php } // end foreach
                ?>
                <div class="clear"></div>
            </td>
        </tr>
        <tr>
            <td><em class="f13"><?php esc_html_e( 'You can set up the sidebar content', 'salient-news' ); ?> <a href="<?php echo esc_url( admin_url('/widgets.php') ); ?>"><?php esc_html_e( 'here', 'salient-news' ); ?></a></em></td>
        </tr>
        <!--Image alignment-->
        <tr>
            <td colspan="4"><?php esc_html_e( 'Featured Image Alignment', 'salient-news' ); ?></td>
        </tr>
        <tr>
            <td>
                <?php
               $salient_news_single_post_image_align_meta = get_post_meta( $post->ID, 'salient-news-single-post-image-align', true );
                if( false !=$salient_news_single_post_image_align_meta ){
                   $salient_news_single_post_image_align =$salient_news_single_post_image_align_meta;
                }
                foreach ($salient_news_single_post_image_align_options as $field) {
                    ?>
                    <input id="<?php echo esc_attr( $field['value'] ); ?>" type="radio" name="salient-news-single-post-image-align" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'],$salient_news_single_post_image_align ); ?>/>
                    <label class="description" for="<?php echo esc_attr( $field['value'] ); ?>">
                        <?php echo esc_html( $field['label'] ); ?>
                    </label>
                <?php } // end foreach
                ?>
                <div class="clear"></div>
            </td>
        </tr>
    </table>

<?php }

/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function salient_news_save_sidebar_layout( $post_id ) {
    global $post;
    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'salient_news_layout_options_nonce' ] ) || !wp_verify_nonce( sanitize_key($_POST[ 'salient_news_layout_options_nonce' ] ), basename( __FILE__ ) ) ) {
        return;
    }

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( !current_user_can( 'edit_page', $post_id ) ) {
        return $post_id;
    }
    
    if(isset($_POST['salient-news-default-layout'])){
        $old = get_post_meta( $post_id, 'salient-news-default-layout', true);
        $new = sanitize_text_field(wp_unslash($_POST['salient-news-default-layout']) );
        if ($new && $new != $old) {
            update_post_meta($post_id, 'salient-news-default-layout', $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id,'salient-news-default-layout', $old);
        }
    }

    /*image align*/
    if(isset($_POST['salient-news-single-post-image-align'])){
        $old = get_post_meta( $post_id, 'salient-news-single-post-image-align', true);
        $new = sanitize_text_field(wp_unslash( $_POST['salient-news-single-post-image-align']) );
        if ($new && $new != $old) {
            update_post_meta($post_id, 'salient-news-single-post-image-align', $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id,'salient-news-single-post-image-align', $old);
        }
    }
}
add_action('save_post', 'salient_news_save_sidebar_layout');
