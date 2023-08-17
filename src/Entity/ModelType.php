<?php declare(strict_types = 1);

namespace Drupal\minial_roll\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Model type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "minial_roll_model_type",
 *   label = @Translation("Model type"),
 *   label_collection = @Translation("Model types"),
 *   label_singular = @Translation("model type"),
 *   label_plural = @Translation("models types"),
 *   label_count = @PluralTranslation(
 *     singular = "@count models type",
 *     plural = "@count models types",
 *   ),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\minial_roll\Form\ModelTypeForm",
 *       "edit" = "Drupal\minial_roll\Form\ModelTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "list_builder" = "Drupal\minial_roll\ModelTypeListBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer minial_roll_model types",
 *   bundle_of = "minial_roll_model",
 *   config_prefix = "minial_roll_model_type",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/minial_roll_model_types/add",
 *     "edit-form" = "/admin/structure/minial_roll_model_types/manage/{minial_roll_model_type}",
 *     "delete-form" = "/admin/structure/minial_roll_model_types/manage/{minial_roll_model_type}/delete",
 *     "collection" = "/admin/structure/minial_roll_model_types",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *   },
 * )
 */
final class ModelType extends ConfigEntityBundleBase {

  /**
   * The machine name of this model type.
   */
  protected string $id;

  /**
   * The human-readable name of the model type.
   */
  protected string $label;

}
