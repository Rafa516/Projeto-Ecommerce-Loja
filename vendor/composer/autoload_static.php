<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit61f003d9246224f6d2ee2497bca8e98e
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Projeto\\' => 8,
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Projeto\\' => 
        array (
            0 => __DIR__ . '/..' . '/projeto/php-classes/src',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Slim' => 
            array (
                0 => __DIR__ . '/..' . '/slim/slim',
            ),
        ),
        'R' => 
        array (
            'Rain' => 
            array (
                0 => __DIR__ . '/..' . '/rain/raintpl/library',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit61f003d9246224f6d2ee2497bca8e98e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit61f003d9246224f6d2ee2497bca8e98e::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit61f003d9246224f6d2ee2497bca8e98e::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit61f003d9246224f6d2ee2497bca8e98e::$classMap;

        }, null, ClassLoader::class);
    }
}