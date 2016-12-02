<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity;

use Ainnomix\EntityTypeManager\Helper\Data;
use Magento\Backend\App\Action;
use Magento\Framework\Registry;
use Ainnomix\EntityTypeManager\Api\EntityTypeManagerInterface;

/**
 * Entity types base action class
 */
abstract class Type extends Base
{

    const ADMIN_RESOURCE = 'Ainnomix_EntityTypeManager::manage_entity_types';

}
