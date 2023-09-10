<?php declare(strict_types = 1);

namespace Drupal\minial_roll\Entity;

use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\RevisionableContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\minial_roll\ModelInterface;
use Drupal\user\EntityOwnerTrait;

/**
 * Defines the model entity class.
 *
 * @ContentEntityType(
 *   id = "minial_roll_model",
 *   label = @Translation("Model"),
 *   label_collection = @Translation("Models"),
 *   label_singular = @Translation("model"),
 *   label_plural = @Translation("models"),
 *   label_count = @PluralTranslation(
 *     singular = "@count models",
 *     plural = "@count models",
 *   ),
 *   bundle_label = @Translation("Model type"),
 *   handlers = {
 *     "list_builder" = "Drupal\minial_roll\ModelListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "access" = "Drupal\minial_roll\ModelAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\minial_roll\Form\ModelForm",
 *       "edit" = "Drupal\minial_roll\Form\ModelForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *       "delete-multiple-confirm" = "Drupal\Core\Entity\Form\DeleteMultipleForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "minial_roll_model",
 *   data_table = "minial_roll_model_field_data",
 *   revision_table = "minial_roll_model_revision",
 *   revision_data_table = "minial_roll_model_field_revision",
 *   show_revision_ui = TRUE,
 *   translatable = TRUE,
 *   admin_permission = "administer minial_roll_model types",
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
 *     "collection" = "/admin/content/model",
 *     "add-form" = "/model/add/{minial_roll_model_type}",
 *     "add-page" = "/model/add",
 *     "canonical" = "/model/{minial_roll_model}",
 *     "edit-form" = "/model/{minial_roll_model}/edit",
 *     "delete-form" = "/model/{minial_roll_model}/delete",
 *     "delete-multiple-form" = "/admin/content/model/delete-multiple",
 *   },
 *   bundle_entity_type = "minial_roll_model_type",
 *   field_ui_base_route = "entity.minial_roll_model_type.edit_form",
 * )
 */
final class Model extends GameElement implements ModelInterface {

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
