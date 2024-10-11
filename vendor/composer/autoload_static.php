<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdc6d203c29f0fbc24cfc3eaec5853c27
{
    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'Examenopdracht\\classes\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Examenopdracht\\classes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdc6d203c29f0fbc24cfc3eaec5853c27::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdc6d203c29f0fbc24cfc3eaec5853c27::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdc6d203c29f0fbc24cfc3eaec5853c27::$classMap;

        }, null, ClassLoader::class);
    }
}
