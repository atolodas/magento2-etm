<?php

namespace Ainnomix\EntityTypeManager\Model\ResourceModel\Entity\Type\Grid;

use Magento\Customer\Ui\Component\DataProvider\Document;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Psr\Log\LoggerInterface as Logger;

class Collection extends SearchResult
{

    protected $document = Document::class;

    public function __construct(
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager,
        $mainTable = 'eav_entity_type',
        $resourceModel = 'Ainnomix\EntityTypeManager\Model\ResourceModel\Entity\Type'
    ) {
        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $eventManager,
            $mainTable,
            $resourceModel
        );
    }

    protected function _beforeLoad()
    {
        $this->join(
            ['etm' => $this->getResource()->getAdditionalEntityTypeTable()],
            sprintf('main_table.%s = etm.%s', $this->getIdFieldName(), $this->getIdFieldName()),
            $this->getResource()->getAdditionalEntityTypeFields()
        );

        return parent::_beforeLoad();
    }
}
