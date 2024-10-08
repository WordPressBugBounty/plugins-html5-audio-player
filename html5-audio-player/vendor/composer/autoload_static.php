<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit05a582d81133b3eae737fea001cbca29
{
    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'H5APPlayer\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'H5APPlayer\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit05a582d81133b3eae737fea001cbca29::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit05a582d81133b3eae737fea001cbca29::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit05a582d81133b3eae737fea001cbca29::$classMap;

        }, null, ClassLoader::class);
    }
}
