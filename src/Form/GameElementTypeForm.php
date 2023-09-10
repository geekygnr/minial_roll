<?php declare(strict_types = 1);

namespace Drupal\minial_roll\Form;

use Drupal\Core\Entity\BundleEntityFormBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\minial_roll\Entity\GameElementType;

/**
 * Form handler for gameelement type forms.
 */
class GameElementTypeForm extends BundleEntityFormBase {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state): array {
    $form = parent::form($form, $form_state);

    if ($this->operation === 'edit') {
      $form['#title'] = $this->t('Edit %label gameelement type', ['%label' => $this->entity->label()]);

      /** @var \Drupal\minial_roll\Entity\Game $game */
      $game = $this->entity->game();
    }

    $form['label'] = [
      '#title' => $this->t('Label'),
      '#type' => 'textfield',
      '#default_value' => $this->entity->label(),
      '#description' => $this->t('The human-readable name of this gameelement type.'),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $this->entity->id(),
      '#maxlength' => EntityTypeInterface::BUNDLE_MAX_LENGTH,
      '#machine_name' => [
        'exists' => [GameElementType::class, 'load'],
        'source' => ['label'],
      ],
      '#description' => $this->t('A unique machine-readable name for this gameelement type. It must only contain lowercase letters, numbers, and underscores.'),
    ];

    $form['game'] = [
      '#type' => 'entity_autocomplete',
      '#target_type' => 'game',
      '#title' => 'Game',
      '#default_value' => $game ?? NULL,
      '#disabled' => TRUE,
    ];

    return $this->protectBundleIdElement($form);
  }

}
