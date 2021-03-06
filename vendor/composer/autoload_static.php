<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0981e1e1c91cfc28543a906d5c424e62
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WilokeShopify\\' => 14,
        ),
        'P' => 
        array (
            'PHPShopify\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WilokeShopify\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'PHPShopify\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpclassic/php-shopify/lib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0981e1e1c91cfc28543a906d5c424e62::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0981e1e1c91cfc28543a906d5c424e62::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
