<?php declare(strict_types = 1);

namespace Drupal\minial_roll\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Armour type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "minial_roll_armour_type",
 *   label = @Translation("Armour type"),
 *   label_collection = @Translation("Armour types"),
 *   label_singular = @Translation("armour type"),
 *   label_plural = @Translation("armours types"),
 *   label_count = @PluralTranslation(
 *     singular = "@count armours type",
 *     plural = "@count armours types",
 *   ),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\minial_roll\Form\ArmourTypeForm",
 *       "edit" = "Drupal\minial_roll\Form\ArmourTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "list_builder" = "Drupal\minial_roll\ArmourTypeListBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer minial_roll_armour types",
 *   bundle_of = "minial_roll_armour",
 *   config_prefix = "minial_roll_armour_type",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/minial_roll_armour_types/add",
 *     "edit-form" = "/admin/structure/minial_roll_armour_types/manage/{minial_roll_armour_type}",
 *     "delete-form" = "/admin/structure/minial_roll_armour_types/manage/{minial_roll_armour_type}/delete",
 *     "collection" = "/admin/structure/minial_roll_armour_types",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *   },
 * )
 */
final class ArmourType extends ConfigEntityBundleBase {

  /**
   * The machine name of this armour type.
   */
  protected string $id;

  /**
   * The human-readable name of the armour type.
   */
  protected string $label;

}
