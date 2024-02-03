<?php

declare(strict_types = 1);

namespace Drupal\minial_roll\Entity;

/**
 * Defines the Ability type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "minial_roll_ability_type",
 *   label = @Translation("Ability type"),
 *   label_collection = @Translation("Ability types"),
 *   label_singular = @Translation("ability type"),
 *   label_plural = @Translation("abilities types"),
 *   label_count = @PluralTranslation(
 *     singular = "@count abilities type",
 *     plural = "@count abilities types",
 *   ),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\minial_roll\Form\AbilityTypeForm",
 *       "edit" = "Drupal\minial_roll\Form\AbilityTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "list_builder" = "Drupal\minial_roll\AbilityTypeListBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer minial_roll_ability types",
 *   bundle_of = "minial_roll_ability",
 *   config_prefix = "minial_roll_ability_type",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/minial_roll_ability_types/add",
 *     "edit-form" = "/admin/structure/minial_roll_ability_types/manage/{minial_roll_ability_type}",
 *     "delete-form" = "/admin/structure/minial_roll_ability_types/manage/{minial_roll_ability_type}/delete",
 *     "collection" = "/admin/structure/minial_roll_ability_types",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *     "game",
 *   },
 * )
 */
final class AbilityType extends GameElementType {

}
