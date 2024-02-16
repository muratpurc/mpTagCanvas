<?php
/**
 * Module mpTagCanvas output.
 *
 * @package     Module
 * @subpackage  mpTagCanvas
 * @author      Murat Purc <murat@purc.de>
 * @copyright   Murat Purc (https://www.purc.de)
 * @license     http://www.gnu.org/licenses/gpl-2.0.html - GNU General Public License, version 2
 */

/**
 * @var int $cCurrentModule
 * @var int $cCurrentContainer
 */

################################################################################
########## Initialization/Settings

// Includes
cInclude('module', 'includes/class.module.mptagcanvas.php');

$client = cRegistry::getClientId();
$lang = cRegistry::getLanguageId();

// Module configuration
$aModuleConfiguration = [
    'debug' => false,
    'name' => 'mpTagCanvas',
    'idmod' => $cCurrentModule,
    'container' => $cCurrentContainer,

    // common settings
    'noCanvasStyles' => "CMS_VALUE[2]",
    'canvasStyles' => "CMS_VALUE[3]",
    'defaultCanvasStyles' => 'width:400px;height:300px;',

    // tag entries
    'manualInput' => "CMS_VALUE[1]",
    'categories' => "CMS_VALUE[4]",
    'categoriesSel' => "CMS_VALUE[5]",
    'categoriesStartArticle' => "CMS_VALUE[6]",
    'categoriesOfflineArticle' => "CMS_VALUE[7]",
    'categoriesMaxArticle' => "CMS_VALUE[8]",
    'categoriesArticleTpl' => '<a href="{href}" title="{title}">{text}</a>',

    // tag canvas options
    'tc_interval' => "CMS_VALUE[20]",
    'tc_maxSpeed' => "CMS_VALUE[21]",
    'tc_minSpeed' => "CMS_VALUE[22]",
    'tc_dragControl' => "CMS_VALUE[23]",
    'tc_dragThreshold' => "CMS_VALUE[24]",
    'tc_initial' => "CMS_VALUE[25]",
    'tc_fadeIn' => "CMS_VALUE[26]",
    'tc_decel' => "CMS_VALUE[27]",
    'tc_minBrightness' => "CMS_VALUE[28]",
    'tc_maxBrightness' => "CMS_VALUE[29]",
    'tc_textColour' => "CMS_VALUE[30]",
    'tc_textHeight' => "CMS_VALUE[31]",
    'tc_textFont' => "CMS_VALUE[32]",
    'tc_outlineColour' => "CMS_VALUE[33]",
    'tc_outlineMethod' => "CMS_VALUE[34]",
    'tc_outlineThickness' => "CMS_VALUE[35]",
    'tc_outlineOffset' => "CMS_VALUE[36]",
    'tc_pulsateTo' => "CMS_VALUE[37]",
    'tc_pulsateTime' => "CMS_VALUE[38]",
    'tc_depth' => "CMS_VALUE[39]",
    'tc_freezeActive' => "CMS_VALUE[40]",
    'tc_freezeDecel' => "CMS_VALUE[41]",
    'tc_activeCursor' => "CMS_VALUE[42]",
    'tc_frontSelect' => "CMS_VALUE[42]",
    'tc_clickToFront' => "CMS_VALUE[44]",
    'tc_txtOpt' => "CMS_VALUE[45]",
    'tc_txtScale' => "CMS_VALUE[46]",
    'tc_reverse' => "CMS_VALUE[47]",
    'tc_hideTags' => "CMS_VALUE[48]",
    'tc_zoom' => "CMS_VALUE[49]",
    'tc_wheelZoom' => "CMS_VALUE[50]",
    'tc_zoomStep' => "CMS_VALUE[51]",
    'tc_zoomMax' => "CMS_VALUE[52]",
    'tc_zoomMin' => "CMS_VALUE[53]",
    'tc_shadow' => "CMS_VALUE[54]",
    'tc_shadowBlur' => "CMS_VALUE[55]",
    'tc_shadowOffset' => "CMS_VALUE[56]",
    'tc_weight' => "CMS_VALUE[57]",
    'tc_weightMode' => "CMS_VALUE[58]",
    'tc_weightSize' => "CMS_VALUE[59]",
    'tc_weightGradient' => "CMS_VALUE[60]",
    'tc_weightFrom' => "CMS_VALUE[61]",
    'tc_weightSizeMin' => "CMS_VALUE[62]",
    'tc_weightSizeMax' => "CMS_VALUE[63]",
    'tc_shape' => "CMS_VALUE[64]",
    'tc_lock' => "CMS_VALUE[65]",
    'tc_tooltip' => "CMS_VALUE[66]",
    'tc_tooltipClass' => "CMS_VALUE[67]",
    'tc_tooltipDelay' => "CMS_VALUE[68]",
    'tc_radiusX' => "CMS_VALUE[69]",
    'tc_radiusY' => "CMS_VALUE[70]",
    'tc_radiusZ' => "CMS_VALUE[71]",
    'tc_stretchX' => "CMS_VALUE[72]",
    'tc_stretchY' => "CMS_VALUE[73]",
    'tc_offsetX' => "CMS_VALUE[74]",
    'tc_offsetY' => "CMS_VALUE[75]",
    'tc_shuffleTags' => "CMS_VALUE[76]",
    'tc_noSelect' => "CMS_VALUE[77]",
    'tc_noMouse' => "CMS_VALUE[78]",
    'tc_imageScale' => "CMS_VALUE[79]",
    'tc_centreFunc' => "CMS_VALUE[80]",
    'tc_animTiming' => "CMS_VALUE[81]",
    'tc_splitWidth' => "CMS_VALUE[82]",

    'db' => cRegistry::getDb(),
    'cfg' => cRegistry::getConfig(),
    'client' => $client,
    'lang' => $lang,
];
//##echo "<pre>" . print_r($aModuleConfiguration, true) . "</pre>";

// Create module class instance
$oModule = new ModuleMpTagCanvas($aModuleConfiguration);

$cApiModule = new cApiModule($cCurrentModule);

$client = cRegistry::getClientId();
$clientCfg = cRegistry::getClientConfig($client);
$modulePath = $clientCfg['module']['frontendpath'] . $cApiModule->get('alias') . '/';

$oTpl = cSmartyFrontend::getInstance();
$oTpl->assign('modulePath', $modulePath);
$oTpl->assign('canvasContainerId', $oModule->getIdValue('mpTagCanvasContainer'));
$oTpl->assign('noCanvasStyles', $oModule->noCanvasStyles);
$oTpl->assign('canvasStyles', ($oModule->canvasStyles) ? $oModule->canvasStyles : $oModule->defaultCanvasStyles);
$oTpl->assign('canvasId', $oModule->getIdValue('mpTagCanvas'));
$oTpl->assign('canvasText', mi18n("MSG_CANVAS_TEXT"));
$oTpl->assign('tagsId', $oModule->getIdValue('mpTagCanvasTags'));
$oTpl->assign('options', $oModule->getOptions());
$oTpl->assign('entries', $oModule->getEntries());
$oTpl->display('mpTagCanvas.tpl');

// Cleanup
unset($oModule, $oTpl);

?>