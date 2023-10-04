<?php declare(strict_types = 1);

namespace Drupal\minial_roll\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the gameelement entity edit forms.
 */
class GameElementForm extends ContentEntityForm {

  /**
   * {@inheritDoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);
    if (empty($form['faction']['widget']['#default_value'])) {
      $faction = \Drupal::request()->get('minial_roll_faction');
      $form['faction']['widget']['#default_value'] = $faction;
    }
    return $form;
  }

}
