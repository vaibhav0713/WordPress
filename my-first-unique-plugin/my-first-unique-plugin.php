<?php
/**
 * Plugin Name:       My First Unique Plugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Vaibhav Panchal
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */

class wordCountAndTimePlugin{

    function __construct(){   
        add_action('admin_menu', array($this, 'adminPage'));
        add_action('admin_init', array($this, 'settings'));
        add_action('the_content', array($this, 'ifWrap'));
    }

    function ifWrap($content){
        if(
                is_single() AND
                is_main_query() AND
                (get_option('wcp_word_count', '1')) OR
                (get_option('wcp_read_time', '1')) OR
                (get_option('wcp_char_count', '1'))
            ){
                return $this -> createHTML($content);
        }
        return $content;
    }

    function createHTML($content){
        // return $content . 'hello';
        $html = '<h3>' . get_option('wcp_heading_text', 'Post Statistics') . '</h3> <p?>';

        if(get_option('wcp_word_count', '1') OR get_option('wcp_read_time', '1')){
            $wordCount = str_word_count(strip_tags($content));
        }

        if(get_option('wcp_word_count', '1')){
            $html .= 'This post has ' . $wordCount . ' words. <br>';
        }

        if(get_option('wcp_char_count', '1')){
            $html .= 'This post has ' . strlen(strip_tags($content)) . ' characters. <br>';
        }

        if(get_option('wcp_read_time', '1')){
            $html .= 'This post will take ' . round($wordCount/100) . ' minute(s) to read. <br>';
        }

        if(get_option('wcp_location', '0') == '0'){
            return $html . $content;
        }
        return $content . $html;

        $html .= '</p>';
    }

    function settings(){
        add_settings_section('wcp_first_section', null, null, 'word-count-settings-page');
        
        add_settings_field('wcp_location', 'Display Location', array($this, 'locationHTML'), 'word-count-settings-page', 'wcp_first_section');
        register_setting('wordcountplugin', 'wcp_location', array('sanitize_callback' => array($this, 'sanitizeLocation'), 'default' => '0' ));

        add_settings_field('wcp_heading_text', 'Heading Text', array($this, 'headingTextHTML'), 'word-count-settings-page', 'wcp_first_section');
        register_setting('wordcountplugin', 'wcp_heading_text', array('sanitize_callback' => 'sanitize_text_field', 'default' => 'Post Statistics' ));
        


        add_settings_field('wcp_word_count', 'Word Count', array($this, 'checkBoxHTML'), 'word-count-settings-page', 'wcp_first_section', array('theName' => 'wcp_word_count'));
        register_setting('wordcountplugin', 'wcp_word_count', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1' ));
        
        add_settings_field('wcp_char_count', 'Word Count', array($this, 'checkBoxHTML'), 'word-count-settings-page', 'wcp_first_section', array('theName' => 'wcp_char_count'));
        register_setting('wordcountplugin', 'wcp_char_count', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1' ));
        
        add_settings_field('wcp_read_time', 'Read Time', array($this, 'checkBoxHTML'), 'word-count-settings-page', 'wcp_first_section', array('theName' => 'wcp_read_time'));
        register_setting('wordcountplugin', 'wcp_read_time', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1' ));
    }
    
    function checkBoxHTML($args){ ?>
        <input type="checkbox" name="<?php echo $args['theName'] ?>" value="1" <?php checked(get_option($args['theName']), '1') ?> >
    <?php }

    function sanitizeLocation($input){
        if($input != 0 AND $input != 1){
            add_settings_error('wcp_location', 'wcp_location_error', 'Display location must be either beginer or end!');
            return get_option('wcp_location');
        }
        return $input;
    }

  /*  function charCountHTML(){?>
        <input type="checkbox" name="wcp_char_count" value="1" <?php checked(get_option('wcp_char_count'), '1') ?> >
    <?php }

    function wordCountHTML(){ ?>
        <input type="checkbox" name="wcp_word_count" value="1" <?php checked(get_option('wcp_word_count'), '1') ?> >
   <?php }

    function wordCountHTML(){ ?>
        <input type="checkbox" name="wcp_read_time" value="1" <?php checked(get_option('wcp_read_time'), '1') ?> >
   <?php }

    */
    function headingTextHTML(){ ?>
        <input type="text" name="wcp_heading_text" value="<?php echo esc_attr(get_option('wcp_heading_text')) ?>">
    <?php }

    function locationHTML(){ ?>
        <select name="wcp_location">
        <option value="0" <?php selected( get_option('wcp_location'), '0' ) ?> >Beggining of Post</option>
            <option value="1" <?php selected( get_option('wcp_location'), '1' ) ?> >End of Post</option>
        </select>
    <?php }

    function adminPage(){
        add_options_page('Word Count Plugin', 'Word Count', 'manage_options', 'word-count-settings-page', array($this, 'ourWordCountHTML'));
    }
    
    function ourWordCountHTML(){?>
        
        <div class="wrap">
            <h1>Word Count And Timing Plugin</h1>
            <form action="options.php" method="post">
                <?php
                    settings_fields('wordcountplugin');
                    do_settings_sections('word-count-settings-page');
                    submit_button();
                ?>
            </form>
        </div>
    
    <?php }
}

$wordCountAndTimePlugin = new wordCountAndTimePlugin();





?>