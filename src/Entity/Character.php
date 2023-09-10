<?php declare(strict_types = 1);

namespace Drupal\minial_roll\Entity;

use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\RevisionableContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\minial_roll\CharacterInterface;
use Drupal\user\EntityOwnerTrait;

/**
 * Defines the character entity class.
 *
 * @ContentEntityType(
 *   id = "minial_roll_character",
 *   label = @Translation("Character"),
 *   label_collection = @Translation("Characters"),
 *   label_singular = @Translation("character"),
 *   label_plural = @Translation("characters"),
 *   label_count = @PluralTranslation(
 *     singular = "@count characters",
 *     plural = "@count characters",
 *   ),
 *   bundle_label = @Translation("Character type"),
 *   handlers = {
 *     "list_builder" = "Drupal\minial_roll\CharacterListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "access" = "Drupal\minial_roll\CharacterAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\minial_roll\Form\CharacterForm",
 *       "edit" = "Drupal\minial_roll\Form\CharacterForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *       "delete-multiple-confirm" = "Drupal\Core\Entity\Form\DeleteMultipleForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "minial_roll_character",
 *   data_table = "minial_roll_character_field_data",
 *   revision_table = "minial_roll_character_revision",
 *   revision_data_table = "minial_roll_character_field_revision",
 *   show_revision_ui = TRUE,
 *   translatable = TRUE,
 *   admin_permission = "administer minial_roll_character types",
 *   entity_keys = {
 *     "id" = "id",
 *     "revision" = "revision_id",
 *     "langcode" = "langcode",
 *     "bundle" = "bundle",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *     "owner" = "uid",
 *   },
 *   revision_metadata_keys = {
 *     "revision_user" = "revision_uid",
 *     "revision_created" = "revision_timestamp",
 *     "revision_log_message" = "revision_log",
 *   },
 *   links = {
 *     "collection" = "/admin/content/character",
 *     "add-form" = "/character/add/{minial_roll_character_type}",
 *     "add-page" = "/character/add",
 *     "canonical" = "/character/{minial_roll_character}",
 *     "edit-form" = "/character/{minial_roll_character}/edit",
 *     "delete-form" = "/character/{minial_roll_character}/delete",
 *     "delete-multiple-form" = "/admin/content/character/delete-multiple",
 *   },
 *   bundle_entity_type = "minial_roll_character_type",
 *   field_ui_base_route = "entity.minial_roll_character_type.edit_form",
 * )
 */
final class Character extends GameElement implements CharacterInterface {

  use EntityChangedTrait;
  use EntityOwnerTrait;

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type): array {

    $fields = parent::baseFieldDefinitions($entity_type);

    return $fields;
  }

}
