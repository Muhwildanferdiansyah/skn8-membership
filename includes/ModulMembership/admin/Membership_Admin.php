<?php

namespace Yukdiorder\Membership\ModulMembership\admin;


class Membership_Admin
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'membership_slugmenu']);
        add_action('admin_menu', [$this, 'dompet_slugmenu']);
        add_action('admin_init', [$this, 'enqueue']);
        add_action('admin_init', [$this, 'custom_role']);
        //hook untuk woocommerce produk data tabs
        // add_filter('woocommerce_product_data_tabs', [$this, 'custom_product_tabs']);
        //
        // add_action('woocommerce_product_options_pricing', [$this, 'add_field']);

        // add_filter('woocommerce_product_data_tabs', [$this, 'add_field']); // WC 2.5 and below
        // add_action('woocommerce_product_data_panels', [$this, 'add_field']); // WC 2.6 and up
    }

    public function custom_product_tabs($tabs)
    {
        // nama tab 
        $tabs['Multiharga'] = array(
            'label'        => __('Multi Harga', 'woocommerce'),
            'target'    => 'distributor_options',
            'class'        => array('show_if_simple', 'show_if_variable'),

        );

        return $tabs;
    }

    //isi dari produk tab 
    public function add_field()
    {
        global $post;

        // Note the 'id' attribute needs to match the 'target' parameter set above
?>
        <div id='distributor_options' class='panel woocommerce_options_panel'>
            <?php
            ?>
            <div class='options_group'>
                <?php
                woocommerce_wp_text_input(array(
                    'id'                => '_valid_for_days',
                    'label'                => __('Distributor', 'woocommerce'),
                    'desc_tip'            => 'true',
                    'description'        => __('harga distributor', 'woocommerce'),
                    'type'                 => 'number',
                    'custom_attributes'    => array(
                        'min'    => '1',
                        'step'    => '1',
                    ),
                ));

                ?></div>

        </div><?php
            }

            public function enqueue()
            {
                wp_enqueue_script('member-scripts', plugin_dir_url(__FILE__) . 'assets/js/bootstrap.js', array('jquery'), '', true);
                wp_enqueue_style('member-style', plugin_dir_url(__FILE__) . 'assets/css/bootstrap.css');
                wp_enqueue_style('member-style', plugin_dir_url(__FILE__) . 'assets/css/style.css');
            }

            public function membership_slugmenu()
            {
                add_submenu_page('pluginmembership', 'Membership Option', 'Membership Option', 'administrator', 'membership', [$this, 'view_home']);
            }

            public function dompet_slugmenu()
            {
                add_submenu_page('pluginmembership', 'Dompet', 'Dompet', 'administrator', 'dompet', [$this, 'view_home']);
            }

            public function view_home()
            {
                require dirname(__FILE__) . '/view/halaman-depan.php';
            }

            public function custom_role()
            {
                add_role('distributor', 'Distributor', array('administrator' => true, 'level_0' => true));
                add_role('agen', 'Agen', array('administrator' => true, 'level_1' => true));
                add_role('reseller', 'Reseller', array('administrator' => true, 'level_2' => true));
                add_role('agen01', 'agen01', array('administrator' => true, 'level_3' => true));
                add_role('reseller01', 'Reseller01', array('administrator' => true, 'level_4' => true));
            }
        }
