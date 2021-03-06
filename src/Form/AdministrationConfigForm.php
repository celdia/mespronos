<?php

namespace Drupal\mespronos\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;
/**
 * Implements an example form.
 */
class AdministrationConfigForm extends FormBase {

  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'administration_config_form';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $games = $form_state->getBuildInfo()['args'][0];

    $form['games'] = array(
      '#type' => 'container',
      '#tree' => true,
    );
    foreach($games as $game) {
      $form['games'][$game->id()] = array(
        '#type' => 'fieldset',
        '#title' => $game->label(),
        '#attributes' => array(
          'class' => array('game'),
        ),
      );
      $form['games'][$game->id()]['score_team_1'] = array(
        '#type' => 'textfield',
        '#size' => '5',
      );
      $form['games'][$game->id()]['score_team_2'] = array(
        '#type' => 'textfield',
        '#size' => '5',
      );
    }
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Send'),
      '#button_type' => 'primary',
    );
    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    $games = $form_state->getValue('games');
    foreach($games as $game_id => $game_data) {
      if ($game_data['score_team_1'] != '' && $game_data['score_team_1'] < 0) {
        $form_state->setErrorByName('games][' . $game_id . '][score_team_1', $this->t("Can't be less than 0."));
      }
      if ($game_data['score_team_2'] != '' && $game_data['score_team_2'] < 0) {
        $form_state->setErrorByName('games][' . $game_id . '][score_team_2', $this->t("Can't be less than 0."));
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $games = $form_state->getValue('games');
    $i = 0;
    foreach($games as $game_id => $game_data) {
      $game_storage = \Drupal::entityManager()->getStorage('game');
      if($game_data['score_team_1'] != '' && $game_data['score_team_2'] != '') {
        $i++;
        $game = $game_storage->load($game_id);
        $game->set('score_team_1',$game_data['score_team_1']);
        $game->set('score_team_2',$game_data['score_team_2']);
        $game->save();
      }
    }
    drupal_set_message($this->t('@nb_mark games updated',array('@nb_mark'=>$i)));
  }

}
?>