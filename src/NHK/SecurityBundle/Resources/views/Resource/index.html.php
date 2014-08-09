<!-- Extends Layouts -->
<?php $view->extend('NHKQcBundle:Layout:layout.html.php') ?>
<!-- Title Page -->
<?php $view['slots']->start('title') ?>
    <?php echo BASE_TITLE; ?> | Resources
<?php $view['slots']->stop() ?>
<!-- JS -->
<?php $view['slots']->start('js') ?>
<?php $view['slots']->stop() ?>
<!-- CSS -->
<?php $view['slots']->start('css') ?>
<?php $view['slots']->stop() ?>	