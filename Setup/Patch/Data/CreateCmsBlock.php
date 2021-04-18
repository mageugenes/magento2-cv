<?php

namespace Mageugenes\Cv\Setup\Patch\Data;

use Exception;
use Magento\Cms\Model\BlockFactory;
use Magento\Cms\Model\ResourceModel\Block as BlockResource;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

/**
 * Class UpdateBlockData
 */
class CreateCmsBlock implements DataPatchInterface, PatchRevertableInterface
{
    const BLOCK_IDENTIFIER = 'mageugenes-cv-mageugenes-author-education';

    /**
     * @var BlockResource
     */
    protected BlockResource $blockResource;

    /**
     * @var BlockFactory
     */
    protected BlockFactory $blockFactory;

    /**
     * CreateCmsBlock constructor.
     * @param BlockResource $blockResource
     * @param BlockFactory $blockFactory
     */
    public function __construct(
        BlockResource $blockResource,
        BlockFactory $blockFactory
    ) {
        $this->blockResource = $blockResource;
        $this->blockFactory = $blockFactory;
    }

    /**
     * @return CreateCmsBlock|void
     * @throws Exception
     */
    public function apply()
    {
        $cmsBlockData = [
            'title' => 'Mageugenes Author | Education',
            'identifier' => self::BLOCK_IDENTIFIER,
            'content' => 'Oxford University, Harvard University',
            'stores' => [0],
            'is_active' => 1,
        ];

        $cmsBlock = $this->blockFactory->create();
        $this->blockResource->load($cmsBlock, $cmsBlockData['identifier'], 'identifier');

        /**
         * Create the block if it does not exists, otherwise update the content
         */
        if (!$cmsBlock->getId()) {
            $cmsBlock->setData($cmsBlockData);
            $this->blockResource->save($cmsBlock);
        } else {
            $cmsBlock->setContent($cmsBlockData['content']);
            $this->blockResource->save($cmsBlock);
        }
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
     * Delete the block once the module is uninstalled
     */
    public function revert()
    {
        $cmsBlock = $this->blockFactory->create();

        $this->blockResource->load($cmsBlock, self::BLOCK_IDENTIFIER, 'identifier');

        if ($cmsBlock->getId()) {
            $this->blockResource->delete($cmsBlock);
        }
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
