<?php

namespace Drupal\minial_roll;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

trait CardDisplayViewTrait {
  protected function setCardTrait(ConfigEntityBundleBase $entityType) {
    /** @var \Drupal\Core\Entity\EntityDisplayRepositoryInterface $displayRepo */
    $displayRepo = \Drupal::service('entity_display.repository');
    $display = $displayRepo->getViewDisplay($entityType->getEntityType()->getBundleOf(), $entityType->id(), 'card');
    $display->enable();
    $components = $display->getComponents();
    foreach ($components as $id => $component) {
      if ($id == 'label') {
        $display->setComponent($id, [
          'label' => 'hidden',
          'type' => 'string',
          'settings' => [
            'link_to_entity' => TRUE,
          ],
        ]);
        continue;
      }
      $display->removeComponent($id);
    }
    $display->save();
  }

}
