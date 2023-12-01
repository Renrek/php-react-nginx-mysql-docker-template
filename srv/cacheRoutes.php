#!/usr/bin/php
<?php declare(strict_types=1);

$iterator = new \RecursiveDirectoryIterator(
    dirname(__FILE__).'/app'
);

// $namespace .= '\\';
//       $myClasses  = array_filter(get_declared_classes(), function($item) use ($namespace) { return substr($item, 0, strlen($namespace)) === $namespace; });
//       $theClasses = [];
//       foreach ($myClasses AS $class):
//             $theParts = explode('\\', $class);
//             $theClasses[] = end($theParts);
//       endforeach;

var_dump($iterator->getPathname());

