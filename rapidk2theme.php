<?php

defined('_JEXEC') or die;
defined('RAPID_FRAMEWORK') or die('Joomla! Rapid Framework is not installed.');

// Load the K2 Plugin API
JLoader::register('K2Plugin', JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'lib'.DS.'k2plugin.php');

// Initiate class to hold plugin events
class PlgK2Rapidk2theme extends K2Plugin
{
    /**
     * @param object $subject
     * @param array $params
     */
    public function __construct(&$subject, $params)
    {
        $language = JFactory::getLanguage();
        $language->load('plg_k2_rapidk2theme', JPATH_ADMINISTRATOR);
        parent::__construct($subject, $params);
    }

    /**
     * Brings the GUI of plugin in the content tab of the k2 item.
     *
     * @param 	object		The k2 item.
     * @param 	string		The view.
     * @param 	string		The tab for assign the plugin.
     * @return	object
     */
    public function onRenderAdminForm(&$item, $type, $tab='')
    {
        if ($type == 'category') {
            $config = json_decode($item->plugins, true);

            // wybrany szablon
            $template = isset($config['twig_template']) ? $config['twig_template'] : null;

            // formularz
            $form = '<div class="form-horizontal">';

            // pole wybór szablonu
            $form .= '<div class="control-group">
                <div class="control-label"><label id="plugins_twig_template-lbl" for="plugins_twig_template">Template</label></div>
                <div class="controls"><select id="plugins_twig_template" name="plugins[twig_template]">';

            // lista szablonów
            $options = array('default');
            foreach ($options as $opt) {
                $form .= "<option>$opt</option>";
            }

            $form .= '</select></div></div>';

            // koniec formularza
            $form .= '</div>';

            $plugin = new JObject;
            $plugin->set('name', JText::_('Rapid Framework'));
            $plugin->set('fields', $form);
            return $plugin;
        }

        return null;
    }
}
