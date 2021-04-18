<?php
declare(strict_types=1);

namespace Mageugenes\Cv\ViewModel;

use Magento\Cms\Model\BlockFactory;
use Magento\Cms\Model\ResourceModel\Block as BlockResource;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Mageugenes\Cv\Service\CvRepository;

/**
 * Class Cv
 * @package Mageugenes\Cv\ViewModel
 */
class Cv implements ArgumentInterface
{
    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;

    /**
     * @var CvRepository
     */
    private CvRepository $cvRepository;

    /**
     * @var RequestInterface
     */
    private RequestInterface $request;

    /**
     * @var BlockResource
     */
    protected BlockResource $blockResource;

    /**
     * @var BlockFactory
     */
    protected BlockFactory $blockFactory;

    /**
     * Cv constructor.
     * @param SerializerInterface $serializer
     * @param CvRepository $cvRepository
     * @param RequestInterface $request
     * @param BlockResource $blockResource
     * @param BlockFactory $blockFactory
     */
    public function __construct(
        SerializerInterface $serializer,
        CvRepository $cvRepository,
        RequestInterface $request,
        BlockResource $blockResource,
        BlockFactory $blockFactory
    ) {
        $this->serializer = $serializer;
        $this->cvRepository = $cvRepository;
        $this->request = $request;
        $this->blockResource = $blockResource;
        $this->blockFactory = $blockFactory;
    }

    /**
     * @return string
     */
    public function getCvJson(): string
    {
        $cvId = $this->getCvId();

        if (!$cvId) {
            return $this->serializer->serialize([]);
        }

        $cv = $this->cvRepository->get($this->getCvId($cvId));

        if (!$cv->getId()) {
            return $this->serializer->serialize([]);
        }

        $cvData = $cv->getData();

        $authorNameInPath = mb_strtolower($cv->getFirstName() . '-' . $cv->getLastName());
        $blockIdentifier = 'mageugenes-cv-' . $authorNameInPath . '-education';
        $cmsBlock = $this->blockFactory->create();
        $this->blockResource->load($cmsBlock, $blockIdentifier, 'identifier');

        $cvData['education'] = '';

        if ($cmsBlock->getId()) {
            $cvData['education'] = $cmsBlock->getContent();
        }

        return $this->serializer->serialize($cvData);
    }

    /**
     * Returns Cv ID if provided or null
     *
     * @return int|null
     */
    private function getCvId(): ?int
    {
        $id = $this->request->getParam('id');

        return $id ? (int)$id : null;
    }
}
