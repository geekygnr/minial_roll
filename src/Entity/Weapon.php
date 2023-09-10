<?php declare(strict_types = 1);

namespace Drupal\minial_roll\Entity;

use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\RevisionableContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\minial_roll\WeaponInterface;
use Drupal\user\EntityOwnerTrait;

/**
 * Defines the weapon entity class.
 *
 * @ContentEntityType(
 *   id = "minial_roll_weapon",
 *   label = @Translation("Weapon"),
 *   label_collection = @Translation("Weapons"),
 *   label_singular = @Translation("weapon"),
 *   label_plural = @Translation("weapons"),
 *   label_count = @PluralTranslation(
 *     singular = "@count weapons",
 *     plural = "@count weapons",
 *   ),
 *   bundle_label = @Translation("Weapon type"),
 *   handlers = {
 *     "list_builder" = "Drupal\minial_roll\WeaponListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "access" = "Drupal\minial_roll\WeaponAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\minial_roll\Form\WeaponForm",
 *       "edit" = "Drupal\minial_roll\Form\WeaponForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *       "delete-multiple-confirm" = "Drupal\Core\Entity\Form\DeleteMultipleForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "minial_roll_weapon",
 *   data_table = "minial_roll_weapon_field_data",
 *   revision_table = "minial_roll_weapon_revision",
 *   revision_data_table = "minial_roll_weapon_field_revision",
 *   show_revision_ui = TRUE,
 *   translatable = TRUE,
 *   admin_permission = "administer minial_roll_weapon types",
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
 *     "collection" = "/admin/content/weapon",
 *     "add-form" = "/weapon/add/{minial_roll_weapon_type}",
 *     "add-page" = "/weapon/add",
 *     "canonical" = "/weapon/{minial_roll_weapon}",
 *     "edit-form" = "/weapon/{minial_roll_weapon}/edit",
 *     "delete-form" = "/weapon/{minial_roll_weapon}/delete",
 *     "delete-multiple-form" = "/admin/content/weapon/delete-multiple",
 *   },
 *   bundle_entity_type = "minial_roll_weapon_type",
 *   field_ui_base_route = "entity.minial_roll_weapon_type.edit_form",
 * )
 */
final class Weapon extends GameElement implements WeaponInterface {

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
