<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitabb08ee2623e66a2d5f5f1b3489fc5a1
{
    public static $files = array (
        '49a1299791c25c6fd83542c6fedacddd' => __DIR__ . '/..' . '/yahnis-elsts/plugin-update-checker/load-v4p11.php',
    );

    public static $prefixLengthsPsr4 = array (
        'Y' => 
        array (
            'Yukdiorder\\Membership\\' => 22,
            'Yukdiorder\\Helper\\' => 18,
        ),
        'A' => 
        array (
            'Automattic\\WooCommerce\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Yukdiorder\\Membership\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
        'Yukdiorder\\Helper\\' => 
        array (
            0 => __DIR__ . '/..' . '/yukdiorder/yuk-helper/src',
        ),
        'Automattic\\WooCommerce\\' => 
        array (
            0 => __DIR__ . '/..' . '/automattic/woocommerce/src/WooCommerce',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitabb08ee2623e66a2d5f5f1b3489fc5a1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitabb08ee2623e66a2d5f5f1b3489fc5a1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitabb08ee2623e66a2d5f5f1b3489fc5a1::$classMap;

        }, null, ClassLoader::class);
    }
}
