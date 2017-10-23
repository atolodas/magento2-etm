<?php

namespace Ainnomix\EtmAdminhtml\Controller\Adminhtml\Entity\Type;

class PostDataProcessor
{

    public function filter(array $data)
    {
        if (empty($data['entity_type_id'])) {
            unset($data['entity_type_id']);
        }

        return (new \Zend_Filter_Input([], [], $data))->getUnescaped();
    }
}
