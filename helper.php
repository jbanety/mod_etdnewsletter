<?php

defined('_JEXEC') or die;

abstract class ModEtdNewsletterHelper {

	public static function sendAjax() {

		$input = JFactory::getApplication()->input;
		$email = $input->get('email', '', 'email');

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		// On teste l'existence de l'adresse email.
		$query->select($db->quoteName('id'))
		      ->from($db->quoteName('#__etdnewsletter_emails'))
		      ->where($db->quoteName('email') . ' = ' . $db->quote($email));

		$result = $db->setQuery($query)
		             ->loadResult();

		if (isset($result)) {
			throw new \InvalidArgumentException("L'adresse email " . $email . " est déjà inscrite.");
		}

		$firstname = $input->get('firstname', '', 'string');
		$lastname  = $input->get('lastname', '', 'string');
		$created   = (new JDate())->format($db->getDateFormat());

		$query->clear()
		      ->insert($db->quoteName('#__etdnewsletter_emails'))
		      ->columns($db->quoteName([
			      'firstname',
			      'lastname',
			      'email',
			      'created'
		      ]))
		      ->values(implode(",", $db->quote([
			      $firstname,
			      $lastname,
			      $email,
			      $created
		      ])));

		$db->setQuery($query)
		   ->execute();

		return true;

	}

}