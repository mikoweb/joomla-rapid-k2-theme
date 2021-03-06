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
use Joomla\RapidApp\App;

$k2 = $this;
$container = App::container();
$document = $container->get('document');
$document->element('script')->update(function ($value) use($k2) {
        $jinput = $jinput = JFactory::getApplication()->input;
        $code = 'jsloader.onLoad("core", function () {';
        $code .= '(function ($) {';
        $code .= '$.app.define("k2_pagination", '.json_encode($k2->pagination).'); ';
        $code .= '$.app.define("k2_generic", '.json_encode(array(
                'year' => $jinput->get('year', 0, 'int'),
                'month' => $jinput->get('month', 0, 'int'),
                'day' => $jinput->get('day', 0, 'int'),
                'searchword' => htmlspecialchars($jinput->get('searchword', '', 'string')),
                'categories' => preg_replace('/[^0-9,]/i', '', $jinput->get('categories', '', 'string'))
            )).');';
        $code .= '}(jQuery));';
        $code .= '});';
        return $value . $code;
    });

// tworzenie ilustracji
K2Images::create(array(
        'view' => $k2,
        'layout' => 'generic',
        'k2template' => 'default'
    ));

echo TemplateOverride::create('com_k2', '/templates/twig/views/default/generic.html.twig')
    ->render(TemplateOverride::MODE_COMPONENT, array(
            "k2" => $k2
        ));
