<?php declare(strict_types = 1);

namespace Drupal\minial_roll\Entity;

use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\RevisionableContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\minial_roll\FactionInterface;
use Drupal\user\EntityOwnerTrait;

/**
 * Defines the faction entity class.
 *
 * @ContentEntityType(
 *   id = "minial_roll_faction",
 *   label = @Translation("Faction"),
 *   label_collection = @Translation("Factions"),
 *   label_singular = @Translation("faction"),
 *   label_plural = @Translation("factions"),
 *   label_count = @PluralTranslation(
 *     singular = "@count factions",
 *     plural = "@count factions",
 *   ),
 *   bundle_label = @Translation("Faction type"),
 *   handlers = {
 *     "list_builder" = "Drupal\minial_roll\FactionListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "access" = "Drupal\minial_roll\FactionAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\minial_roll\Form\FactionForm",
 *       "edit" = "Drupal\minial_roll\Form\FactionForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *       "delete-multiple-confirm" = "Drupal\Core\Entity\Form\DeleteMultipleForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "minial_roll_faction",
 *   data_table = "minial_roll_faction_field_data",
 *   revision_table = "minial_roll_faction_revision",
 *   revision_data_table = "minial_roll_faction_field_revision",
 *   show_revision_ui = TRUE,
 *   translatable = TRUE,
 *   admin_permission = "administer minial_roll_faction types",
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
 *     "collection" = "/admin/content/faction",
 *     "add-form" = "/faction/add/{minial_roll_faction_type}",
 *     "add-page" = "/faction/add",
 *     "canonical" = "/faction/{minial_roll_faction}",
 *     "edit-form" = "/faction/{minial_roll_faction}/edit",
 *     "delete-form" = "/faction/{minial_roll_faction}/delete",
 *     "delete-multiple-form" = "/admin/content/faction/delete-multiple",
 *   },
 *   bundle_entity_type = "minial_roll_faction_type",
 *   field_ui_base_route = "entity.minial_roll_faction_type.edit_form",
 * )
 */
final class Faction extends GameElement implements FactionInterface {

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
