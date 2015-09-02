<?php defined('C5_EXECUTE') or die('Access Denied.');
use Symfony\Component\ClassLoader\MapClassLoader;

/**
 * ----------------------------------------------------------------------------
 * Load all composer autoload items.
 * ----------------------------------------------------------------------------
 */
if (!@include(DIR_BASE_CORE . '/' . DIRNAME_VENDOR . '/autoload.php')) {
    die('Third party libraries not installed. Make sure that composer has required libraries in the concrete/ directory.');
}

$mapping = array(
    'Concrete\\Core\\Editor\\RedactorEditor' => DIR_APPLICATION . '/src/Editor/RedactorEditor.php'
);
 
$loader = new MapClassLoader($mapping);
$loader->register();