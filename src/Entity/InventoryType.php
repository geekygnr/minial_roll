<?php declare(strict_types = 1);

namespace Drupal\minial_roll\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Inventory type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "minial_roll_inventory_type",
 *   label = @Translation("Inventory type"),
 *   label_collection = @Translation("Inventory types"),
 *   label_singular = @Translation("inventory type"),
 *   label_plural = @Translation("inventories types"),
 *   label_count = @PluralTranslation(
 *     singular = "@count inventories type",
 *     plural = "@count inventories types",
 *   ),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\minial_roll\Form\InventoryTypeForm",
 *       "edit" = "Drupal\minial_roll\Form\InventoryTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "list_builder" = "Drupal\minial_roll\InventoryTypeListBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer minial_roll_inventory types",
 *   bundle_of = "minial_roll_inventory",
 *   config_prefix = "minial_roll_inventory_type",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/minial_roll_inventory_types/add",
 *     "edit-form" = "/admin/structure/minial_roll_inventory_types/manage/{minial_roll_inventory_type}",
 *     "delete-form" = "/admin/structure/minial_roll_inventory_types/manage/{minial_roll_inventory_type}/delete",
 *     "collection" = "/admin/structure/minial_roll_inventory_types",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *   },
 * )
 */
final class InventoryType extends ConfigEntityBundleBase {

  /**
   * The machine name of this inventory type.
   */
  protected string $id;

  /**
   * The human-readable name of the inventory type.
   */
  protected string $label;

}
