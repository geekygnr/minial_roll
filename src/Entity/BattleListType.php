<?php declare(strict_types = 1);

namespace Drupal\minial_roll\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Battle List type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "minial_roll_battle_list_type",
 *   label = @Translation("Battle List type"),
 *   label_collection = @Translation("Battle List types"),
 *   label_singular = @Translation("battle list type"),
 *   label_plural = @Translation("battle lists types"),
 *   label_count = @PluralTranslation(
 *     singular = "@count battle lists type",
 *     plural = "@count battle lists types",
 *   ),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\minial_roll\Form\BattleListTypeForm",
 *       "edit" = "Drupal\minial_roll\Form\BattleListTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "list_builder" = "Drupal\minial_roll\BattleListTypeListBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer minial_roll_battle_list types",
 *   bundle_of = "minial_roll_battle_list",
 *   config_prefix = "minial_roll_battle_list_type",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/minial_roll_battle_list_types/add",
 *     "edit-form" = "/admin/structure/minial_roll_battle_list_types/manage/{minial_roll_battle_list_type}",
 *     "delete-form" = "/admin/structure/minial_roll_battle_list_types/manage/{minial_roll_battle_list_type}/delete",
 *     "collection" = "/admin/structure/minial_roll_battle_list_types",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *   },
 * )
 */
final class BattleListType extends ConfigEntityBundleBase {

  /**
   * The machine name of this battle list type.
   */
  protected string $id;

  /**
   * The human-readable name of the battle list type.
   */
  protected string $label;

}
