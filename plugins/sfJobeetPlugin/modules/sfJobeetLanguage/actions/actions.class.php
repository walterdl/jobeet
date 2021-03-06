<?php

/**
 * language actions.
 *
 * @package    jobee
 * @subpackage language
 * @author     Walter Devia <walter.devia@outlook.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
// class languageActions extends sfActions
class sfJobeetLanguageActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeChangeLanguage(sfWebRequest $request)
  {
    $form = new sfFormLanguage(
      $this->getUser(),
      array('languages' => array('en', 'fr'))
    );

    $form->disableLocalCSRFProtection();
 
    $form->process($request);
 
    return $this->redirect('localized_homepage');
  }
}
