<?php
/**
 * Plugin Name: Metabox_5
 * Plugin URI:  Plugin URL Link
 * Author:      Plugin Author Name
 * Author URI:  Plugin Author Link
 * Description: This plugin make for pratice wich is "Metabox_4".
 * Version:     0.1.0
 * License:     GPL-2.0+
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: mb_5
 */
// Languages file loaded
function plugin_loaded_function(){
    load_plugin_textdomain('mb_5', false, dirname(__FILE__)."/languages");
}
add_action('plugins_loaded','plugin_loaded_function');

// Registration meta box
function metabox_registration_function(){
    add_meta_box('metabox_5', __('Your Info:','mb_5'), "metabox_registarin","post");
}
add_action('admin_init','metabox_registration_function');

//Add meta fild
function metabox_registarin($post){
    wp_nonce_field('your_info', 'your_info_function');
    $label_1 = __('Your Name','mb_5');
    $label_2 = __('Your like post:','mb_5');
    $value_1 = get_post_meta($post->ID,'save_meta_name',true);
    $meta_html = <<<EOD
    <div>
    <label for="metabox_1_name">{$label_1}</label>
    <input value='{$value_1}' id='metabox_1_name' type='text' name='name'/>

    <br>
    <br>
    <label for="sum_1">{$label_2}</label>
    <input id="sum_1" type="checkbox" value="Submit" name='chbx'/>
    </div>
    EOD;
    echo $meta_html;
}
// Save meta data
function save_meta_data($post_ID){
    // save action
if(array_key_exists('name',$_POST)){
    update_post_meta($post_ID, 'save_meta_name', $_POST['name']);
}
if(!isset($_POST['your_info_function'])|| !wp_verify_nonce($_POST['your_info_function'], your_info)){
    return;
}
//Paremission to save
if(!current_user_can('edit_post',$post_ID)){
    return;
}
//AutoSave
if(defined('DOING_AUTOSAVE')&& DOING_AUTOSAVE){
    return;
}
}
add_action('save_post','save_meta_data');



?>