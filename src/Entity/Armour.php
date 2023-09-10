<?php declare(strict_types = 1);

namespace Drupal\minial_roll\Entity;

use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\RevisionableContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\minial_roll\ArmourInterface;
use Drupal\user\EntityOwnerTrait;

/**
 * Defines the armour entity class.
 *
 * @ContentEntityType(
 *   id = "minial_roll_armour",
 *   label = @Translation("Armour"),
 *   label_collection = @Translation("Armours"),
 *   label_singular = @Translation("armour"),
 *   label_plural = @Translation("armours"),
 *   label_count = @PluralTranslation(
 *     singular = "@count armours",
 *     plural = "@count armours",
 *   ),
 *   bundle_label = @Translation("Armour type"),
 *   handlers = {
 *     "list_builder" = "Drupal\minial_roll\ArmourListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "access" = "Drupal\minial_roll\ArmourAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\minial_roll\Form\ArmourForm",
 *       "edit" = "Drupal\minial_roll\Form\ArmourForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *       "delete-multiple-confirm" = "Drupal\Core\Entity\Form\DeleteMultipleForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "minial_roll_armour",
 *   data_table = "minial_roll_armour_field_data",
 *   revision_table = "minial_roll_armour_revision",
 *   revision_data_table = "minial_roll_armour_field_revision",
 *   show_revision_ui = TRUE,
 *   translatable = TRUE,
 *   admin_permission = "administer minial_roll_armour types",
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
 *     "collection" = "/admin/content/armour",
 *     "add-form" = "/armour/add/{minial_roll_armour_type}",
 *     "add-page" = "/armour/add",
 *     "canonical" = "/armour/{minial_roll_armour}",
 *     "edit-form" = "/armour/{minial_roll_armour}/edit",
 *     "delete-form" = "/armour/{minial_roll_armour}/delete",
 *     "delete-multiple-form" = "/admin/content/armour/delete-multiple",
 *   },
 *   bundle_entity_type = "minial_roll_armour_type",
 *   field_ui_base_route = "entity.minial_roll_armour_type.edit_form",
 * )
 */
final class Armour extends GameElement implements ArmourInterface {

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
