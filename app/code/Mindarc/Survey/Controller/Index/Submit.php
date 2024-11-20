<?php

namespace Mindarc\Survey\Controller\Index;

use Magento\Framework\Exception\LocalizedException;

class Submit extends \Magento\Framework\App\Action\Action
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
        $postData = $this->getRequest()->getPostValue();
        try {
            $survey = $this->_surveyFactory->create();
            $survey->setData([
                'name' => $postData['name'],
                'email' => $postData['email'],
                'phone_number' => $postData['phone_number'],
                'subject' => $postData['subject'],
                'message' => $postData['message'],
            ]);
            $survey->save();

            $this->messageManager->addSuccessMessage(__('Your survey has been submitted.'));
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('An error occurred while processing your request.'));
        }
        return $this->_redirect('survey/index/index');
    }
}
