<?php

declare(strict_types=1);

namespace Mageugenes\Cv\Api;

use Mageugenes\Cv\Api\Data\CvInterface;

/**
 * @api
 */
interface CvManagementInterface
{
    /**
     * @param CvInterface $cv
     * @return int
     */
    public function save(CvInterface $cv): int;

    /**
     * @param CvInterface $cv
     * @return bool
     */
    public function delete(CvInterface $cv): bool;
}
