<?php


namespace Mageugenes\Cv\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Cv extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('mageugenes_cv', 'id');
    }
}
