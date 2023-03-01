<?php

namespace VIVOMEDIA\PartialRender\Fusion;

use Neos\ContentRepository\Domain\Model\NodeInterface;
use Neos\Flow\Annotations as Flow;
use Neos\Fusion\FusionObjects\AbstractFusionObject;
use Neos\Neos\View\FusionView;

/**
 * Renders a Fusion view based on a path
 */
class PartialRendererImplementation extends AbstractFusionObject
{
    /**
     * @Flow\Inject
     * @var FusionView
     */
    protected $view;

    public function evaluate()
    {
        $this->view->setControllerContext($this->runtime->getControllerContext());
        $node = $this->fusionValue('node');
        $path = $this->fusionValue('renderPath');

        if (!$path) {
            throw new \Exception(sprintf('Render path not given.'));
        }

        if (!$node instanceof NodeInterface) {
            throw new \Exception(sprintf('Node not found.'));
        }
        $this->view->setFusionPath($path);
        $this->view->assign('value', $node);

        return $this->view->render();
    }

}