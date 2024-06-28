<?php

declare(strict_types = 1);

namespace Drupal\minial_roll\Entity;

use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\RevisionableContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\minial_roll\GameElementItemList;
use Drupal\minial_roll\GameInterface;
use Drupal\user\EntityOwnerTrait;

/**
 * Defines the game entity class.
 *
 * @ContentEntityType(
 *   id = "minial_roll_game",
 *   label = @Translation("Game"),
 *   label_collection = @Translation("Games"),
 *   label_singular = @Translation("game"),
 *   label_plural = @Translation("games"),
 *   label_count = @PluralTranslation(
 *     singular = "@count games",
 *     plural = "@count games",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\minial_roll\GameListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "access" = "Drupal\minial_roll\GameAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\minial_roll\Form\GameForm",
 *       "edit" = "Drupal\minial_roll\Form\GameForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *       "delete-multiple-confirm" = "Drupal\Core\Entity\Form\DeleteMultipleForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "minial_roll_game",
 *   data_table = "minial_roll_game_field_data",
 *   revision_table = "minial_roll_game_revision",
 *   revision_data_table = "minial_roll_game_field_revision",
 *   show_revision_ui = TRUE,
 *   translatable = TRUE,
 *   admin_permission = "administer minial_roll_game",
 *   entity_keys = {
 *     "id" = "id",
 *     "revision" = "revision_id",
 *     "langcode" = "langcode",
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
 *     "collection" = "/admin/content/game",
 *     "add-form" = "/game/add",
 *     "canonical" = "/game/{minial_roll_game}",
 *     "edit-form" = "/game/{minial_roll_game}/edit",
 *     "delete-form" = "/game/{minial_roll_game}/delete",
 *     "delete-multiple-form" = "/admin/content/game/delete-multiple",
 *   },
 *   field_ui_base_route = "entity.minial_roll_game.settings",
 * )
 */
final class Game extends RevisionableContentEntityBase implements GameInterface {

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

    $fields['faction_list'] = BaseFieldDefinition::create('minial_roll_attached_element')
      ->setLabel('Factions')
      ->setComputed(TRUE)
      ->setCardinality(FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED)
      ->setClass(GameElementItemList::class)
      ->setSetting('entity_type', FactionType::class)
      ->setDisplayConfigurable('form', FALSE)
      ->setDisplayOptions('form', [
        'region' => 'hidden',
      ])
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'minial_roll_attached_element_formatter',
        'settings' => [
          'display_mode' => 'card',
        ],
      ]);

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
        'region' => 'hidden',
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

    $fields['stat_line'] = BaseFieldDefinition::create('entity_reference')
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setSetting('target_type', 'taxonomy_term')
      ->setLabel(t('Stats Attribute Names'))
      ->setRequired(TRUE)
      ->setCardinality(FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED)
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayOptions('form', [
        'type' => 'options_select',
        'weight' => 10,
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
        'region' => 'hidden',
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Authored on'))
      ->setTranslatable(TRUE)
      ->setDescription(t('The time that the game was created.'))
      ->setDisplayOptions('view', [
        'region' => 'hidden',
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
      ->setDescription(t('The time that the game was last edited.'));

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function postSave(EntityStorageInterface $storage, $update = TRUE) {
    parent::postSave($storage, $update);
    if ($update) {
      return;
    }
    foreach (GameElementType::ELEMENTS as $elementClass) {
      $machineName = mb_strtolower(str_replace(' ', '_', $this->label()));
      $element = call_user_func([
        $elementClass,
        'create',
      ], [
        'id' => $machineName,
        'label' => $this->label(),
        'game' => $this->id(),
      ]);
      $element->save();
    }
  }

  /**
   * {@inheritDoc}
   */
  public function delete() {
    foreach (GameElementType::ELEMENTS as $elementClass) {
      $bundle_id = $elementClass::getBundleByGame($this);
      if (!$bundle_id) {
        continue;
      }
      $bundle = $elementClass::load($bundle_id);
      $bundle->delete();
    }
    parent::delete();
  }

}
