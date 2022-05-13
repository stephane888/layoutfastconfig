<?php

namespace Drupal\layoutfastconfig\Element;

use Drupal\layout_builder\Element\LayoutBuilder as LayoutBuilderDefault;
use Drupal\layout_builder\SectionStorageInterface;
use Drupal\Core\Url;

/**
 * Defines a render element for building the Layout Builder UI.
 *
 * @RenderElement("layout_builder_layoutfastconfig")
 *
 * @internal Plugin classes are internal.
 */
class LayoutBuilder extends LayoutBuilderDefault {
  
  protected function buildAdministrativeSection(SectionStorageInterface $section_storage, $delta) {
    $build = [];
    $build['layoutfastconfig_admin'] = [
      '#type' => 'dropbutton',
      '#links' => [
        [
          'title' => 'Liste des regions (edition rapide)'
        ]
      ]
    ];
    
    /**
     * #type = container
     *
     * @var array $build
     */
    $build += parent::buildAdministrativeSection($section_storage, $delta);
    
    
    /**
     *
     * @var \Drupal\Core\Layout\LayoutDefinition $layout
     */
    $layout = $build['layout-builder__section']['#layout'];
    if ('formatage_models' == $layout->getProvider()) {
      foreach ($layout->getRegions() as $regionKey => $label) {
        /**
         * Dans cette approche on essaie de mettre les elments d'editions dans
         * un
         * drop-down bouton, ce qui fonctionne lors duc hargement, mais
         * disparait
         * lors de la MAJ AJAX.
         */
        if (isset($build['layout-builder__section'][$regionKey])) {
          // remove block;
          $build['layoutfastconfig_admin']['#links'][] = [
            'title' => $build['layout-builder__section'][$regionKey]
          ];
        }
      }
    }
    return $build;
  }
  
}