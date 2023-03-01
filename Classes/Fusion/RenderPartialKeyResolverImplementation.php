<?php

namespace VIVOMEDIA\PartialRender\Fusion;

use Neos\ContentRepository\Domain\Model\NodeInterface;
use Neos\Flow\Annotations as Flow;
use Neos\Neos\View\FusionView;
use Neos\Fusion\FusionObjects\AbstractFusionObject;
use Neos\Neos\Exception as NeosException;

/**
 * Renders a Fusion view based on a path
 */
class RenderPartialKeyResolverImplementation extends AbstractFusionObject
{

    /**
     * @Flow\Inject
     * @var FusionView
     */
    protected $view;

    /**
     * @Flow\Inject
     * @var \Neos\Cache\Frontend\VariableFrontend
     */
    protected $pathsCache;

    protected function getRenderPartialKey()
    {
        return $this->fusionValue('renderPartialKey');
    }

    /**
     * @return mixed
     */
    public function evaluate()
    {
        $key = $this->getRenderPartialKey();

        return $this->pathsCache->get(
            $key,
        );
    }

}