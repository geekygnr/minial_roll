<?php

namespace Drupal\minial_roll;

use Drupal\Core\Field\FieldItemList;
use Drupal\Core\TypedData\ComputedItemListTrait;
use Drupal\minial_roll\Entity\FactionType;
use Drupal\minial_roll\Entity\Game;

class AttachedFactionItemList extends FieldItemList {
  use ComputedItemListTrait;

  /**
   * {@inheritDoc}
   */
  protected function computeValue(): array {
    if (isset($this->list[0])) {
      return $this->list;
    }
    /** @var \Drupal\minial_roll\Entity\Game $game */
    $game = $this->getEntity();
    if (!$game instanceof Game) {
      return [];
    }
    $factions = FactionType::loadElementsByGame($game);
    $delta = 0;
    foreach ($factions as $faction) {
      $this->list[$delta] = $this->createItem($delta, $faction);
      $delta++;
    }
    return $this->list;
  }

}
