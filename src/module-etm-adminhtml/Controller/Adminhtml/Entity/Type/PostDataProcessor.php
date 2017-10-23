<?php

namespace Ainnomix\EtmAdminhtml\Controller\Adminhtml\Entity\Type;

class PostDataProcessor
{

    public function filter(array $data)
    {
        return (new \Zend_Filter_Input([], [], $data))->getUnescaped();
    }
}
