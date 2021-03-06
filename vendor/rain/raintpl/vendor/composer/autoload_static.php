<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8d2c359305426e2b3fd9853f7dd879e1
{
    public static $prefixesPsr0 = array (
        'R' => 
        array (
            'Rain' => 
            array (
                0 => __DIR__ . '/../..' . '/library',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit8d2c359305426e2b3fd9853f7dd879e1::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit8d2c359305426e2b3fd9853f7dd879e1::$classMap;

        }, null, ClassLoader::class);
    }
}
