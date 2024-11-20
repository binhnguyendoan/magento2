<?php

namespace Mindarc\Survey\Controller\Index;

use Magento\Framework\Exception\LocalizedException;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_surveyFactory;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Mindarc\Survey\Model\PostFactory $surveyFactory
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_surveyFactory = $surveyFactory;
        return parent::__construct($context);
    }

    public function execute()
    {

        return $this->_pageFactory->create();
    }
}
