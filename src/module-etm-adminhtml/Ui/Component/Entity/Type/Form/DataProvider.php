<?php

namespace Ainnomix\EtmAdminhtml\Ui\Component\Entity\Type\Form;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Ainnomix\EtmCore\Model\ResourceModel\Entity\Type\CollectionFactory;

class DataProvider extends AbstractDataProvider
{

    public function __construct(
        CollectionFactory $collectionFactory,
        $name,
        $primaryFieldName,
        $requestFieldName,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

        $this->collection = $collectionFactory->create();
    }

    public function getData()
    {
        $result = [];
        $items = $this->collection->getItems();

        foreach ($items as $item) {
            $result[$item->getId()] = $item->getData();
        }

        return $result;
    }
}
