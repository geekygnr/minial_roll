<?php declare(strict_types = 1);

namespace Drupal\minial_roll\Plugin\EntityReferenceSelection;

use Drupal\Core\Entity\Plugin\EntityReferenceSelection\DefaultSelection;
use Drupal\Core\Entity\Query\QueryInterface;

/**
 * @todo Add plugin description here.
 *
 * @EntityReferenceSelection(
 *   id = "minial_roll_game_element_selection",
 *   label = @Translation("Minial Roll Game Element Selection"),
 *   group = "minial_roll_game_element_selection",
 *   entity_types = {
 *     "minial_roll_armour",
 *     "minial_roll_character",
 *     "minial_roll_weapon",
 *     "minial_roll_model",
 *     "minial_roll_ability"
 *   },
 * )
 */
final class MinialRollGameElementSelection extends DefaultSelection {

  /**
   * {@inheritdoc}
   */
  protected function buildEntityQuery($match = NULL, $match_operator = 'CONTAINS'): QueryInterface {
    $query = parent::buildEntityQuery($match, $match_operator);
    $entity = $this->configuration['entity'];
    $faction = $entity->faction->entity;
    $query->condition('faction', $faction->id());
    return $query;
  }

}
