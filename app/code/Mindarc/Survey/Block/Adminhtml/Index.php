<?php

namespace Mindarc\Survey\Block\Adminhtml;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\View\Element\Template;

class Index extends Template
{
    protected $_postFactory;

    public function __construct(
        Context $context,
        \Mindarc\Survey\Model\PostFactory $postFactory,
        array $data = []
    ) {
        $this->_postFactory = $postFactory;
        parent::__construct($context, $data);
    }

    public function getPosts()
    {
        return $this->_postFactory->create()->getCollection();
    }
}
