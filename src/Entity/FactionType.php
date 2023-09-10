<?php declare(strict_types = 1);

namespace Drupal\minial_roll\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Faction type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "minial_roll_faction_type",
 *   label = @Translation("Faction type"),
 *   label_collection = @Translation("Faction types"),
 *   label_singular = @Translation("faction type"),
 *   label_plural = @Translation("factions types"),
 *   label_count = @PluralTranslation(
 *     singular = "@count factions type",
 *     plural = "@count factions types",
 *   ),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\minial_roll\Form\FactionTypeForm",
 *       "edit" = "Drupal\minial_roll\Form\FactionTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "list_builder" = "Drupal\minial_roll\FactionTypeListBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer minial_roll_faction types",
 *   bundle_of = "minial_roll_faction",
 *   config_prefix = "minial_roll_faction_type",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/minial_roll_faction_types/add",
 *     "edit-form" = "/admin/structure/minial_roll_faction_types/manage/{minial_roll_faction_type}",
 *     "delete-form" = "/admin/structure/minial_roll_faction_types/manage/{minial_roll_faction_type}/delete",
 *     "collection" = "/admin/structure/minial_roll_faction_types",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *     "game",
 *   },
 * )
 */
final class FactionType extends GameElementType {

}
