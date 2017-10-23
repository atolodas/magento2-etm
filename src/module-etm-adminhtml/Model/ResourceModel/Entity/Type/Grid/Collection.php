<?php

namespace Ainnomix\EtmAdminhtml\Model\ResourceModel\Entity\Type\Grid;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{

    protected function _beforeLoad()
    {
        $this->join(
            ['etm' => $this->getTable('etm_eav_entity_type')],
            'main_table.entity_type_id = etm.entity_type_id',
            ['entity_type_name']
        );

        return parent::_beforeLoad();
    }
}
