<?php
/**
 * Created by PhpStorm.
 * User: valeriishinkar
 * Date: 11/20/18
 * Time: 13:01
 */

namespace ValeriyShinkar\Core;

class View
{

    /**
     * @param $contentView
     * @param $templateView
     * @param null $data
     */
    public function generate($contentView, $templateView, $data = null)
    {

        if (is_array($data)) {

            // Import variables into the current symbol table from an array
            extract($data);
        }

        include 'Views/' . $templateView;
    }
}
