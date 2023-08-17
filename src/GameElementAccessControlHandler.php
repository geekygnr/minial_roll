<?php declare(strict_types = 1);

namespace Drupal\minial_roll;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Defines the access control handler for the gameelement entity type.
 *
 * phpcs:disable Drupal.Arrays.Array.LongLineDeclaration
 *
 * @see https://www.drupal.org/project/coder/issues/3185082
 */
final class GameElementAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account): AccessResult {
    return match($operation) {
      'view' => AccessResult::allowedIfHasPermissions($account, ['view minial_roll_game_element', 'administer minial_roll_game_element types'], 'OR'),
      'update' => AccessResult::allowedIfHasPermissions($account, ['edit minial_roll_game_element', 'administer minial_roll_game_element types'], 'OR'),
      'delete' => AccessResult::allowedIfHasPermissions($account, ['delete minial_roll_game_element', 'administer minial_roll_game_element types'], 'OR'),
      default => AccessResult::neutral(),
    };
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL): AccessResult {
    return AccessResult::allowedIfHasPermissions($account, ['create minial_roll_game_element', 'administer minial_roll_game_element types'], 'OR');
  }

}
