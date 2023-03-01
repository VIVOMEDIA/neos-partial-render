<?php

namespace VIVOMEDIA\PartialRender\Fusion;

use Neos\ContentRepository\Domain\Projection\Content\NodeInterface;
use Neos\Flow\Annotations as Flow;
use Neos\Fusion\FusionObjects\AbstractFusionObject;

/**
 * Returns the path to the parent Fusion object
 */
class RenderPartialKeyImplementation extends AbstractFusionObject
{

    /**
     * @Flow\Inject
     * @var \Neos\Cache\Frontend\VariableFrontend
     */
    protected $pathsCache;

    /**
     * @return NodeInterface
     */
    protected function getNode()
    {
        return $this->fusionValue('node');
    }

    public function evaluate()
    {
        $nodeIdentifier = (string) $this->getNode()->getNodeAggregateIdentifier();

        $path = dirname($this->path, 1);  // Pop last element with "someKey<VIVOMEDIA.PartialRender:RenderPartialKey>"

        $value = [
            'nodeIdentifier' => $nodeIdentifier,
            'renderPath' => $path,
        ];

        $key = sha1(implode(';', $value));

        $this->pathsCache->set(
            $key,
            $value
        );

        return $key;
    }

}