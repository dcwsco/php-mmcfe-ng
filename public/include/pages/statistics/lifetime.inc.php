<?php

// Make sure we are called from index.php
if (!defined('SECURITY')) die('Hacking attempt');

// Top Lifetime Shares
$aLifetimeShares = $statistics->getLifetimeShares();
$aYourLifetimeShares = $statistics->getLifetimeShares($_SESSION['USERDATA']['id']);

// Propagate content our template
$smarty->assign("LIFETIMESHARES", $aLifetimeShares);
$smarty->assign("YOURLIFETIMESHARES", $aYourLifetimeShares);

if ($user->isAuthenticated()) {
  $smarty->assign("CONTENT", "default.tpl");
} else {
  $smarty->assign("CONTENT", "../default.tpl");
}
?>
