<?php declare(strict_types = 1);

namespace Drupal\minial_roll\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Character type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "minial_roll_character_type",
 *   label = @Translation("Character type"),
 *   label_collection = @Translation("Character types"),
 *   label_singular = @Translation("character type"),
 *   label_plural = @Translation("characters types"),
 *   label_count = @PluralTranslation(
 *     singular = "@count characters type",
 *     plural = "@count characters types",
 *   ),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\minial_roll\Form\CharacterTypeForm",
 *       "edit" = "Drupal\minial_roll\Form\CharacterTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "list_builder" = "Drupal\minial_roll\CharacterTypeListBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer minial_roll_character types",
 *   bundle_of = "minial_roll_character",
 *   config_prefix = "minial_roll_character_type",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/minial_roll_character_types/add",
 *     "edit-form" = "/admin/structure/minial_roll_character_types/manage/{minial_roll_character_type}",
 *     "delete-form" = "/admin/structure/minial_roll_character_types/manage/{minial_roll_character_type}/delete",
 *     "collection" = "/admin/structure/minial_roll_character_types",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *   },
 * )
 */
final class CharacterType extends ConfigEntityBundleBase {

  /**
   * The machine name of this character type.
   */
  protected string $id;

  /**
   * The human-readable name of the character type.
   */
  protected string $label;

}
