<?php

namespace Drupal\minial_roll;

use Drupal\Core\Field\FieldItemList;
use Drupal\Core\TypedData\ComputedItemListTrait;
use Drupal\minial_roll\Entity\Faction;

/**
 *
 */
class FactionElementItemList extends FieldItemList {
  use ComputedItemListTrait;

  /**
   * {@inheritDoc}
   */
  protected function computeValue(): array {
    if (isset($this->list[0])) {
      return $this->list;
    }
    $entity_type = $this->getSetting('entity');
    /** @var \Drupal\minial_roll\Entity\GameElement $element */
    $faction = $this->getEntity();
    if (!$faction instanceof Faction) {
      return [];
    }
    $elements = $entity_type::loadByFaction($faction);
    $delta = 0;
    foreach ($elements as $element) {
      $this->list[$delta] = $this->createItem($delta, $element);
      $delta++;
    }
    return $this->list;
  }

}
