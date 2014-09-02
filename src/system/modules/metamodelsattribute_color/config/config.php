<?php
/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 *
 * @package     MetaModels
 * @subpackage  AttributeColor
 * @author      Stefan Heimes <cms@men-at-work.de>
 * @copyright   The MetaModels team.
 * @license     LGPL.
 * @filesource
 */

$GLOBALS['METAMODELS']['attributes']['color']['class'] = 'MetaModels\Attribute\Color\Color';
$GLOBALS['METAMODELS']['attributes']['color']['image'] = 'system/modules/metamodelsattribute_color/html/color.png';

$GLOBALS['TL_EVENTS'][\ContaoCommunityAlliance\Contao\EventDispatcher\Event\CreateEventDispatcherEvent::NAME][] =
    'MetaModels\Attribute\Color\Subscriber::registerEvents';
