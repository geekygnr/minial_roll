<?php declare(strict_types = 1);

namespace Drupal\minial_roll;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of squad type entities.
 *
 * @see \Drupal\minial_roll\Entity\SquadType
 */
final class SquadTypeListBuilder extends ConfigEntityListBuilder {

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
      'No squad types available. <a href=":link">Add squad type</a>.',
      [':link' => Url::fromRoute('entity.minial_roll_squad_type.add_form')->toString()],
    );

    return $build;
  }

}
