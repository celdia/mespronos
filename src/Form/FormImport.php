<?php

namespace Drupal\mespronos\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;
/**
 * Implements an example form.
 */
class FormImport extends FormBase {

  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'form_import';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['imported_file'] = array(
      '#type' => 'managed_file',
      '#title' => t('YAML file to import'),
      '#upload_location' => 'public://imports/'.date('U'),
      '#upload_validators' => [
        'file_validate_extensions' => ['yaml']
      ]
    );
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    dpm($form_state);
    drupal_set_message($this->t('Your phone number is @number', array('@number' => $form_state->getValue('phone_number'))));
  }

}
?>