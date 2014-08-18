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
        if ($type == "install" || $type == "update") {
            JFolder::copy(JPATH_PLUGINS . "/k2/rapidk2theme/template/twig", JPATH_SITE . "/components/com_k2/templates/twig", '', true);
            JFolder::delete(JPATH_PLUGINS . "/k2/rapidk2theme/template/twig");

            $path = JPATH_SITE . "/components/com_k2/templates/generic.php";
            if (file_exists($path)) unlink($path);
            rename(JPATH_PLUGINS . "/k2/rapidk2theme/template/generic.php", $path);

            $path = JPATH_SITE . "/components/com_k2/templates/default/tag.php";
            if (file_exists($path)) unlink($path);
            rename(JPATH_PLUGINS . "/k2/rapidk2theme/template/tag.php", $path);

            $path = JPATH_SITE . "/components/com_k2/templates/default/user.php";
            if (file_exists($path)) unlink($path);
            rename(JPATH_PLUGINS . "/k2/rapidk2theme/template/user.php", $path);

            $path = JPATH_SITE . "/components/com_k2/templates/default/latest.php";
            if (file_exists($path)) unlink($path);
            rename(JPATH_PLUGINS . "/k2/rapidk2theme/template/latest.php", $path);
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

            /*
             * Zaleca się zmiane typu kolumny 'plugins' w tabeli 'k2_items' na mediumtext
             * ze zględu na to, że dane ilustracji mogą przekroczyć 64 kB.
             */
            $db = JFactory::getDbo();
            $db->setQuery("ALTER TABLE #__k2_items CHANGE plugins plugins MEDIUMTEXT NOT NULL;");
            $db->query();
        }
    }
}
