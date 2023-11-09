<?php declare(strict_types = 1);

namespace Drupal\minial_roll\Plugin\EntityReferenceSelection;

use Drupal\Core\Entity\Plugin\EntityReferenceSelection\DefaultSelection;
use Drupal\Core\Entity\Query\QueryInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\minial_roll\Entity\Ability;
use Drupal\minial_roll\Entity\AbilityType;

/**
 * @todo Add plugin description here.
 *
 * @EntityReferenceSelection(
 *   id = "minial_roll_faction_selection",
 *   label = @Translation("Minial Roll Faction Selection"),
 *   group = "minial_roll_faction_selection",
 *   entity_types = {
 *     "minial_roll_faction"
 *   },
 * )
 */
final class MinialRollFactionSelection extends DefaultSelection {

  /**
   * {@inheritdoc}
   */
  protected function buildEntityQuery($match = NULL, $match_operator = 'CONTAINS'): QueryInterface {
    $query = parent::buildEntityQuery($match, $match_operator);
    $entity = $this->configuration['entity'];
    if ($entity) {
      $bundleId = $entity->bundle();
      $bundleKey = $entity->getEntityType()->getKey('bundle');
      $query->condition($bundleKey, $bundleId);
    }
    return $query;
  }

}
