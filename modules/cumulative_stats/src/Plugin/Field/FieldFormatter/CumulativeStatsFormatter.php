<?php

declare(strict_types=1);

namespace Drupal\cumulative_stats\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\minial_roll\Entity\GameElement;

/**
 * Plugin implementation of the 'Cumulative Stats Formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "cumulative_stats_formatter",
 *   label = @Translation("Cumulative Stats Formatter"),
 *   field_types = {"cumulative_stats_field"},
 * )
 */
final class CumulativeStatsFormatter extends FormatterBase {
  private $stats = [];

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode): array {
    $element = [];
    foreach ($items as $item) {
      $this->loadStats($item);
    }
    $entity = $items->getEntity();
    $this->loadChildStats($entity);
    $this->compressStats();
    $entity_storage = \Drupal::entityTypeManager()->getStorage($entity->getEntityType()->getBundleEntityType());
    $entityType = $entity_storage->load($entity->bundle());
    $game = $entityType->game();
    $stats = $game->get('stat_line');
    foreach ($stats as $stat) {
      $term = $stat->entity;
      $element[$term->id()] = [
        '#markup' => $term->label() . ':' . ($this->stats['stat_' . $term->id()] ?? '--') . '<br />',
      ];
    }
    return $element;
  }

  private function loadChildStats($entity) {
    $fieldName = $this->fieldDefinition->getName();
    $fields = $entity->getFields();
    foreach ($fields as $field) {
      $definition = $field->getFieldDefinition();
      if ($definition->getType() != 'entity_reference') {
        continue;
      }
      foreach ($field as $value) {
        $refEntity = $value->entity;
        if (!$refEntity instanceof GameElement) {
          continue;
        }
        if ($statsField = $refEntity->{$fieldName}) {
          $this->loadStats($statsField);
        }
      }
    }
  }

  private function loadStats($field) {
    $values = $field->value;
    if (!$values) {
      return;
    }
    foreach ($values as $index => $value) {
      if (empty($value)) {
        continue;
      }
      if (empty($this->stats[$index])) {
        $this->stats[$index] = [];
      }
      if (str_starts_with($value, '+') || str_starts_with($value, '-')) {
        $this->stats[$index][] = $value;
        continue;
      }
      array_unshift($this->stats[$index], $value);
    }
  }

  private function compressStats() {
    foreach ($this->stats as $index => $stats) {
      $value = 0;
      foreach ($stats as $stat) {
        if (str_starts_with($stat, '+') || str_starts_with($stat, '-')) {
          $value += intval($stat);
          continue;
        }
        $value = intval($stat);
      }
      $this->stats[$index] = $value;
    }
  }

}
