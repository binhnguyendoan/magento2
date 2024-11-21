<?php

namespace Mindarc\Survey\Controller\Index;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Controller\Result\JsonFactory;

class Submit extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_surveyFactory;
    protected $resultJsonFactory;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Mindarc\Survey\Model\PostFactory $surveyFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_surveyFactory = $surveyFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            throw new \Magento\Framework\Exception\NotFoundException(__('Page not found'));
        }
        $name = $request->getParam('name');
        $email = $request->getParam('email');
        $phoneNumber = $request->getParam('phone_number');
        $subject = $request->getParam('subject');
        $message = $request->getParam('message');
        $result = $this->resultJsonFactory->create();
        try {
            $survey = $this->_surveyFactory->create();
            $survey->setData([
                'name' => $name,
                'email' => $email,
                'phone_number' => $phoneNumber,
                'subject' => $subject,
                'message' => $message,
            ]);
            $survey->save();
            return $result->setData([
                'success' => true,
                'message' => 'Your survey has been submitted successfully!',
                'data' => compact('name', 'email', 'phoneNumber', 'subject', 'message')
            ]);
        } catch (\Exception $e) {
            return $result->setData([
                'success' => false,
                'message' => 'An error occurred while saving your data.'
            ]);
        }
    }
}