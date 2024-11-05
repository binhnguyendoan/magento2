<?php

namespace Mageplaza\HelloWorld\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

    protected $_postFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Mageplaza\HelloWorld\Model\PostFactory $postFactory
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_postFactory = $postFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        // $post = $this->_postFactory->create();
        // $collection = $post->getCollection();
        // foreach ($collection as $item) {
        //     echo "<pre>";
        //     print_r($item->getData());
        //     echo "</pre>";
        // }
        // exit();
        $postCollection = $this->_postFactory->create()->getCollection();

        // Truyền dữ liệu đến view
        $resultPage = $this->_pageFactory->create();
        $resultPage->getLayout()->getBlock('helloworld_index_index')->setData('posts', $postCollection);

        return $resultPage;
    }
}
