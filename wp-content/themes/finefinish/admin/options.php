<?php
class SiteSettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin',
            'Site information',
            'manage_options',
            'site-setting-admin',
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'my_option_name' );
        ?>
        <div class="wrap">
            <h1>Site Settings</h1>
            <form method="post" action="options.php">
                <?php
                // This prints out all hidden setting fields
                settings_fields( 'my_option_group' );
                do_settings_sections( 'site-setting-admin' );
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {
        register_setting(
            'my_option_group', // Option group
            'my_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Site Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'site-setting-admin' // Page
        );

        add_settings_field(
            'title',
            'Shop title',
            array( $this, 'title_callback' ),
            'site-setting-admin',
            'setting_section_id'
        );

        add_settings_field(
            'email',
            'Email',
            array( $this, 'email_callback' ),
            'site-setting-admin',
            'setting_section_id'
        );

        add_settings_field(
            'phone_number', // ID
            'Phone Number', // Title
            array( $this, 'phone_number_callback' ), // Callback
            'site-setting-admin', // Page
            'setting_section_id' // Section
        );

        add_settings_field(
            'primary_address', // ID
            'Primary address', // address
            array( $this, 'primary_address_callback' ), // Callback
            'site-setting-admin', // Page
            'setting_section_id' // Section
        );

        add_settings_field(
            'other_address', // ID
            'Other address', // Title
            array( $this, 'other_address_callback' ), // Callback
            'site-setting-admin', // Page
            'setting_section_id' // Section
        );

        add_settings_field(
            'open_time', // ID
            'Working hours', // Title
            array( $this, 'open_time_callback' ), // Callback
            'site-setting-admin', // Page
            'setting_section_id' // Section
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['phone_number'] ) )
            $new_input['phone_number'] =  $input['phone_number'];

        if( isset( $input['title'] ) )
            $new_input['title'] = sanitize_text_field( $input['title'] );

        if( isset( $input['email'] ) )
            $new_input['email'] = sanitize_text_field( $input['email'] );

        if( isset( $input['primary_address'] ) )
            $new_input['primary_address'] = $input['primary_address'];

        if( isset( $input['other_address'] ) )
            $new_input['other_address'] =  $input['other_address'] ;

        if( isset( $input['open_time'] ) )
            $new_input['open_time'] =  $input['open_time'] ;

        return $new_input;
    }

    /**
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }

    public function title_callback()
    {
        printf(
            '<input type="text" id="title" name="my_option_name[title]" value="%s" style="width: 450px;" />',
            isset( $this->options['title'] ) ? esc_attr( $this->options['title']) : ''
        );
    }

    public function email_callback()
    {
        printf(
            '<input type="email" id="email" name="my_option_name[email]" value="%s" style="width: 450px;" />',
            isset( $this->options['email'] ) ? esc_attr( $this->options['email']) : ''
        );
    }

    public function phone_number_callback()
    {
        printf(
            '<input type="text" id="phone_number" name="my_option_name[phone_number]" value="%s" style="width: 450px;" />',
            isset( $this->options['phone_number'] ) ? esc_attr( $this->options['phone_number']) : ''
        );
    }

    public function primary_address_callback()
    {
        printf(
            '<textarea  id="primary_address" name="my_option_name[primary_address]" style="width: 450px;" rows="6">%s</textarea>',
            isset( $this->options['primary_address'] ) ? esc_attr( $this->options['primary_address']) : ''
        );
    }

    public function other_address_callback()
    {
        printf(
            '<textarea  id="other_address" name="my_option_name[other_address]" style="width: 450px;" rows="6" >%s</textarea>',
            isset( $this->options['other_address'] ) ? esc_attr( $this->options['other_address']) : ''
        );
    }

    public function open_time_callback()
    {
        printf(
            '<textarea  id="open_time" name="my_option_name[open_time]" style="width: 450px;" rows="4" >%s</textarea>',
            isset( $this->options['open_time'] ) ? esc_attr( $this->options['open_time']) : ''
        );
    }
}

if( is_admin() )
    $my_settings_page = new SiteSettingsPage();