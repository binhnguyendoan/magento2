<?php

namespace Mageplaza\HelloWorld\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Mageplaza\HelloWorld\Model\PostFactory;

class Save extends Action
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
        $data = $this->getRequest()->getPostValue();
        $post = $this->_postFactory->create();

        if (isset($data['form_id']) && $data['form_id']) {
            $post->load($data['form_id']);
        }

        $post->setData('data', $data['data']);
        $post->setData('created', $data['created']);
        $post->setData('request_status', $data['request_status']);
        $post->save();

        $this->messageManager->addSuccessMessage(__('The post has been saved.'));

        return $this->_redirect('helloworld/index/index');
    }
}
