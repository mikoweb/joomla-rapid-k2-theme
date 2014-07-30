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
// dane widoku dostępne z poziomu JavaScript
$document->element('script')->update(function ($value) use($k2) {
        $jinput = $jinput = JFactory::getApplication()->input;
        $code = 'jsloader.onLoad("core", function () {';
        $code .= '(function ($) {';
        $code .= '$.app.define("k2_pagination", '.json_encode($k2->pagination).'); ';
        $code .= '$.app.define("k2_cat", '.$jinput->get('id', 0, 'int').');';
        $code .= '}(jQuery));';
        $code .= '});';
        return $value . $code;
    });

// zmienne przekazane do widoku
$plugins = json_decode($this->category->plugins, true);
$template = (isset($plugins["twig_template"]) ? $plugins["twig_template"] : "default");
$timeline = array(
    'entries' => array_merge($this->leading, $this->primary, $this->secondary),
    'enable' => isset($plugins["timeline"]) ? (bool)intval($plugins["timeline"]) : false
);

// tworzenie ilustracji
K2Images::create($k2, 'category', $template);

// renderowanie widoku
echo TemplateOverride::create('com_k2', '/templates/twig/views/' . $template . '/' . (!$timeline['enable'] ? 'category' : 'timeline') . '.html.twig')
    ->render(TemplateOverride::MODE_COMPONENT, array(
            "k2" => $k2,
            "template" => $template,
            "timeline" => $timeline
        ));
