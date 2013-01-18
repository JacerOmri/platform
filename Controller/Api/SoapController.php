<?php
namespace Oro\Bundle\SearchBundle\Controller\Api;

use BeSimple\SoapBundle\ServiceDefinition\Annotation as Soap;
use Symfony\Component\DependencyInjection\ContainerAware;

class SoapController extends ContainerAware
{
    /**
     * @Soap\Method("search")
     * @Soap\Param("search", phpType = "string")
     * @Soap\Param("offset", phpType = "int")
     * @Soap\Param("max_results", phpType = "int")
     * @Soap\Result(phpType = "string[]")
     */
    public function testAction($search, $offset, $max_results)
    {
        return $this->container->get('besimple.soap.response')->setReturnValue(
            $this->container->get('oro_search.index')->simpleSearch(
                $search,
                $offset,
                $max_results
            )->toSearchResultData()
        );
    }
}
