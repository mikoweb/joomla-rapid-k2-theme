<?php

/**
 * @package Joomla Rapid K2 Theme
 * @author Rafał Mikołajun <rafal@mikoweb.pl>
 * @url http://www.vision-web.pl
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

defined('_JEXEC') or die;
defined('RAPID_FRAMEWORK') or die('Joomla! Rapid Framework is not installed.');

use Joomla\Rapid\K2\K2Images;
use Joomla\Rapid\Theme\TemplateOverride;

$utilities = new stdClass();
$utilities->EmailCloak = function ($email) {
    return JHTML::_('Email.cloak', $email);
};

$plugins = json_decode($this->item->category->plugins, true);
$template = (isset($plugins["twig_template"]) ? $plugins["twig_template"] : "default");

// tworzenie ilustracji
K2Images::create($k2, 'item', $template);

echo TemplateOverride::create('com_k2', '/templates/twig/views/' . $template . '/item.html.twig')
    ->render(TemplateOverride::MODE_COMPONENT, array(
            "k2" => $this,
            "utilities" => $utilities
        ));
