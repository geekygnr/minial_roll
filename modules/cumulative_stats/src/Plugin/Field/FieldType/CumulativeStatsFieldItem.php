<?php declare(strict_types = 1);

namespace Drupal\cumulative_stats\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Field\Plugin\Field\FieldType\MapItem;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines the 'cumulative_stats_field' field type.
 *
 * @FieldType(
 *   id = "cumulative_stats_field",
 *   label = @Translation("Cumulative Stats Field"),
 *   category = @Translation("General"),
 *   default_widget = "cumulative_stats_value_widget",
 *   default_formatter = "cumulative_stats_formatter",
 *   list_class = "\Drupal\Core\Field\MapFieldItemList",
 * )
 */
final class CumulativeStatsFieldItem extends MapItem {

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    return [
        'allowed_stats' => [],
      ] + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) {
    $element = [];

    $entity = $this->getEntity();
    $entity_storage = \Drupal::entityTypeManager()->getStorage($entity->getEntityType()->getBundleEntityType());
    $entityType = $entity_storage->load($entity->bundle());
    $game = $entityType->game();
    $stats = $game->get('stat_line');
    $options = [];
    foreach ($stats as $stat) {
      $term = $stat->entity;
      $options[$term->id()] = $term->label();
    }
    $element['allowed_stats'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Allowed Stats'),
      '#options' => $options,
      '#default_value' => $this->getSetting('allowed_stats'),
      '#required' => TRUE,
      '#description' => $this->t('The stats that are allowed for this field (leave empty for all).'),
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    return empty($this->values);
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    // The properties are dynamic and can not be defined statically.
    return [];
  }

}
