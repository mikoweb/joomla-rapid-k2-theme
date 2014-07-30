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
        $code .= '$.app.define("k2_tag", "'.htmlspecialchars($jinput->get('tag', '', 'string')).'");';
        $code .= '}(jQuery));';
        $code .= '});';
        return $value . $code;
    });

// tworzenie ilustracji
K2Images::create($k2, 'tag', 'default');

echo TemplateOverride::create('com_k2', '/templates/twig/views/default/tag.html.twig')
    ->render(TemplateOverride::MODE_COMPONENT, array(
            "k2" => $k2
        ));
