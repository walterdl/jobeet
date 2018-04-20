<?php

/**
 * custom404 actions for Frontend app.
 *
 * @package    jobee
 * @subpackage custom404
 * @author     Walter Devia <walter.devia@outlook.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class custom404Actions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->currentUri = $request->getRequestContext()['request_uri'];
    $this->url = $this->generateUrl('homepage', null, true);
    $this->setLayout(false);
  }
}
