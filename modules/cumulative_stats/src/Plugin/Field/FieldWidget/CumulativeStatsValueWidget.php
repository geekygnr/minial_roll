<?php declare(strict_types = 1);

namespace Drupal\cumulative_stats\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\taxonomy\Entity\Term;

/**
 * Defines the 'cumulative_stats_value_widget' field widget.
 *
 * @FieldWidget(
 *   id = "cumulative_stats_value_widget",
 *   label = @Translation("Cumlative Stats"),
 *   field_types = {"cumulative_stats_field"},
 * )
 */
final class CumulativeStatsValueWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state): array {
    $stats = $this->getFieldSetting('allowed_stats');
    $element = $element + [
      '#type' => 'fieldset',
    ];
    foreach ($stats as $id => $stat) {
      if (!$stat) {
        continue;
      }
      $term = Term::load($id);
      $element['value']['stat_' . $id] = [
        '#type' => 'textfield',
        '#title' => $term->getName(),
        '#maxlength' => 5,
        '#size' => 5,
        '#pattern' => '[\+\-]?[0-9]+',
        '#default_value' => $items[$delta]->value['stat_' . $id] ?? '',
      ];
    }
    return $element;
  }

}
