<?php

namespace Mindarc\Survey\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

    protected $_postFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Mindarc\Survey\Model\PostFactory $postFactory
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_postFactory = $postFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->_pageFactory->create();
        $postCollection = $this->_postFactory->create()->getCollection();
        $resultPage->getLayout()->getBlock('survey_index_index')->setData('posts', $postCollection);
        return $resultPage;
    }
}
