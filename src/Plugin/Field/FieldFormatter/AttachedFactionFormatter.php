<?php

declare(strict_types = 1);

namespace Drupal\minial_roll\Plugin\Field\FieldFormatter;

use Drupal\Core\Entity\EntityBase;
use Drupal\Core\Entity\EntityDisplayRepositoryInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Entity\EntityTypeRepositoryInterface;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\minial_roll\Entity\Game;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Plugin implementation of the 'Attached Faction' formatter.
 *
 * @FieldFormatter(
 *   id = "minial_roll_attached_faction_formatter",
 *   label = @Translation("Attached Faction"),
 *   field_types = {"minial_roll_attached_faction"},
 * )
 */
final class AttachedFactionFormatter extends FormatterBase {

  /**
   * The entity display repository.
   *
   * @var \Drupal\Core\Entity\EntityDisplayRepositoryInterface
   */
  protected EntityDisplayRepositoryInterface $entityDisplayRepository;

  protected $entityClass;

  protected $entityType;

  protected $configDefintion;

  protected $entityDefintion;

  protected $entityTypeManager;

  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, $label, $view_mode, array $third_party_settings, EntityDisplayRepositoryInterface $entityDisplayRepository, EntityTypeRepositoryInterface $entityTypeRepository, EntityTypeManagerInterface $entityTypeManager) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $label, $view_mode, $third_party_settings);
    $this->entityDisplayRepository = $entityDisplayRepository;
    $this->entityTypeManager = $entityTypeManager;
    $this->entityClass = $this->fieldDefinition->getSetting('entity_type');
    $this->entityType = $entityTypeRepository->getEntityTypeFromClass($this->entityClass);
    $this->configDefintion = $entityTypeManager->getStorage($this->entityType)->getEntityType();
    $this->entityDefintion = $entityTypeManager->getStorage($this->configDefintion->getBundleOf())->getEntityType();
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['label'],
      $configuration['view_mode'],
      $configuration['third_party_settings'],
      $container->get('entity_display.repository'),
      $container->get('entity_type.repository'),
      $container->get('entity_type.manager')
    );
  }

  public static function defaultSettings() {
    return [
      'display_mode' => NULL,
    ];
  }

  public function settingsSummary() {
    $summary = [];
    $view_modes = $this->entityDisplayRepository->getViewModeOptions('minial_roll_faction');
    $view_mode = $this->getSetting('display_mode');
    $summary[] = $this->t('Display Mode: @display_mode', ['@display_mode' => $view_modes[$view_mode] ?? $view_mode]);
    return $summary;
  }

  public function settingsForm(array $form, FormStateInterface $form_state) {
    $form = parent::settingsForm($form, $form_state);
    $options = $this->entityDisplayRepository->getViewModeOptions('minial_roll_faction');
    $form['display_mode'] = [
      '#title' => $this->t('Display Mode'),
      '#description' => $this->t('The display mode used to render each faction.'),
      '#type' => 'select',
      '#options' => $options,
    ];
    return $form;
  }

  /**
   * {@inheritDoc}
   */
  public function view(FieldItemListInterface $items, $langcode = NULL) {
    $entity = $items->getParent()->getEntity();
    $game = $this->getGame($items);
    $view['#prefix'] = '<div>';
    $view['#suffix'] = '</div>';
    $view['field'] = parent::view($items, $langcode);
    $view['link'] = $this->getLink($game, $entity)->toRenderable();
    return $view;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode): array {
    $element = [];
    $view_builder = \Drupal::entityTypeManager()->getViewBuilder($this->configDefintion->getBundleOf());
    foreach ($items as $delta => $item) {
      $entity = $item->entity;
      $element[$delta] = $view_builder->view($entity, $this->getSetting('display_mode'));
    }
    return $element;
  }

  private function getGame(FieldItemListInterface $items): Game {
    $entity = $items->getParent()->getEntity();
    if ($entity instanceof Game) {
      return $entity;
    }
    $entity_type = $this->entityTypeManager->getStorage($this->entityType)->load($entity->bundle());
    return $entity_type->game();
  }

  private function getLink(Game $game, EntityBase $entity): Link {
    $bundle = $this->configDefintion->getClass()::getBundleByGame($game);
    $route = 'entity.' . $this->configDefintion->getBundleOf() . '.add_form';
    $url = Url::fromRoute($route, [$this->configDefintion->id() => $bundle]);
    $url->setOption('attributes', ['class' => 'button']);
    $url->setOption('query', [
      'destination' => $entity->toUrl()->toString(),
      $entity->getEntityTypeId() => $entity->id(),
    ]);
    return Link::fromTextAndUrl('Create ' . $this->entityDefintion->getLabel(), $url);
  }

}
