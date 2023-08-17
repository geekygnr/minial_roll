<?php declare(strict_types = 1);

namespace Drupal\minial_roll\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the GameElement type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "minial_roll_game_element_type",
 *   label = @Translation("GameElement type"),
 *   label_collection = @Translation("GameElement types"),
 *   label_singular = @Translation("gameelement type"),
 *   label_plural = @Translation("gameelements types"),
 *   label_count = @PluralTranslation(
 *     singular = "@count gameelements type",
 *     plural = "@count gameelements types",
 *   ),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\minial_roll\Form\GameElementTypeForm",
 *       "edit" = "Drupal\minial_roll\Form\GameElementTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "list_builder" = "Drupal\minial_roll\GameElementTypeListBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer minial_roll_game_element types",
 *   bundle_of = "minial_roll_game_element",
 *   config_prefix = "minial_roll_game_element_type",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/minial_roll_game_element_types/add",
 *     "edit-form" = "/admin/structure/minial_roll_game_element_types/manage/{minial_roll_game_element_type}",
 *     "delete-form" = "/admin/structure/minial_roll_game_element_types/manage/{minial_roll_game_element_type}/delete",
 *     "collection" = "/admin/structure/minial_roll_game_element_types",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *   },
 * )
 */
final class GameElementType extends ConfigEntityBundleBase {

  /**
   * The machine name of this gameelement type.
   */
  protected string $id;

  /**
   * The human-readable name of the gameelement type.
   */
  protected string $label;

}
