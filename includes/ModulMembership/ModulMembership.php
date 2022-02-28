<?php

namespace Yukdiorder\Membership\ModulMembership;

use Yukdiorder\Membership\ModulMembership\admin\Membership_Admin;
use Yukdiorder\Membership\ModulMembership\Membership_Public;


class ModulMembership
{

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
        $this->set_module(new Membership_Admin());
        $this->set_module(new Membership_Public());
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
        require_once plugin_dir_path(dirname(__FILE__)) . 'ModulMembership/admin/Membership_Admin.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'ModulMembership/public/Membership_Public.php';
    }
}