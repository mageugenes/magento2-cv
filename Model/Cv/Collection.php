<?php


namespace Mageugenes\Cv\Model\Cv;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Mageugenes\Cv\Model\Cv;
use Mageugenes\Cv\Model\ResourceModel\Cv as CvResource;

class Collection extends AbstractCollection
{

    protected function _construct()
    {
        $this->_init(Cv::class, CvResource::class);
    }
}
