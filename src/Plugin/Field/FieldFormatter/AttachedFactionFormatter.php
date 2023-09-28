<?php

declare(strict_types = 1);

namespace Drupal\minial_roll\Plugin\Field\FieldFormatter;

use Drupal\Core\Entity\Entity\EntityViewMode;
use Drupal\Core\Entity\EntityDisplayRepositoryInterface;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\minial_roll\Entity\FactionType;
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
  protected $entityDisplayRepository;
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, $label, $view_mode, array $third_party_settings, EntityDisplayRepositoryInterface $entityDisplayRepository) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $label, $view_mode, $third_party_settings);
    $this->entityDisplayRepository = $entityDisplayRepository;
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition)
  {
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['label'],
      $configuration['view_mode'],
      $configuration['third_party_settings'],
      $container->get('entity_display.repository')
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
    $game = $items->getParent()->getEntity();
    $view['#prefix'] = '<div>';
    $view['#suffix'] = '</div>';
    $view['field'] = parent::view($items, $langcode);
    $view['link'] = $this->getLink($game)->toRenderable();
    return $view;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode): array {
    $element = [];
    $view_builder = \Drupal::entityTypeManager()->getViewBuilder('minial_roll_faction');
    foreach ($items as $delta => $item) {
      /** @var \Drupal\minial_roll\Entity\Faction $faction */
      $faction = $item->entity;
      $element[$delta] = $view_builder->view($faction, $this->getSetting('display_mode'));
    }
    return $element;
  }

  private function getLink(Game $game): Link {
    $bundle = FactionType::getBundleByGame($game);
    $route = 'entity.minial_roll_faction.add_form';
    $url = Url::fromRoute($route, ['minial_roll_faction_type' => $bundle]);
    $url->setOption('attributes', ['class' => 'button']);
    $url->setOption('query', [
      'destination' => $game->toUrl()->toString(),
    ]);
    return Link::fromTextAndUrl('Create Faction', $url);
  }

}
