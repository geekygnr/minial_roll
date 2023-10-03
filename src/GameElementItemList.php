<?php

namespace Drupal\minial_roll;

use Drupal\Core\Field\FieldItemList;
use Drupal\Core\TypedData\ComputedItemListTrait;
use Drupal\minial_roll\Entity\Game;

/**
 *
 */
class GameElementItemList extends FieldItemList {
  use ComputedItemListTrait;

  /**
   * {@inheritDoc}
   */
  protected function computeValue(): array {
    if (isset($this->list[0])) {
      return $this->list;
    }
    $entity_type = $this->getSetting('entity_type');
    /** @var \Drupal\minial_roll\Entity\Game $game */
    $game = $this->getEntity();
    if (!$game instanceof Game) {
      return [];
    }
    $factions = $entity_type::loadElementsByGame($game);
    $delta = 0;
    foreach ($factions as $faction) {
      $this->list[$delta] = $this->createItem($delta, $faction);
      $delta++;
    }
    return $this->list;
  }

}
