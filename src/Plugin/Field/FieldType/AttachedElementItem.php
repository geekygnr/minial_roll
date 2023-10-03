<?php

declare(strict_types = 1);

namespace Drupal\minial_roll\Plugin\Field\FieldType;

use Drupal\Core\Entity\TypedData\EntityDataDefinition;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataReferenceDefinition;
use Drupal\minial_roll\Entity\GameElementType;

/**
 * Defines the 'minial_roll_attached_element' field type.
 *
 * @FieldType(
 *   id = "minial_roll_attached_element",
 *   label = @Translation("Attached Element"),
 *   category = @Translation("General"),
 *   default_widget = "string_textfield",
 *   default_formatter = "minial_roll_attached_element_formatter",
 *   no_ui = TRUE,
 * )
 */
final class AttachedElementItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition): array {
    $properties['entity'] = DataReferenceDefinition::create('entity')
      ->setDescription(new TranslatableMarkup('The referenced entity'))
      // The entity object is computed out of the entity ID.
      ->setComputed(TRUE)
      ->setReadOnly(FALSE);
    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition): array {
    return [];
  }

}
