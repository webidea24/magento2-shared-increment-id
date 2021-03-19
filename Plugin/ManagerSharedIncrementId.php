<?php


namespace Webidea24\SharedIncrementId\Plugin;


use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\SalesSequence\Model\Manager;

class ManagerSharedIncrementId
{

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * ManagerSharedIncrementId constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function beforeGetSequence(Manager $subject, $entityType, $storeId)
    {
        $config = $this->scopeConfig->getValue('wi24_shared_increment_id/general') ?: [];
        if (isset($config['enabled']) && ((bool)$config['enabled'])) {
            $handledEntities = $config['enabled_for_entity_types'] ?? '';
            $handledEntitiesArray = explode(',', $handledEntities);

            if (in_array($entityType, $handledEntitiesArray, true)) {
                return [$entityType, 0];
            }
        }
        return [$entityType, $storeId];
    }
}
