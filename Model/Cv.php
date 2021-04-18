<?php

declare(strict_types=1);

namespace Mageugenes\Cv\Model;

use Magento\Framework\Model\AbstractModel;
use Mageugenes\Cv\Api\Data\CvInterface;
use Mageugenes\Cv\Model\ResourceModel\Cv as CvResource;

class Cv extends AbstractModel implements CvInterface
{
    const CV_ID = 'id';
    const FIRST_NAME = 'first_name';
    const LAST_NAME = 'last_name';
    const YEAR_OF_BIRTH = 'year_of_birth';
    const EXPERIENCE = 'experience';

    protected function _construct()
    {
        $this->_init(CvResource::class);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return (int) $this->getData(self::CV_ID);
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->getData(self::FIRST_NAME);
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->getData(self::LAST_NAME);
    }

    /**
     * @return int
     */
    public function getYearOfBirth(): int
    {
        return (int) $this->getData(self::YEAR_OF_BIRTH);
    }

    /**
     * @return string
     */
    public function getExperience(): string
    {
        return $this->getData(self::EXPERIENCE);
    }
}
