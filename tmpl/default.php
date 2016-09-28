<?php

defined('_JEXEC') or die;

$doc = JFactory::getDocument();
$doc->addScript(JUri::root(true) . "/modules/mod_etdnewsletter/assets/etdnewsletter.js");

?>
<div class="mod-etdnewsletter <?php echo $moduleclass_sfx ?>" data-etd="newsletter" data-uri="<?php echo htmlspecialchars(JRoute::_('index.php?option=com_ajax&module=etdnewsletter&method=send&format=json')); ?>">
    <?php $header_text = $params->get('header_text'); ?>
     <?php if (!empty($header_text)) : ?>
    <?php echo $header_text; ?>
    <?php endif; ?>
    <?php if ($params->get('show_firstname', 0)): ?>
    <div class="form-group">
        <label for="etdnewsletter_<?php echo $module->id; ?>_firstname"<?php if ($params->get('show_labels', 1) == 0) : ?> class="sr-only"<?php endif; ?>>Prénom</label>
        <input type="text" class="form-control" autocomplete="off" data-etdnewsletter="firstname" id="etdnewsletter_<?php echo $module->id; ?>_firstname" placeholder="Prénom">
    </div>
    <?php endif; ?>
    <?php if ($params->get('show_lastname', 0)): ?>
    <div class="form-group">
        <label for="etdnewsletter_<?php echo $module->id; ?>_lastname"<?php if ($params->get('show_labels', 1) == 0) : ?> class="sr-only"<?php endif; ?>>Nom de famille</label>
        <input type="email" class="form-control" autocomplete="off" data-etdnewsletter="lastname" id="etdnewsletter_<?php echo $module->id; ?>_lastname" placeholder="Nom de famille">
    </div>
    <?php endif; ?>
    <div class="form-group">
        <label for="etdnewsletter_<?php echo $module->id; ?>_email"<?php if ($params->get('show_labels', 1) == 0) : ?> class="sr-only"<?php endif; ?>>Adresse mail</label>
        <input type="text" class="form-control" autocomplete="off" data-etdnewsletter="email" id="etdnewsletter_<?php echo $module->id; ?>_email" placeholder="Email">
    </div>
    <button type="button" autocomplete="off" class="btn btn-default" data-etdnewsletter="submit">Envoyer</button>
    <?php $footer_text = $params->get('footer_text'); ?>
    <?php if (!empty($footer_text)) : ?>
        <?php echo $footer_text; ?>
    <?php endif; ?>
</div>