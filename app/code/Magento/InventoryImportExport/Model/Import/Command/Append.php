<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\InventoryImportExport\Model\Import\Command;

use Magento\InventoryApi\Api\SourceItemsSaveInterface;
use Magento\InventoryImportExport\Helper\SourceItemConvert;

/**
 * @inheritdoc
 */
class Append implements CommandInterface
{
    /**
     * @var SourceItemConvert
     */
    private $sourceItemConvert;

    /**
     * @var SourceItemsSaveInterface
     */
    private $sourceItemsSave;

    /**
     * @param SourceItemBuilder
     */
    public function __construct(
        SourceItemConvert $sourceItemConvert,
        SourceItemsSaveInterface $sourceItemsSave
    ) {
        $this->sourceItemConvert = $sourceItemConvert;
        $this->sourceItemsSave = $sourceItemsSave;
    }

    /**
     * @inheritdoc
     */
    public function execute(array $bunch)
    {
        $sourceItems = $this->sourceItemConvert->convert($bunch);
        $this->sourceItemsSave->execute($sourceItems);
    }
}