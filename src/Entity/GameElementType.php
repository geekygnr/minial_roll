<?php declare(strict_types = 1);

namespace Drupal\minial_roll\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the GameElement type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "minial_roll_game_element_type",
 *   label = @Translation("Game Element type"),
 *   label_collection = @Translation("Game Element types"),
 *   label_singular = @Translation("Game Element type"),
 *   label_plural = @Translation("Game Elements types"),
 *   label_count = @PluralTranslation(
 *     singular = "@count Game Elements type",
 *     plural = "@count Game Elements types",
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
 *     "game",
 *   },
 * )
 */
class GameElementType extends ConfigEntityBundleBase {

  /**
   * All game element classes.
   */
  const ELEMENTS = [
    AbilityType::class,
    ArmourType::class,
    CharacterType::class,
    FactionType::class,
    ModelType::class,
    WeaponType::class,
  ];

  /**
   * The machine name of this game element type.
   */
  protected string $id;

  /**
   * The human-readable name of the game element type.
   */
  protected string $label;

  /**
   * The game entity this element belongs to.
   */
  protected int $game;

  /**
   * @return \Drupal\minial_roll\Entity\Game
   */
  public function game(): Game {
    return Game::load($this->game);
  }

}
