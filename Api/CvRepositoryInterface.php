<?php

namespace Mageugenes\Cv\Api;

use Mageugenes\Cv\Api\Data\CvInterface;

/**
 * @api
 */
interface CvRepositoryInterface
{
    /**
     * @param int $id
     * @return CvInterface
     */
    public function get(int $id): CvInterface;
}
