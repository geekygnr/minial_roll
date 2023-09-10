<?php declare(strict_types = 1);

namespace Drupal\minial_roll\Entity;

use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\RevisionableContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\minial_roll\AbilityInterface;
use Drupal\user\EntityOwnerTrait;

/**
 * Defines the ability entity class.
 *
 * @ContentEntityType(
 *   id = "minial_roll_ability",
 *   label = @Translation("Ability"),
 *   label_collection = @Translation("Abilities"),
 *   label_singular = @Translation("ability"),
 *   label_plural = @Translation("abilities"),
 *   label_count = @PluralTranslation(
 *     singular = "@count abilities",
 *     plural = "@count abilities",
 *   ),
 *   bundle_label = @Translation("Ability type"),
 *   handlers = {
 *     "list_builder" = "Drupal\minial_roll\AbilityListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "access" = "Drupal\minial_roll\AbilityAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\minial_roll\Form\AbilityForm",
 *       "edit" = "Drupal\minial_roll\Form\AbilityForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *       "delete-multiple-confirm" = "Drupal\Core\Entity\Form\DeleteMultipleForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "minial_roll_ability",
 *   data_table = "minial_roll_ability_field_data",
 *   revision_table = "minial_roll_ability_revision",
 *   revision_data_table = "minial_roll_ability_field_revision",
 *   show_revision_ui = TRUE,
 *   translatable = TRUE,
 *   admin_permission = "administer minial_roll_ability types",
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
 *     "collection" = "/admin/content/ability",
 *     "add-form" = "/ability/add/{minial_roll_ability_type}",
 *     "add-page" = "/ability/add",
 *     "canonical" = "/ability/{minial_roll_ability}",
 *     "edit-form" = "/ability/{minial_roll_ability}/edit",
 *     "delete-form" = "/ability/{minial_roll_ability}/delete",
 *     "delete-multiple-form" = "/admin/content/ability/delete-multiple",
 *   },
 *   bundle_entity_type = "minial_roll_ability_type",
 *   field_ui_base_route = "entity.minial_roll_ability_type.edit_form",
 * )
 */
final class Ability extends GameElement implements AbilityInterface {

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
