<?php

namespace Ainnomix\EtmAdminhtml\Model\ResourceModel\Entity\Type\Grid;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{
    protected $additionalTableAdded = null;

    protected function _construct()
    {
        $this->addFilterToMap('entity_type_id', 'main_table.entity_type_id');
    }

    public function getSelect()
    {
        if (!$this->additionalTableAdded) {
            $select = parent::getSelect();
            if ($select) {
                $this->additionalTableAdded = true;

                $this->join(
                    ['etm' => $this->getTable('etm_eav_entity_type')],
                    'main_table.entity_type_id = etm.entity_type_id',
                    ['entity_type_name']
                );
            }

            return $select;
        }

        return parent::getSelect();
    }
}
