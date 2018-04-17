<?php

/**
 * job actions.
 *
 * @package    jobee
 * @subpackage job
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class jobActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    // // Version 1

    // $this->jobeet_jobs = Doctrine_Core::getTable('JobeetJob')
    //   ->createQuery('a')
    //   ->execute();

    // // Version 2

    // $q = Doctrine_Query::create()
    //   ->from('JobeetJob j')
    //   ->where('j.expires_at > ?', date('Y-m-d H:i:s', time() - 86400 * 30));

    // $this->jobeet_jobs = $q->execute();

    // Version 3

    // $this->jobeet_jobs = Doctrine_Core::getTable('JobeetJob')->getActiveJobs();

    // Version 4
    // $this->categories = Doctrine_Core::getTable('JobeetCategory')->getWithJobs();
    // Version 4 improved (notice the call to getIntance())
    $this->categories = JobeetCategoryTable::getInstance()->getWithJobs();
  }

  public function executeShow(sfWebRequest $request)
  {
    // $this->jobeet_job = Doctrine_Core::getTable('JobeetJob')->find(array($request->getParameter('id')));
    // $this->job = Doctrine_Core::getTable('JobeetJob')->find(array($request->getParameter('id')));
    $this->job = $this->getRoute()->getObject();
    // $this->forward404Unless($this->job);
  }

  public function executeNew(sfWebRequest $request)
  {
    $job = new JobeetJob();
    $job->setType('full-time');
   
    $this->form = new JobeetJobForm($job);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new JobeetJobForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $job = $this->getRoute()->getObject();
    $this->forward404If($job->getIsActivated());

    $this->form = new JobeetJobForm($job);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->form = new JobeetJobForm($this->getRoute()->getObject());
    $this->processForm($request, $this->form);
    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
   
    $job = $this->getRoute()->getObject();
    $job->delete();
   
    $this->redirect('job/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $jobeet_job = $form->save();

      $this->redirect('job_show', $jobeet_job);
    }
  }

  public function executePublish(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
   
    $job = $this->getRoute()->getObject();
    $job->publish();
   
    $this->getUser()->setFlash('notice', sprintf('Your job is now online for %s days.', sfConfig::get('app_active_days')));
   
    $this->redirect('job_show_user', $job);
  }

  public function executeExtend(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
   
    $job = $this->getRoute()->getObject();
    $this->forward404Unless($job->extend());
   
    $this->getUser()->setFlash('notice', sprintf('Your job validity has been extended until %s.', $job->getDateTimeObject('expires_at')->format('m/d/Y')));
   
    $this->redirect('job_show_user', $job);
  }
}
