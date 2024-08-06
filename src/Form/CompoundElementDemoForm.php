<?php

namespace Drupal\form_element_compound_demo\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * TODO: class docs.
 */
class CompoundElementDemoForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'form_element_compound_demo_compound_element_demo_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['demo'] = [
      '#type' => 'demo_compound_element',
      '#title' => $this->t('Compound value'),
      '#description' => $this->t('Description'),
      // '#default_value' => 'enter the default value',
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // The problem is here: why do we get an array with 'container' set in it,
    // when the valueCallback() should get rid of it?
    dsm($form_state->getValue('demo'));
  }

}
