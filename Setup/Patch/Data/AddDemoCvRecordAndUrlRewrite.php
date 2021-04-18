<?php

namespace Mageugenes\Cv\Setup\Patch\Data;

use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Mageugenes\Cv\Model\CvFactory;
use Mageugenes\Cv\Model\ResourceModel\Cv as CvResource;
use Magento\UrlRewrite\Model\UrlRewriteFactory;
use Magento\UrlRewrite\Model\ResourceModel\UrlRewrite as UrlRewriteResource;

/**
 * Class AddDemoCvRecordAndUrlRewrite
 * @package Mageugenes\Cv\Setup\Patch\Data
 */
class AddDemoCvRecordAndUrlRewrite implements DataPatchInterface, PatchRevertableInterface
{
    /**
     * @var CvResource
     */
    private CvResource $cvResource;

    /**
     * @var UrlRewriteResource
     */
    private UrlRewriteResource $urlRewriteResource;

    /**
     * @var CvFactory
     */
    private CvFactory $cvFactory;

    /**
     * @var UrlRewriteFactory
     */
    private UrlRewriteFactory $urlRewriteFactory;

    /**
     * AddDemoCvRecordAndUrlRewrite constructor.
     * @param CvResource $cvResource
     * @param CvFactory $cvFactory
     * @param UrlRewriteFactory $urlRewriteFactory
     * @param UrlRewriteResource $urlRewriteResource
     */
    public function __construct(
        CvResource $cvResource,
        CvFactory $cvFactory,
        UrlRewriteFactory $urlRewriteFactory,
        UrlRewriteResource $urlRewriteResource
    ) {
        $this->cvResource = $cvResource;
        $this->cvFactory = $cvFactory;
        $this->urlRewriteFactory = $urlRewriteFactory;
        $this->urlRewriteResource = $urlRewriteResource;
    }

    /**
     * @return AddDemoCvRecordAndUrlRewrite|void
     * @throws AlreadyExistsException
     */
    public function apply()
    {
        //create deme cv record
        $cvData = [
            'id' => 1,
            'first_name' => 'Mageugenes',
            'last_name' => 'Author',
            'year_of_birth' => 2021,
            'experience' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        ];

        $cv = $this->cvFactory->create();
        $cv->setData($cvData);

        $this->cvResource->save($cv);



        //create url rewrite for demo cv
        $urlRewriteModel = $this->urlRewriteFactory->create();
        $urlRewriteModel->setStoreId(1);
        $urlRewriteModel->setIsSystem(0);
        $urlRewriteModel->setEntityType('custom');
        $urlRewriteModel->setIdPath(rand(1, 100000));
        $urlRewriteModel->setTargetPath('mageugenes-cv/index/index/id/1');
        $urlRewriteModel->setRequestPath("mageugenes-author");

        $this->urlRewriteResource->save($urlRewriteModel);
    }

    /**
     * @return array
     */
    public static function getDependencies(): array
    {
        /**
         * No dependencies for this
         */
        return [];
    }

    /**
     * @return void
     */
    public function revert()
    {
        /**
         * Rollback all changes, done by this patch
         */
    }

    /**
     * @return array
     */
    public function getAliases()
    {
        /**
         * Aliases are useful if we change the name of the patch until then we do not need any
         */
        return [];
    }
}
