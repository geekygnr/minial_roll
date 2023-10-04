<?php declare(strict_types = 1);

namespace Drupal\minial_roll\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;
use Drupal\Core\Entity\EntityStorageInterface;

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
   * {@inheritDoc}
   */
  public function postSave(EntityStorageInterface $storage, $update = TRUE) {
    parent::postSave($storage, $update);
    if ($update) {
      return;
    }
    /** @var \Drupal\Core\Entity\EntityDisplayRepositoryInterface $displayRepo */
    $displayRepo = \Drupal::service('entity_display.repository');
    $display = $displayRepo->getViewDisplay($this->getEntityType()->getBundleOf(), $this->id(), 'card');
    $display->enable();
    $components = $display->getComponents();
    foreach ($components as $id => $component) {
      if ($id == 'label') {
        $display->setComponent($id, [
          'label' => 'hidden',
          'type' => 'string',
          'settings' => [
            'link_to_entity' => TRUE,
          ],
        ]);
        continue;
      }
      $display->removeComponent($id);
    }
    $display->save();
  }

  /**
   * {@inheritdoc}
   */
  public function delete() {
    $entities = $this->entityTypeManager()->getStorage($this->getEntityType()->getBundleOf())->loadByProperties(['bundle' => $this->id()]);
    foreach ($entities as $entity) {
      $entity->delete();
    }
    parent::delete();
  }

  /**
   * @return \Drupal\minial_roll\Entity\Game
   */
  public function game(): Game {
    return Game::load($this->game);
  }

  public static function getBundleByGame(Game $game) {
    if (empty($game->id())) {
      return NULL;
    }
    $entity_type_repository = \Drupal::service('entity_type.repository');
    $entity_type = $entity_type_repository->getEntityTypeFromClass(static::class);
    $results = \Drupal::entityTypeManager()->getStorage($entity_type)->getQuery()
      ->condition('game', $game->id())
      ->execute();
    return array_pop($results);
  }

  public static function loadElementsByGame(Game $game): array {
    $id = self::getBundleByGame($game);
    if (empty($id)) {
      return [];
    }
    $element_type = static::load($id);
    $entity_storage = \Drupal::entityTypeManager()->getStorage($element_type->getEntityType()->getBundleOf());
    $results = $entity_storage->getQuery()
      ->accessCheck()
      ->condition('bundle', $element_type->id())
      ->execute();
    return $entity_storage->loadMultiple($results);
  }

}
