<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class plgK2Rapidk2themeInstallerScript
{
    /**
     * method to run after an install/update/uninstall method
     * @param $type
     * @param $parent
     * @return void
     */
    function postflight($type, $parent)
    {
        var_dump("OK");
        var_dump($type);
        if ($type == "install" || $type == "update") {
            rename(JPATH_PLUGINS . "/k2/rapidk2theme/template/twig", JPATH_COMPONENT_SITE . "/com_k2/templates/twig");
            rename(JPATH_PLUGINS . "/k2/rapidk2theme/template/generic.php", JPATH_COMPONENT_SITE . "/com_k2/templates/generic.php");
        }

        if ($type == "install") {
            $row = JTable::getInstance('extension');
            $id = $row->find(array('name' => 'plg_rapidk2theme'));
            if (!empty($id)) {
                $row->load($id);
                $row->enabled = 1;
                $row->check();
                $row->store();
            }
        }
    }
}
