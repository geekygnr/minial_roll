<?php

declare(strict_types = 1);

namespace Drupal\minial_roll\Entity;

/**
 * Defines the Squad type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "minial_roll_squad_type",
 *   label = @Translation("Squad type"),
 *   label_collection = @Translation("Squad types"),
 *   label_singular = @Translation("squad type"),
 *   label_plural = @Translation("squads types"),
 *   label_count = @PluralTranslation(
 *     singular = "@count squads type",
 *     plural = "@count squads types",
 *   ),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\minial_roll\Form\SquadTypeForm",
 *       "edit" = "Drupal\minial_roll\Form\SquadTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "list_builder" = "Drupal\minial_roll\SquadTypeListBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer minial_roll_squad types",
 *   bundle_of = "minial_roll_squad",
 *   config_prefix = "minial_roll_squad_type",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/minial_roll_squad_types/add",
 *     "edit-form" = "/admin/structure/minial_roll_squad_types/manage/{minial_roll_squad_type}",
 *     "delete-form" = "/admin/structure/minial_roll_squad_types/manage/{minial_roll_squad_type}/delete",
 *     "collection" = "/admin/structure/minial_roll_squad_types",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *     "game",
 *   },
 * )
 */
final class SquadType extends GameElementType {

}
