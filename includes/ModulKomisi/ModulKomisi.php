<?php

namespace Yukdiorder\Membership\ModulKomisi;

use Yukdiorder\Membership\ModulKomisi\admin\Komisi_Admin;
use Yukdiorder\Membership\ModulKomisi\Komisi_Public;

class ModulKomisi{
    
    protected $modules = [];
    public function __construct()
    {
        if (defined('SKN8_MEMBERSHIP_VERSION')) {
            $this->version = SKN8_MEMBERSHIP_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'skn8-membership';

        $this->load_dependencies();
        $this->set_module(new Komisi_Admin());
        $this->set_module(new Komisi_Public());
        $this->run();
    }

    public function run()
    {
        // new Notice('membership run disini');
    }

    public function set_module($module)
    {
        array_push($this->modules, $module);
    }

    public function get_modules()
    {
        return $this->modules;
    }

    public function load_dependencies()
    {
        require_once plugin_dir_path(dirname(__FILE__)) . 'ModulKomisi/admin/Komisi_Admin.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'ModulKomisi/public/Komisi_Public.php';
    }

}