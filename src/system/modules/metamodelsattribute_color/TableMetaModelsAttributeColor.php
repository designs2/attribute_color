<?php

/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 * @package     MetaModels
 * @subpackage  AttributeColor
 * @author      Stefan Heimes <cms@men-at-work.de>
 * @copyright   The MetaModels team.
 * @license     LGPL.
 * @filesource
 */

/**
 * This class is used from MetaModelAttributeColor for various callbacks.
 *
 * @package	   MetaModels
 * @subpackage AttributeColor
 * @author     Stefan Heimes <cms@men-at-work.de>
 */
class TableMetaModelsAttributeColor extends Backend
{

	public function colorPicker(DataContainer $dc)
	{
		return ' ' . $this->generateImage('pickcolor.gif', $GLOBALS['TL_LANG']['MSC']['colorpicker'], 'style="vertical-align:top;cursor:pointer" id="moo_' . $dc->inputName . '"') . '
  <script>
  new MooRainbow("moo_' . $dc->inputName . '", {
    id:"ctrl_' . $dc->inputName . '_0",
    startColor:((cl = $("ctrl_' . $dc->inputName . '_0").value.hexToRgb(true)) ? cl : [255, 0, 0]),
    imgPath:"plugins/colorpicker/images/",
    onComplete: function(color) {
      $("ctrl_' . $dc->inputName . '_0").value = color.hex.replace("#", "");
    }
  });
  </script>';
	}

}