<?php declare(strict_types = 1);

namespace Drupal\minial_roll;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining an ability entity type.
 */
interface AbilityInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
