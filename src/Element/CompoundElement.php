<?php

namespace Drupal\form_element_compound_demo\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\FormElementBase;

/**
 * TODO: class docs.
 *
 * @FormElement("demo_compound_element")
 */
class CompoundElement extends FormElementBase {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    $class = static::class;

    return [
      '#input' => TRUE,
      '#element_validate' => [
        [$class, 'validateElement'],
      ],
      '#process' => [
        [$class, 'processElement'],
      ],
    ];
  }

  /**
   * Process callback.
   */
  public static function processElement($element, FormStateInterface $form_state, &$complete_form) {
    $element['#tree'] = TRUE;

    $element['container'] = [
      '#type' => 'details',
      '#open' => TRUE,
      '#title' => $element['#title'] ?? '',
      '#description' => $element['#description'] ?? '',
    ];

    $element['container']['alpha'] = [
      '#type' => 'textfield',
      '#title' => 'Alpha',
    ];
    $element['container']['beta'] = [
      '#type' => 'textfield',
      '#title' => 'Beta',
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function valueCallback(&$element, $input, FormStateInterface $form_state) {
    if ($input === FALSE) {
      return $element['#default_value'] ?? [];
    }
    elseif ($input === NULL) {
      // Not sure how this happens.
      return '';
    }
    else {
      // This receives as expected an array of the form:
      // [
      //   'container' => [
      //     'alpha' => ...,
      //     'beta' => ...,
      //   ],
      // ]

      // Return just the inner array to remove the unnecessary nesting:
      return $input['container'];
      // The problem is that in the form class, the form value for this element
      // will still have a 'container' sub-array in addition to the lifted keys.
    }
  }

  /**
   * Element validate callback.
   */
  public static function validateElement($element, FormStateInterface &$form_state, $form) {

  }

}
