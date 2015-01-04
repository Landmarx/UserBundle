<?php
namespace Landmarx\Bundle\UserBundle\DependencyInjection;

use \Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration implements \Symfony\Component\Config\Definition\ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('landmarx_user');

        return $treeBuilder;
    }
}
