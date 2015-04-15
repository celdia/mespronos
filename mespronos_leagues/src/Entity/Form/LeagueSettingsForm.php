<?php

/**
 * @file
 * Contains Drupal\mespronos_leagues\Entity\Form\LeagueSettingsForm.
 */

namespace Drupal\mespronos_leagues\Entity\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class LeagueSettingsForm.
 *
 * @package Drupal\mespronos_leagues\Form
 *
 * @ingroup mespronos_leagues
 */
class LeagueSettingsForm extends FormBase {
  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'League_settings';
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Empty implementation of the abstract submit class.
  }


  /**
   * Define the form used for League  settings.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   Form definition array.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['League_settings']['#markup'] = 'Settings form for League. Manage field settings here.';
    return $form;
  }

}
