<?php

namespace MetaModels\Attribute\Color;

use ContaoCommunityAlliance\Contao\Bindings\ContaoEvents;
use ContaoCommunityAlliance\Contao\Bindings\Events\Image\GenerateHtmlEvent;
use ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\ManipulateWidgetEvent;
use MetaModels\DcGeneral\Events\BaseSubscriber;
use MetaModels\Events\PopulateAttributeEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Handle events regarding the color attributes.
 *
 * @package MetaModels\Attribute\Color
 */
class Subscriber
	extends BaseSubscriber
	implements EventSubscriberInterface
{
	/**
	 * {@inheritDoc}
	 */
	public static function getSubscribedEvents()
	{
		return array(
			PopulateAttributeEvent::NAME => __CLASS__ . '::populate()'
		);
	}

	/**
	 * Registers the events for the attribute.
	 *
	 * @param PopulateAttributeEvent $event The event.
	 *
	 * @return void
	 */
	public function populate(PopulateAttributeEvent $event)
	{
		if (!($event->getAttribute() instanceof Color))
		{
			return;
		}

		$this->registerListeners(
			array(
				ManipulateWidgetEvent::NAME => __CLASS__ . '::addDatePicker'
			),
			$event->getDispatcher(),
			array(
				$event->getMetaModel()->getTableName(),
				$event->getAttribute()->getColName()
			)
		);
	}

	/**
	 * Append the date picker to the widget.
	 *
	 * @param ManipulateWidgetEvent $event The event.
	 *
	 * @return void
	 */
	public static function addDatePicker(ManipulateWidgetEvent $event)
	{
		$environment = $event->getEnvironment();
		$widget      = $event->getWidget();
		$property    = $event->getProperty()->getName();

		$imageEvent = new GenerateHtmlEvent(
			'pickcolor.gif',
			$environment->getTranslator('MSC.colorpicker'),
			'style="vertical-align:top;cursor:pointer" id="moo_' . $property . '"'
			);

		$environment->getEventPropagator()->propagate(ContaoEvents::IMAGE_GET_HTML, $imageEvent);

		$widget->wizard = $event->getHtml() . '
			<script>
			new MooRainbow("moo_' . $property . '", {
			id:"ctrl_' . $property . '_0",
			startColor:((cl = $("ctrl_' . $property . '_0").value.hexToRgb(true)) ? cl : [255, 0, 0]),
			imgPath:"plugins/colorpicker/images/",
			onComplete: function(color) {
				$("ctrl_' . $property . '_0").value = color.hex.replace("#", "");
			}
			});
			</script>';
	}
}
