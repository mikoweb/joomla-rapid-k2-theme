<?php

/**
 * @package Joomla Rapid K2 Theme
 * @author Rafał Mikołajun <rafal@mikoweb.pl>
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

defined('_JEXEC') or die;
defined('RAPID_FRAMEWORK') or die('Joomla! Rapid Framework is not installed.');

use Joomla\Rapid\Theme\TemplateOverride;

$utilities = new stdClass();
$utilities->setDefaultImage = function ($item, $type, $params) {
    K2HelperUtilities::setDefaultImage($item, $type, $params);
};
echo TemplateOverride::create('com_k2', '/templates/twig/views/default/category.html.twig')
    ->render(TemplateOverride::MODE_COMPONENT, array(
            "k2" => $this,
            "utilities" => $utilities
        ));
