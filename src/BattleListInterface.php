<?php declare(strict_types = 1);

namespace Drupal\minial_roll;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a battle list entity type.
 */
interface BattleListInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
