<?php

/*
 * This file is part of the Joomla Rapid K2 Theme
 *
 * website: www.vision-web.pl
 * (c) Rafał Mikołajun <rafal@vision-web.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
        // dodatkowe pola w kategorii
        if ($type == 'category') {
            $config = json_decode($item->plugins, true);

            // Get the database object and a new query object.
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);

            // Build the query.
            $query->select('template')
                ->from('#__template_styles as tpl')
                ->where('tpl.client_id = 0')
                ->where('tpl.home = 1');

            $db->setQuery($query);
            $results = $db->loadObjectList();

            // domyślny motyw strony
            if (!empty($results)) {
                $templateName = $results[0]->template;
            } else {
                $templateName = null;
            }

            // wybrany szablon
            $template = isset($config['twig_template']) ? $config['twig_template'] : null;

            // formularz
            $form = '<div class="form-horizontal">';

            // pole wybór szablonu
            $form .= '<div class="control-group">
                <div class="control-label"><label id="plugins_twig_template-lbl" for="plugins_twig_template">' . JText::_("K2_SELECT_A_TEMPLATE") . '</label></div>
                <div class="controls"><select id="plugins_twig_template" name="plugins[twig_template]">';

            // lista szablonów
            $options = array();

            // szablony w komponencie
            foreach(glob(JPATH_SITE . "/components/com_k2/templates/twig/views/*", GLOB_BRACE) as $folder) {
                if (is_dir($folder)) {
                    $info = pathinfo($folder);
                    $options[] = $info['basename'];
                }
            }

            // szablony w motywie
            if (!empty($templateName)) {
                foreach(glob(JPATH_SITE . "/templates/" . $templateName . "/views/extension/components/com_k2/templates/twig/views/*", GLOB_BRACE) as $folder) {
                    if (is_dir($folder)) {
                        $info = pathinfo($folder);
                        if (!in_array($info['basename'], $options)) {
                            $options[] = $info['basename'];
                        }
                    }
                }
            }

            // sortowanie alfabetycznie
            sort($options);

            // tworzenie znaczników option
            foreach ($options as $opt) {
                $form .= "<option" . ($opt == $template ? " selected" : '') . ">$opt</option>";
            }

            $form .= '</select></div></div>';

            // pole oś czasu
            $timeline = isset($config['timeline']) ? (bool)intval($config['timeline']) : false;
            $form .= '<div class="control-group">
                <div class="control-label"><label id="plugins_timeline-lbl" for="plugins_timeline">' . JText::_("K2_FIELD_TIMELINE") . '</label></div>
                <div class="controls">
                    <fieldset id="plugins_timeline" class="radio">
                        <input id="plugins_timeline0" name="plugins[timeline]" value="1"' . ($timeline ? ' checked="checked" ' : '') . 'type="radio" />
                        <label for="plugins_timeline0" style="display: block;">' . JText::_("K2_YES") . '</label>
                        <input id="plugins_timeline1" name="plugins[timeline]" value="0" ' . (!$timeline ? ' checked="checked" ' : '') . 'type="radio" />
                        <label for="plugins_timeline1" style="display: block;">' . JText::_("K2_NO") . '</label>
                    </fieldset>
                </div></div>';

            // koniec formularza
            $form .= '</div>';

            $plugin = new JObject;
            $plugin->set('name', JText::_('Rapid Framework'));
            $plugin->set('fields', $form);
            return $plugin;
        }

        return null;
    }

    /**
     * Saves data in db after apply or save.
     *
     * @param 	object		The updated or new k2 item.
     * @param 	boolean		Flag setting if the item is new or not.
     * @return	void
     */
    public function onAfterK2Save(&$row, $isNew)
    {
        exit();
    }
}
