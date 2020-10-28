<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite257e6a988e475bf49a6cc508e9bf11a
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite257e6a988e475bf49a6cc508e9bf11a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite257e6a988e475bf49a6cc508e9bf11a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite257e6a988e475bf49a6cc508e9bf11a::$classMap;

        }, null, ClassLoader::class);
    }
}
