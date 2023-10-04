<?php

declare(strict_types = 1);

namespace Drupal\minial_roll\Breadcrumb;

use Drupal\Core\Breadcrumb\Breadcrumb;
use Drupal\Core\Breadcrumb\BreadcrumbBuilderInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\minial_roll\Entity\Faction;
use Drupal\minial_roll\Entity\Game;

/**
 * Breadcrumb builder for minial roll entities.
 */
class GameBreadcrumbBuilder implements BreadcrumbBuilderInterface {

  /**
   * Entity Type Manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  public EntityTypeManagerInterface $entityTypeManager;

  /**
   * Constructor.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   Entity Type Manager.
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * {@inheritdoc}
   */
  public function applies(RouteMatchInterface $route_match) {
    $route_name = $route_match->getRouteName();
    $starts_with = str_starts_with($route_name, 'entity.minial_roll_');
    $ends_with = str_ends_with($route_name, '.canonical');
    return $starts_with && $ends_with;
  }

  /**
   * {@inheritdoc}
   */
  public function build(RouteMatchInterface $route_match) {
    $params = $route_match->getParameters();
    $key = array_key_first($params->all());
    $entity = $params->get($key);

    $breadcrumb = new Breadcrumb();
    $breadcrumb->addCacheContexts(['route']);

    if ($entity instanceof Game) {
      return $breadcrumb;
    }

    $entity_type = $entity->getEntityType();
    $entity_type = $this->entityTypeManager->getStorage($entity_type->getBundleEntityType())->load($entity->bundle());
    $game = $entity_type->game();
    $breadcrumb->addLink($game->toLink());

    if ($entity instanceof Faction) {
      return $breadcrumb;
    }
    $breadcrumb->addLink($entity->faction->entity->toLink());

    return $breadcrumb;
  }

}
