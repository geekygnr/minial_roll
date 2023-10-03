<?php

declare(strict_types = 1);

namespace Drupal\minial_roll\Entity;

use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\RevisionableContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\minial_roll\FactionElementItemList;
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
final class Faction extends RevisionableContentEntityBase implements FactionInterface {

  use EntityChangedTrait;
  use EntityOwnerTrait;

  /**
   * {@inheritdoc}
   */
  public function preSave(EntityStorageInterface $storage): void {
    parent::preSave($storage);
    if (!$this->getOwnerId()) {
      // If no owner has been set explicitly, make the anonymous user the owner.
      $this->setOwnerId(0);
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type): array {

    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['label'] = BaseFieldDefinition::create('string')
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setLabel(t('Label'))
      ->setRequired(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setRevisionable(TRUE)
      ->setLabel(t('Status'))
      ->setDefaultValue(TRUE)
      ->setSetting('on_label', 'Enabled')
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'settings' => [
          'display_label' => FALSE,
        ],
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'boolean',
        'label' => 'above',
        'weight' => 0,
        'settings' => [
          'format' => 'enabled-disabled',
        ],
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['description'] = BaseFieldDefinition::create('text_long')
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setLabel(t('Description'))
      ->setDisplayOptions('form', [
        'type' => 'text_textarea',
        'weight' => 10,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'text_default',
        'label' => 'above',
        'weight' => 10,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['ability_list'] = BaseFieldDefinition::create('minial_roll_attached_faction')
      ->setLabel('Abilities')
      ->setComputed(TRUE)
      ->setCardinality(FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED)
      ->setClass(FactionElementItemList::class)
      ->setSetting('entity_type', AbilityType::class)
      ->setSetting('entity', Ability::class)
      ->setDisplayConfigurable('form', FALSE)
      ->setDisplayOptions('form', [
        'region' => 'hidden',
      ])
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'minial_roll_attached_faction_formatter',
      ]);

    $fields['armour_list'] = BaseFieldDefinition::create('minial_roll_attached_faction')
      ->setLabel('Armour')
      ->setComputed(TRUE)
      ->setCardinality(FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED)
      ->setClass(FactionElementItemList::class)
      ->setSetting('entity_type', ArmourType::class)
      ->setSetting('entity', Armour::class)
      ->setDisplayConfigurable('form', FALSE)
      ->setDisplayOptions('form', [
        'region' => 'hidden',
      ])
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'minial_roll_attached_faction_formatter',
      ]);

    $fields['character_list'] = BaseFieldDefinition::create('minial_roll_attached_faction')
      ->setLabel('Characters')
      ->setComputed(TRUE)
      ->setCardinality(FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED)
      ->setClass(FactionElementItemList::class)
      ->setSetting('entity_type', CharacterType::class)
      ->setSetting('entity', Character::class)
      ->setDisplayConfigurable('form', FALSE)
      ->setDisplayOptions('form', [
        'region' => 'hidden',
      ])
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'minial_roll_attached_faction_formatter',
      ]);

    $fields['model_list'] = BaseFieldDefinition::create('minial_roll_attached_faction')
      ->setLabel('Models')
      ->setComputed(TRUE)
      ->setCardinality(FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED)
      ->setClass(FactionElementItemList::class)
      ->setSetting('entity_type', ModelType::class)
      ->setSetting('entity', Model::class)
      ->setDisplayConfigurable('form', FALSE)
      ->setDisplayOptions('form', [
        'region' => 'hidden',
      ])
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'minial_roll_attached_faction_formatter',
      ]);

    $fields['weapon_list'] = BaseFieldDefinition::create('minial_roll_attached_faction')
      ->setLabel('Weapons')
      ->setComputed(TRUE)
      ->setCardinality(FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED)
      ->setClass(FactionElementItemList::class)
      ->setSetting('entity_type', WeaponType::class)
      ->setSetting('entity', Weapon::class)
      ->setDisplayConfigurable('form', FALSE)
      ->setDisplayOptions('form', [
        'region' => 'hidden',
      ])
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'minial_roll_attached_faction_formatter',
      ]);

    $fields['uid'] = BaseFieldDefinition::create('entity_reference')
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setLabel(t('Author'))
      ->setSetting('target_type', 'user')
      ->setDefaultValueCallback(self::class . '::getDefaultEntityOwner')
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => 60,
          'placeholder' => '',
        ],
        'weight' => 15,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'author',
        'weight' => 15,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Authored on'))
      ->setTranslatable(TRUE)
      ->setDescription(t('The time that the faction was created.'))
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'timestamp',
        'weight' => 20,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('form', [
        'type' => 'datetime_timestamp',
        'weight' => 20,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setTranslatable(TRUE)
      ->setDescription(t('The time that the faction was last edited.'));

    return $fields;
  }

}
