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

// tworzenie ilustracji
K2Images::create($this, 'latest', 'default');

echo TemplateOverride::create('com_k2', '/templates/twig/views/default/latest.html.twig')
    ->render(TemplateOverride::MODE_COMPONENT, array(
            "k2" => $this
        ));
