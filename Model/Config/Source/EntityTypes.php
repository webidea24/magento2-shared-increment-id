<?php


namespace Webidea24\SharedIncrementId\Model\Config\Source;


use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\ObjectManagerInterface;
use Magento\Sales\Model\ResourceModel\EntityAbstract;

class EntityTypes implements OptionSourceInterface
{

    /**
     * @var array
     */
    protected $options;

    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;
    /**
     * @var ResourceConnection
     */
    private $resource;

    public function __construct(ResourceConnection $resource)
    {
        $this->resource = $resource;
    }

    public function toOptionArray(): array
    {
        if (is_array($this->options)) {
            return $this->options;
        }

        $connection = $this->resource->getConnection();
        $metas = $connection->fetchAll("SELECT * FROM {$this->resource->getTableName('eav_entity_type')}");

        $this->options = [];
        foreach ($metas as $meta) {
            if (is_subclass_of($meta['entity_model'], EntityAbstract::class)) {
                $this->options[] = [
                    'label' => __(ucfirst($meta['entity_type_code'])),
                    'value' => $meta['entity_type_code']
                ];
            }
        }
        return $this->options;
    }

}
