<?php

namespace Mageplaza\HelloWorld\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Mageplaza\HelloWorld\Model\PostFactory;

class Delete extends Action
{
    protected $_postFactory;

    public function __construct(
        Context $context,
        PostFactory $postFactory
    ) {
        $this->_postFactory = $postFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $post = $this->_postFactory->create()->load($id);

        if ($post->getId()) {
            $post->delete();
            $this->messageManager->addSuccessMessage(__('The item has been deleted.'));
        } else {
            $this->messageManager->addErrorMessage(__('The item does not exist.'));
        }

        return $this->_redirect('helloworld/index/index');
    }
}
