<?php declare(strict_types = 1);

namespace Drupal\minial_roll;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a gameelement entity type.
 */
interface GameElementInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
