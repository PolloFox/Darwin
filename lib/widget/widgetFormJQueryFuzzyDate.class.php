<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetFormJQueryDate represents a date widget rendered by JQuery UI.
 *
 * This widget needs JQuery and JQuery UI to work.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfWidgetFormJQueryDate.class.php 16262 2009-03-12 14:02:33Z fabien $
 */
class widgetFormJQueryFuzzyDate extends sfWidgetFormDate
{
  /**
   * Configures the current widget.
   *
   * Available options:
   *
   *  * image:   The image path to represent the widget (false by default)
   *  * config:  A JavaScript array that configures the JQuery date widget
   *  * culture: The user culture
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    $this->addOption('image', false);
    $this->addOption('config', '{}');
    $this->addOption('culture', '');
    $this->addOption('with_time', false);
    $this->addOption('with_seconds', true);
    parent::configure($options, $attributes);

    if ('en' == $this->getOption('culture'))
    {
      $this->setOption('culture', 'en');
    }
  }

  /**
   * @param  string $name        The element name
   * @param  string $value       The date displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $prefix = $this->generateId($name);

    $image = '';
    if (false !== $this->getOption('image'))
    {
      $image = sprintf(', buttonImage: "%s", buttonImageOnly: true', $this->getOption('image'));
    }

    $time_str = '';
    if($this->getOption('with_time'))
    {
      $widget = new sfWidgetFormTime(array(
 	'empty_values' => array_merge(array('hour'=>'','minute'=>'','second'=>''), $this->getOption('empty_values')),
	'with_seconds' => $this->getOption('with_seconds')
      ));
      $time_str = $widget->render($name, $value, $attributes, $errors);
    }
    
    $script_to_format = '<script type="text/javascript">
                           function wfd_%1$s_read_linked()
                           {
                             var day = 1;
                             var month = 1;
                             var year = %2$s;
                             if (jQuery("#%3$s").val() != "")
                             {
                               year = jQuery("#%3$s").val();
                             }
                             else if (jQuery("#%3$s").hasClass("to_date"))
                             {
                               year = %4$s;
                             }
                         
                             if (jQuery("#%5$s").val() != "")
                             {
                               month = jQuery("#%5$s").val();
                             }
                             else if (jQuery("#%5$s").hasClass("to_date"))
                             {
                               month = 12;
                             }
                             
                             if (jQuery("#%5$s").val() == "")
                             {
                               jQuery("#%6$s").val("");
                             }
                         
                             var daysInMonth = 32 - new Date(year, month - 1, 32).getDate();
                         
                             if ((jQuery("#%3$s").val() != "") && (jQuery("#%5$s").val() != "") && (jQuery("#%6$s").val() != ""))
                             {
                               day = jQuery("#%6$s").val();
                             }
                             else if (jQuery("#%3$s").hasClass("to_date"))
                             {
                               day = daysInMonth;
                             }
                         
                             jQuery("#%7$s").val(year + "-" + month + "-" + day);
                         
                             return {};
                           }
                         
                           function wfd_%1$s_update_linked(date)
                           {
                             jQuery("#%3$s").val(date.substring(0, 4));
                             jQuery("#%5$s").val(date.substring(5, 7));
                             jQuery("#%6$s").val(date.substring(8));
                           }
                         
                           function wfd_%1$s_check_linked_days()
                           {
                             var daysInMonth = 32 - new Date(jQuery("#%3$s").val(), jQuery("#%5$s").val() - 1, 32).getDate();
                             jQuery("#%6$s option").attr("disabled", "");
                             jQuery("#%6$s option:gt(" + (%8$s) +")").attr("disabled", "disabled");
                         
                             if (jQuery("#%6$s").val() > daysInMonth)
                             {
                               jQuery("#%6$s").val(daysInMonth);
                             }
                           }
                         
                           jQuery(document).ready(function() {
                             jQuery("#%7$s").datepicker(jQuery.extend({}, {
                               minDate:    new Date(%2$s, 1 - 1, 1),
                               maxDate:    new Date(%9$s, 12 - 1, 31),
                               yearRange:  "%2$s:%9$s",
                               beforeShow: wfd_%1$s_read_linked,
                               onSelect:   wfd_%1$s_update_linked,
                               changeMonth: true,
                               changeYear: true,
                               showButtonPanel: false,
                               showOn:     "button"
                               %10$s
                             }, jQuery.datepicker.regional["%11$s"], %12$s, {dateFormat: "yy-mm-dd"}));
                           });
                         
                           jQuery("#%6$s, #%5$s, #%3$s").change(wfd_%1$s_check_linked_days);
                         </script>';
    return parent::render($name, $value, $attributes, $errors).
           $this->renderTag('input', array('type' => 'hidden', 'size' => 10, 'id' => $id = $this->generateId($name).'_jquery_control', 'disabled' => 'disabled')).
           sprintf($script_to_format,
                   $prefix, 
                   min($this->getOption('years')),
                   $this->generateId($name.'[year]'),
                   date('Y'),
                   $this->generateId($name.'[month]'),
                   $this->generateId($name.'[day]'),
                   $id,
                   ($this->getOption('can_be_empty') ? 'daysInMonth' : 'daysInMonth - 1'),
                   max($this->getOption('years')),
                   $image, 
                   $this->getOption('culture'), 
                   $this->getOption('config')
                  ).
           $time_str;
  }
}
