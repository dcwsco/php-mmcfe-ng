<?php

// Make sure we are called from index.php
if (!defined('SECURITY')) die('Hacking attempt');

// Check user to ensure they are admin
if (!$user->isAuthenticated() || !$user->isAdmin($_SESSION['USERDATA']['id'])) {
  header("HTTP/1.1 404 Page not found");
  die("404 Page not found");
}

if (!$smarty->isCached('master.tpl', $smarty_cache_key)) {
  $iLimit = 30;
  $debug->append('No cached version available, fetching from backend', 3);
  $aTransactions = $transaction->getAllTransactions(@$_REQUEST['start'], @$_REQUEST['filter'], $iLimit);
  $iCountTransactions = $transaction->num_rows;
  $aTransactionTypes = $transaction->getTypes();
  if (!$aTransactions) $_SESSION['POPUP'][] = array('CONTENT' => 'Could not find any transaction', 'TYPE' => 'errormsg');
  $smarty->assign('LIMIT', $iLimit);
  $smarty->assign('TRANSACTIONS', $aTransactions);
  $smarty->assign('TRANSACTIONTYPES', $aTransactionTypes);
  $smarty->assign('TXSTATUS', array('' => '', 'Confirmed' => 'Confirmed', 'Unconfirmed' => 'Unconfirmed', 'Orphan' => 'Orphan'));
  $smarty->assign('COUNTTRANSACTIONS', $iCountTransactions);
} else {
  $debug->append('Using cached page', 3);
}

// Gernerate the GET URL for filters
if (isset($_REQUEST['filter'])) {
  $strFilters = '';
  foreach (@$_REQUEST['filter'] as $filter => $value) {
    $filter = "filter[$filter]";
    $strFilters .= "&$filter=$value";
  }
  $smarty->assign('FILTERS', $strFilters);
}
$smarty->assign('CONTENT', 'default.tpl');
?>
