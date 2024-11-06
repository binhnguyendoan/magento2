<?php

namespace Mindarc\Survey\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'form_id';
    protected $_eventPrefix = 'mindarc_survey_collection';
    protected $_eventObject = 'post_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Mindarc\Survey\Model\Post', 'Mindarc\Survey\Model\ResourceModel\Post');
    }
}
