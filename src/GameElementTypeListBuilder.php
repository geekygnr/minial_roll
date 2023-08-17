<?php declare(strict_types = 1);

namespace Drupal\minial_roll;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of gameelement type entities.
 *
 * @see \Drupal\minial_roll\Entity\GameElementType
 */
final class GameElementTypeListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader(): array {
    $header['label'] = $this->t('Label');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity): array {
    $row['label'] = $entity->label();
    return $row + parent::buildRow($entity);
  }

  /**
   * {@inheritdoc}
   */
  public function render(): array {
    $build = parent::render();

    $build['table']['#empty'] = $this->t(
      'No gameelement types available. <a href=":link">Add gameelement type</a>.',
      [':link' => Url::fromRoute('entity.minial_roll_game_element_type.add_form')->toString()],
    );

    return $build;
  }

}
