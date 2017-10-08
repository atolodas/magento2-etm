<?php

namespace Ainnomix\EtmAdminhtml\Model\ResourceModel\Entity\Type\Grid;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{

    protected function _beforeLoad()
    {
        $this->addFieldToFilter('is_custom', 1);

        return parent::_beforeLoad();
    }
}
