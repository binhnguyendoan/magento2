<?php

namespace Mageplaza\HelloWorld\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Mageplaza\HelloWorld\Model\PostFactory;

class Edit extends Action
{
    protected $_pageFactory;
    protected $_postFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        PostFactory $postFactory
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_postFactory = $postFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $post = $this->_postFactory->create()->load($id);


        if (!$post->getId()) {
            $this->messageManager->addErrorMessage(__('This post no longer exists.'));
            return $this->_redirect('helloworld/index/index');
        }
        $resultPage = $this->_pageFactory->create();
        $resultPage->getLayout()->getBlock('helloworld_index_edit')->setPost($post);
        return $resultPage;
    }
}
