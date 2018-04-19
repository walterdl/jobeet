<?php

  // class languageComponents extends sfComponents
  class sfJobeetLanguageComponents extends sfComponents
  {
    public function executeLanguage(sfWebRequest $request)
    {
      $this->form = new sfFormLanguage(
        $this->getUser(),
        array('languages' => array('en', 'fr'))
      );

      $this->form->disableLocalCSRFProtection();
    }
  }