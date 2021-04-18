<?php

namespace Mageugenes\Cv\Service;

use Mageugenes\Cv\Api\CvRepositoryInterface;
use Mageugenes\Cv\Api\Data\CvInterface;
use Mageugenes\Cv\Model\CvFactory;
use Mageugenes\Cv\Model\ResourceModel\Cv;

class CvRepository implements CvRepositoryInterface
{
    /**
     * @var Cv
     */
    private Cv $resource;

    /**
     * @var CvFactory
     */
    private CvFactory $cvFactory;

    /**
     * CvRepository constructor.
     * @param Cv $resource
     * @param CvFactory $cvFactory
     */
    public function __construct(
        Cv $resource,
        CvFactory $cvFactory
    ) {
        $this->resource = $resource;
        $this->cvFactory = $cvFactory;
    }

    public function get(int $id): CvInterface
    {
        $cv = $this->cvFactory->create();
        $this->resource->load($cv, $id);

        return $cv;
    }
}
