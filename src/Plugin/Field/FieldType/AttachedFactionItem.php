<?php

declare(strict_types = 1);

namespace Drupal\minial_roll\Plugin\Field\FieldType;

use Drupal\Core\Entity\TypedData\EntityDataDefinition;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataReferenceDefinition;

/**
 * Defines the 'minial_roll_attached_faction' field type.
 *
 * @FieldType(
 *   id = "minial_roll_attached_faction",
 *   label = @Translation("Attached Faction"),
 *   category = @Translation("General"),
 *   default_widget = "string_textfield",
 *   default_formatter = "minial_roll_attached_faction_formatter",
 *   list_class = "\Drupal\minial_roll\AttachedFactionItemList",
 *   no_ui = TRUE,
 * )
 */
final class AttachedFactionItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition): array {
    $target_type_info = \Drupal::entityTypeManager()->getDefinition('minial_roll_faction');
    $properties['entity'] = DataReferenceDefinition::create('entity')
      ->setLabel($target_type_info->getLabel())
      ->setDescription(new TranslatableMarkup('The referenced entity'))
      // The entity object is computed out of the entity ID.
      ->setComputed(TRUE)
      ->setReadOnly(FALSE)
      ->setTargetDefinition(EntityDataDefinition::create('minial_roll_faction'))
      // We can add a constraint for the target entity type. The list of
      // referenceable bundles is a field setting, so the corresponding
      // constraint is added dynamically in ::getConstraints().
      ->addConstraint('EntityType', 'minial_roll_faction');
    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition): array {
    return [];
  }

}
