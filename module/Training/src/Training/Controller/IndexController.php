<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Training\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Training\Model\Training;
use Training\Model\TrainingTable;
use Training\Form\TrainingForm;

class IndexController extends AbstractActionController
{
	protected $trainingTable;
      public function getTrainingTable()
    {
        if (!$this->trainingTable) {
            $sm = $this->getServiceLocator();
            $this->trainingTable = $sm->get('Training\Model\TrainingTable');
        }
        return $this->trainingTable;
    }
    public function indexAction()
    {
 		
       return new ViewModel(array(
            'trainings' => $this->getTrainingTable()->fetchAll(),
        ));
    }

    public function listAction()
    {
        return $this->redirect()->toRoute('training');exit();
        $paginator = $this->getTrainingTable()->fetchAll(true);
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        $paginator->setItemCountPerPage(10);
         return new ViewModel(array(
             'paginators' => $paginator
         ));
    }
    public function addAction()
    {
        $form = new TrainingForm();
        $form->get('submit')->setAttribute('value', 'Add');

        $request = $this->getRequest();
        if($request->isPost()) {
            $training = new Training();
            $form->setInputFilter($training->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $training->exchangeArray($form->getData());
                $this->getTrainingTable()->saveTraining($training);

                return $this->redirect()->toRoute('training');
            }
        }

        return array('form' => $form);
    }
    public function editAction()
    {
    	$id = (int)$this->params('id');
        if (!$id) {
            return $this->redirect()->toRoute('training/add');
        }
        $training = $this->getTrainingTable()->getTraining($id);

        $form = new TrainingForm();
        $form->bind($training);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();

        if ($request->isPost()) {

            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getTrainingTable()->saveTraining($training);

                // Redirect to list of albums
                return $this->redirect()->toRoute('training');
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
        );

    }
    public function deleteAction()
    {
        $id = (int)$this->params('id');
        if (!$id) {
            return $this->redirect()->toRoute('training');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost()->get('del', 'No');
            if ($del == 'Yes') {
                $id = (int)$request->getPost()->get('id');
                $this->getTrainingTable()->deleteTraining($id);
            }

            return $this->redirect()->toRoute('training');
        }

        return array(
            'id' => $id,
            'training' => $this->getTrainingTable()->getTraining($id)
        );
    }
}
