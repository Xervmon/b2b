<?php

/**
-------------------------------------------------------------------------
briefcasefactory - Briefcase Factory 4.0.8
-------------------------------------------------------------------------
 * @author thePHPfactory
 * @copyright Copyright (C) 2011 SKEPSIS Consult SRL. All Rights Reserved.
 * @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * Websites: http://www.thePHPfactory.com
 * Technical Support: Forum - http://www.thePHPfactory.com/forum/
-------------------------------------------------------------------------
*/

defined('_JEXEC') or die;

class FactoryNotification
{
  protected $mailer = null;
  protected $notifications = array();

  public function __construct($mailer)
  {
    $this->mailer = $mailer;
  }

  public static function getInstance($mailer)
  {
    static $instance = null;

    if (is_null($instance)) {
      $instance = new self($mailer);
    }

    return $instance;
  }

  public function send($type, $receiverId, $tokens = array())
  {
    // Initialise variables.
    $receiver         = JFactory::getUser($receiverId);
    $receiverLanguage = $receiver->getParam('language', JComponentHelper::getParams('com_languages')->get('site'));
    $receiverEmail    = $receiver->email;
    $notification     = $this->getNotification($type, $receiverLanguage);

    // Check if notification was found.
    if (!$notification) {
      return true;
    }

    // Prepare subject and body.
    $subject = $this->parseTokens($notification->subject, $tokens);
    $body    = $this->parseTokens($notification->body,    $tokens);

    // Send mail.
    if (!$this->sendMail($receiverEmail, $subject, $body)) {
      return false;
    }

    return true;
  }

  protected function getNotification($type, $language)
  {
    // Get notification.
    if (!isset($this->notifications[$type])) {
      $this->notifications[$type] = $this->getNotifications($type);
    }

    if (isset($this->notifications[$type][$language])) {
      $notification = $this->notifications[$type][$language];
    }
    elseif (isset($this->notifications[$type]['*'])) {
      $notification = $this->notifications[$type]['*'];
    }
    else {
      return false;
    }

    return $notification;
  }

  protected function getNotifications($type)
  {
    $dbo = JFactory::getDbo();
    $query = $dbo->getQuery(true)
      ->select('n.*')
      ->from('#__briefcasefactory_notifications n')
      ->where('n.published = ' . $dbo->quote(1))
      ->where('n.type = ' . $dbo->quote($type));
    $notifications = $dbo->setQuery($query)
      ->loadObjectList('lang_code');

    return $notifications;
  }

  protected function parseTokens($string, $tokens)
  {
    // Initialise variables.
    $search  = array();
    $replace = array();

    // Parse tokens.
    foreach ($tokens as $token => $value) {
      $search[]  = '%%' . $token . '%%';
      $search[]  = '{{ ' . $token . ' }}';

      $replace[] = $value;
      $replace[] = $value;
    }

    // Replace tokens.
    $string = str_replace($search, $replace, $string);

    // Replace image sources.
    $string = str_replace('src="', 'src="' . JURI::root(), $string);

    return $string;
  }

  protected function sendMail($email, $subject, $body)
  {
    $app = JFactory::getApplication();

    $this->mailer->ClearAddresses();
    $this->mailer->setSubject($subject);
    $this->mailer->setBody($body);
    $this->mailer->addRecipient($email);
    $this->mailer->setSender(array($app->get('mailfrom'), $app->get('fromname')));
    $this->mailer->isHtml(true);

    return $this->mailer->send();
  }
}
