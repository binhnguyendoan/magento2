<?php

namespace Mindarc\Survey\Model;

class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'mindarc_survey';

    protected $_cacheTag = 'mindarc_survey';

    protected $_eventPrefix = 'mindarc_survey';

    protected function _construct()
    {
        $this->_init('Mindarc\Survey\Model\ResourceModel\Post');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
