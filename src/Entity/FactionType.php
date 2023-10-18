<?php

declare(strict_types = 1);

namespace Drupal\minial_roll\Entity;

use Drupal\Core\Cache\Cache;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\layout_builder\Section;
use Drupal\layout_builder\SectionComponent;

/**
 * Defines the Faction type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "minial_roll_faction_type",
 *   label = @Translation("Faction type"),
 *   label_collection = @Translation("Faction types"),
 *   label_singular = @Translation("faction type"),
 *   label_plural = @Translation("factions types"),
 *   label_count = @PluralTranslation(
 *     singular = "@count factions type",
 *     plural = "@count factions types",
 *   ),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\minial_roll\Form\FactionTypeForm",
 *       "edit" = "Drupal\minial_roll\Form\FactionTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "list_builder" = "Drupal\minial_roll\FactionTypeListBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer minial_roll_faction types",
 *   bundle_of = "minial_roll_faction",
 *   config_prefix = "minial_roll_faction_type",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/minial_roll_faction_types/add",
 *     "edit-form" = "/admin/structure/minial_roll_faction_types/manage/{minial_roll_faction_type}",
 *     "delete-form" = "/admin/structure/minial_roll_faction_types/manage/{minial_roll_faction_type}/delete",
 *     "collection" = "/admin/structure/minial_roll_faction_types",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *     "game",
 *   },
 * )
 */
final class FactionType extends GameElementType {

  /**
   * {@inheritDoc}
   */
  public function postSave(EntityStorageInterface $storage, $update = TRUE) {
    parent::postSave($storage, $update);
    if ($update) {
      return;
    }
    $this->generateDisplay();
    $cache = \Drupal::cache('discovery');
    // reload block plugin definitions so field blocks render properly in layout builder.
    $cache->invalidate('block_plugins');
  }

  private function generateDisplay() {
    $uuid_service = \Drupal::service('uuid');
    /** @var \Drupal\Core\Entity\EntityDisplayRepositoryInterface $displayRepo */
    $displayRepo = \Drupal::service('entity_display.repository');
    // Set up default display to use display builder
    $display = $displayRepo->getViewDisplay($this->getEntityType()->getBundleOf(), $this->id());
    $display->enableLayoutBuilder();
    $display->removeAllSections();
    $section = new Section('layout_minial_roll_faction');
    // Model list.
    $component = new SectionComponent($uuid_service->generate(), 'top', [
      'id' => 'field_block:minial_roll_faction:' . $this->id() . ':model_list',
      'label' => 'Models',
      'label_display' => '1',
      'provider' => 'layout_builder',
      'context_mapping' => [
        'entity' => 'layout_builder.entity',
        'view_mode' => 'view_mode',
      ],
      'formatter' => [
        'type' => 'minial_roll_attached_element_formatter',
        'label' => 'hidden',
        'settings' => [
          'display_mode' => 'card',
          'third_party_settings' => [],
        ],
      ],
      'weight' => 0,
    ]);
    $section->insertComponent(0, $component);
    // Character list.
    $component = new SectionComponent($uuid_service->generate(), 'first', [
      'id' => 'field_block:minial_roll_faction:' . $this->id() . ':character_list',
      'label' => 'Characters',
      'label_display' => '1',
      'provider' => 'layout_builder',
      'context_mapping' => [
        'entity' => 'layout_builder.entity',
        'view_mode' => 'view_mode',
      ],
      'formatter' => [
        'type' => 'minial_roll_attached_element_formatter',
        'label' => 'hidden',
        'settings' => [
          'display_mode' => 'card',
          'third_party_settings' => [],
        ],
      ],
      'weight' => 0,
    ]);
    $section->insertComponent(0, $component);
    // armour list.
    $component = new SectionComponent($uuid_service->generate(), 'second', [
      'id' => 'field_block:minial_roll_faction:' . $this->id() . ':armour_list',
      'label' => 'Armour',
      'label_display' => '1',
      'provider' => 'layout_builder',
      'context_mapping' => [
        'entity' => 'layout_builder.entity',
        'view_mode' => 'view_mode',
      ],
      'formatter' => [
        'type' => 'minial_roll_attached_element_formatter',
        'label' => 'hidden',
        'settings' => [
          'display_mode' => 'card',
          'third_party_settings' => [],
        ],
      ],
      'weight' => 0,
    ]);
    $section->insertComponent(0, $component);
    // weapon list.
    $component = new SectionComponent($uuid_service->generate(), 'third', [
      'id' => 'field_block:minial_roll_faction:' . $this->id() . ':weapon_list',
      'label' => 'Weapons',
      'label_display' => '1',
      'provider' => 'layout_builder',
      'context_mapping' => [
        'entity' => 'layout_builder.entity',
        'view_mode' => 'view_mode',
      ],
      'formatter' => [
        'type' => 'minial_roll_attached_element_formatter',
        'label' => 'hidden',
        'settings' => [
          'display_mode' => 'card',
          'third_party_settings' => [],
        ],
      ],
      'weight' => 0,
    ]);
    $section->insertComponent(0, $component);
    // ability list.
    $component = new SectionComponent($uuid_service->generate(), 'fourth', [
      'id' => 'field_block:minial_roll_faction:' . $this->id() . ':ability_list',
      'label' => 'Abilities',
      'label_display' => '1',
      'provider' => 'layout_builder',
      'context_mapping' => [
        'entity' => 'layout_builder.entity',
        'view_mode' => 'view_mode',
      ],
      'formatter' => [
        'type' => 'minial_roll_attached_element_formatter',
        'label' => 'hidden',
        'settings' => [
          'display_mode' => 'card',
          'third_party_settings' => [],
        ],
      ],
      'weight' => 0,
    ]);
    $section->insertComponent(0, $component);
    $display->insertSection(0, $section);
    $display->save();
  }

}
