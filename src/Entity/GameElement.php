<?php declare(strict_types = 1);

namespace Drupal\minial_roll\Entity;

use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\RevisionableContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\minial_roll\AttachedFactionItemList;
use Drupal\minial_roll\GameElementInterface;
use Drupal\user\EntityOwnerTrait;

/**
 * Defines the gameelement entity class.
 *
 * @ContentEntityType(
 *   id = "minial_roll_game_element",
 *   label = @Translation("GameElement"),
 *   label_collection = @Translation("GameElements"),
 *   label_singular = @Translation("gameelement"),
 *   label_plural = @Translation("gameelements"),
 *   label_count = @PluralTranslation(
 *     singular = "@count gameelements",
 *     plural = "@count gameelements",
 *   ),
 *   bundle_label = @Translation("GameElement type"),
 *   handlers = {
 *     "list_builder" = "Drupal\minial_roll\GameElementListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "access" = "Drupal\minial_roll\GameElementAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\minial_roll\Form\GameElementForm",
 *       "edit" = "Drupal\minial_roll\Form\GameElementForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *       "delete-multiple-confirm" = "Drupal\Core\Entity\Form\DeleteMultipleForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "minial_roll_game_element",
 *   data_table = "minial_roll_game_element_field_data",
 *   revision_table = "minial_roll_game_element_revision",
 *   revision_data_table = "minial_roll_game_element_field_revision",
 *   show_revision_ui = TRUE,
 *   translatable = TRUE,
 *   admin_permission = "administer minial_roll_game_element types",
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
 *     "collection" = "/admin/content/game-element",
 *     "add-form" = "/game-element/add/{minial_roll_game_element_type}",
 *     "add-page" = "/game-element/add",
 *     "canonical" = "/game-element/{minial_roll_game_element}",
 *     "edit-form" = "/game-element/{minial_roll_game_element}/edit",
 *     "delete-form" = "/game-element/{minial_roll_game_element}/delete",
 *     "delete-multiple-form" = "/admin/content/game-element/delete-multiple",
 *   },
 *   bundle_entity_type = "minial_roll_game_element_type",
 *   field_ui_base_route = "entity.minial_roll_game_element_type.edit_form",
 * )
 */
class GameElement extends RevisionableContentEntityBase implements GameElementInterface {

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

    $fields['faction'] = BaseFieldDefinition::create('entity_reference')
      ->setRevisionable(FALSE)
      ->setLabel(t('Faction'))
      ->setSetting('target_type', 'minial_roll_faction')
      ->setSetting('handler', 'minial_roll_faction_selection')
      ->setRequired(TRUE)
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('form', [
        'type' => 'options_select',
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
      ->setDescription(t('The time that the game element was created.'))
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
      ->setDescription(t('The time that the game element was last edited.'));

    return $fields;
  }

  public static function loadByFaction(Faction $faction) {
    $entity_type_repository = \Drupal::service('entity_type.repository');
    $entity_type = $entity_type_repository->getEntityTypeFromClass(static::class);
    $entity_storage = \Drupal::entityTypeManager()->getStorage($entity_type);
    $results = $entity_storage->getQuery()
      ->accessCheck()
      ->condition('faction', $faction->id())
      ->execute();
    return $entity_storage->loadMultiple($results);
  }

}
