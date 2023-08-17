<?php declare(strict_types = 1);

namespace Drupal\minial_roll\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Weapon type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "minial_roll_weapon_type",
 *   label = @Translation("Weapon type"),
 *   label_collection = @Translation("Weapon types"),
 *   label_singular = @Translation("weapon type"),
 *   label_plural = @Translation("weapons types"),
 *   label_count = @PluralTranslation(
 *     singular = "@count weapons type",
 *     plural = "@count weapons types",
 *   ),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\minial_roll\Form\WeaponTypeForm",
 *       "edit" = "Drupal\minial_roll\Form\WeaponTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "list_builder" = "Drupal\minial_roll\WeaponTypeListBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer minial_roll_weapon types",
 *   bundle_of = "minial_roll_weapon",
 *   config_prefix = "minial_roll_weapon_type",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/minial_roll_weapon_types/add",
 *     "edit-form" = "/admin/structure/minial_roll_weapon_types/manage/{minial_roll_weapon_type}",
 *     "delete-form" = "/admin/structure/minial_roll_weapon_types/manage/{minial_roll_weapon_type}/delete",
 *     "collection" = "/admin/structure/minial_roll_weapon_types",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *   },
 * )
 */
final class WeaponType extends ConfigEntityBundleBase {

  /**
   * The machine name of this weapon type.
   */
  protected string $id;

  /**
   * The human-readable name of the weapon type.
   */
  protected string $label;

}
