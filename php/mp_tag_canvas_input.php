?><?php
/**
 * Module mpTagCanvas input.
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

    // tag entries
    'manualInput' => "CMS_VALUE[1]",
    'categories' => "CMS_VALUE[4]",
    'categoriesSel' => "CMS_VALUE[5]",
    'categoriesStartArticle' => "CMS_VALUE[6]",
    'categoriesOfflineArticle' => "CMS_VALUE[7]",
    'categoriesMaxArticle' => "CMS_VALUE[8]",

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

$aModuleTranslations = [
    'MSG_SELECT_NONE' => mi18n('MSG_SELECT_NONE')
];

// Create mpTagCanvas module instance
$oModule = new ModuleMpTagCanvas($aModuleConfiguration, $aModuleTranslations);

$exampleMarkup = '<a href="http://www.contenido.org" title="CONTENIDO" target="_blank">CONTENIDO</a>
<a href="http://forum.contenido.com" title="CONTENIDO forum" target="_blank">CONTENIDO Forum</a>';
$example = '<span class="code">' . nl2br(conHtmlSpecialChars($exampleMarkup)) . '</span>';

$aModuleInputs = [
    // common settings
    '_delemiter_common' => ['delemiter' => mi18n("MSG_DELEMITER_COMMON")],
    'noCanvasStyles' => ["var" => "CMS_VAR[2]", "default" => "false", "type" => "bool", "info" => mi18n("MSG_NO_CANVAS_STYLES")],
    'canvasStyles' => ["var" => "CMS_VAR[3]", "default" => "width:400px;height:300px;", "type" => "text", "info" => mi18n("MSG_CANVAS_STYLES")],

    'manualInput' => ["var" => "CMS_VAR[1]", "type" => "textarea", "info" => sprintf(mi18n("MSG_MANUAL_TAGS"), $example)],
    'categories' => ["var" => "CMS_VAR[4]", "type" => "select", "info" => mi18n("MSG_CATEGORIES")],
    'categoriesSel' => ["var" => "CMS_VAR[5]", "type" => "hidden", "info" => mi18n("MSG_CATEGORY_SEL")],
    'categoriesStartArticle' => ["var" => "CMS_VAR[6]", "default" => "false", "type" => "bool", "info" => mi18n("MSG_CATEGORY_START_ARTICLE")],
    'categoriesOfflineArticle' => ["var" => "CMS_VAR[7]", "default" => "false", "type" => "bool", "info" => mi18n("MSG_CATEGORY_OFFLINE_ARTICLE")],
    'categoriesMaxArticle' => ["var" => "CMS_VAR[8]", "default" => "null", "type" => "text", "info" => mi18n("MSG_CATEGORY_MAX_ARTICLES")],

    // tag canvas options
    '_delemiter_tagcanvas' => ['delemiter' => mi18n("MSG_DELEMITER_TAGCANVAS")],
    'tc_interval' => ["var" => "CMS_VAR[20]", "default" => "20", "type" => "text", "info" => mi18n("MSG_INTERVAL")],
    'tc_maxSpeed' => ["var" => "CMS_VAR[21]", "default" => "0.05", "type" => "text", "info" => mi18n("MSG_MAXSPEED")],
    'tc_minSpeed' => ["var" => "CMS_VAR[22]", "default" => "0.0", "type" => "text", "info" => mi18n("MSG_MINSPEED")],
    'tc_dragControl' => ["var" => "CMS_VAR[23]", "default" => "false", "type" => "bool", "info" => mi18n("MSG_DRAGCONTROL")],
    'tc_dragThreshold' => ["var" => "CMS_VAR[24]", "default" => "4", "type" => "text", "info" => mi18n("MSG_DRAGTHRESHOLD")],
    'tc_initial' => ["var" => "CMS_VAR[25]", "default" => "null", "type" => "text", "info" => mi18n("MSG_INITIAL")],
    'tc_fadeIn' => ["var" => "CMS_VAR[26]", "default" => "0", "type" => "text", "info" => mi18n("MSG_FADEIN")],
    'tc_decel' => ["var" => "CMS_VAR[27]", "default" => "0.95", "type" => "text", "info" => mi18n("MSG_DECEL")],
    'tc_minBrightness' => ["var" => "CMS_VAR[28]", "default" => "0.1", "type" => "text", "info" => mi18n("MSG_MINBRIGHTNESS")],
    'tc_maxBrightness' => ["var" => "CMS_VAR[29]", "default" => "1.0", "type" => "text", "info" => mi18n("MSG_MAXBRIGHTNESS")],
    'tc_textColour' => ["var" => "CMS_VAR[30]", "default" => "#ff99ff", "type" => "text", "info" => mi18n("MSG_TEXTCOLOUR")],
    'tc_textHeight' => ["var" => "CMS_VAR[31]", "default" => "15", "type" => "text", "info" => mi18n("MSG_TEXTHEIGHT")],
    'tc_textFont' => ["var" => "CMS_VAR[32]", "default" => "Helvetica, Arial, sans-serif", "type" => "text", "info" => mi18n("MSG_TEXTFONT")],
    'tc_outlineColour' => ["var" => "CMS_VAR[33]", "default" => "#ffff99", "type" => "text", "info" => mi18n("MSG_OUTLINECOLOUR")],
    'tc_outlineMethod' => ["var" => "CMS_VAR[34]", "default" => "outline", "type" => "select", "info" => mi18n("MSG_OUTLINEMETHOD")],
    'tc_outlineThickness' => ["var" => "CMS_VAR[35]", "default" => "2", "type" => "text", "info" => mi18n("MSG_OUTLINETHICKNESS")],
    'tc_outlineOffset' => ["var" => "CMS_VAR[36]", "default" => "5", "type" => "text", "info" => mi18n("MSG_OUTLINEOFFSET")],
    'tc_pulsateTo' => ["var" => "CMS_VAR[37]", "default" => "1.0", "type" => "text", "info" => mi18n("MSG_PULSATETO")],
    'tc_pulsateTime' => ["var" => "CMS_VAR[38]", "default" => "3", "type" => "text", "info" => mi18n("MSG_PULSATETIME")],
    'tc_depth' => ["var" => "CMS_VAR[39]", "default" => "0.5", "type" => "text", "info" => mi18n("MSG_DEPTH")],
    'tc_freezeActive' => ["var" => "CMS_VAR[40]", "default" => "false", "type" => "bool", "info" => mi18n("MSG_FREEZEACTIVE")],
    'tc_freezeDecel' => ["var" => "CMS_VAR[41]", "default" => "false", "type" => "bool", "info" => mi18n("MSG_FREEZEDECEL")],
    'tc_activeCursor' => ["var" => "CMS_VAR[42]", "default" => "pointer", "type" => "text", "info" => mi18n("MSG_ACTIVECURSOR")],
    'tc_frontSelect' => ["var" => "CMS_VAR[42]", "default" => "false", "type" => "bool", "info" => mi18n("MSG_FRONTSELECT")],
    'tc_clickToFront' => ["var" => "CMS_VAR[44]", "default" => "null", "type" => "text", "info" => mi18n("MSG_CLICKTOFRONT")],
    'tc_txtOpt' => ["var" => "CMS_VAR[45]", "default" => "true", "type" => "bool", "info" => mi18n("MSG_TXTOPT")],
    'tc_txtScale' => ["var" => "CMS_VAR[46]", "default" => "2", "type" => "text", "info" => mi18n("MSG_TXTSCALE")],
    'tc_reverse' => ["var" => "CMS_VAR[47]", "default" => "false", "type" => "bool", "info" => mi18n("MSG_REVERSE")],
    'tc_hideTags' => ["var" => "CMS_VAR[48]", "default" => "true", "type" => "bool", "info" => mi18n("MSG_HIDETAGS")],
    'tc_zoom' => ["var" => "CMS_VAR[49]", "default" => "1.0", "type" => "text", "info" => mi18n("MSG_ZOOM")],
    'tc_wheelZoom' => ["var" => "CMS_VAR[50]", "default" => "true", "type" => "bool", "info" => mi18n("MSG_WHEELZOOM")],
    'tc_zoomStep' => ["var" => "CMS_VAR[51]", "default" => "0.05", "type" => "text", "info" => mi18n("MSG_ZOOMSTEP")],
    'tc_zoomMax' => ["var" => "CMS_VAR[52]", "default" => "3.0", "type" => "text", "info" => mi18n("MSG_ZOOMMAX")],
    'tc_zoomMin' => ["var" => "CMS_VAR[53]", "default" => "0.3", "type" => "text", "info" => mi18n("MSG_ZOOMMIN")],
    'tc_shadow' => ["var" => "CMS_VAR[54]", "default" => "#000000", "type" => "text", "info" => mi18n("MSG_SHADOW")],
    'tc_shadowBlur' => ["var" => "CMS_VAR[55]", "default" => "0", "type" => "text", "info" => mi18n("MSG_SHADOWBLUR")],
    'tc_shadowOffset' => ["var" => "CMS_VAR[56]", "default" => "[0,0]", "type" => "text", "info" => mi18n("MSG_SHADOWOFFSET")],
    'tc_weight' => ["var" => "CMS_VAR[57]", "default" => "false", "type" => "bool", "info" => mi18n("MSG_WEIGHT")],
    'tc_weightMode' => ["var" => "CMS_VAR[58]", "default" => "size", "type" => "select", "info" => mi18n("MSG_WEIGHTMODE")],
    'tc_weightSize' => ["var" => "CMS_VAR[59]", "default" => "1.0", "type" => "text", "info" => mi18n("MSG_WEIGHTSIZE")],
    'tc_weightGradient' => ["var" => "CMS_VAR[60]", "default" => "{0:'#f00', 0.33:'#ff0', 0.66:'#0f0', 1:'#00f'}", "type" => "text", "info" => mi18n("MSG_WEIGHTGRADIENT")],
    'tc_weightFrom' => ["var" => "CMS_VAR[61]", "default" => "null", "type" => "text", "info" => mi18n("MSG_WEIGHTFROM")],
    'tc_weightSizeMin' => ["var" => "CMS_VAR[62]", "default" => "null", "type" => "text", "info" => mi18n("MSG_WEIGHTSIZEMIN")],
    'tc_weightSizeMax' => ["var" => "CMS_VAR[63]", "default" => "null", "type" => "text", "info" => mi18n("MSG_WEIGHTSIZEMAX")],
    'tc_shape' => ["var" => "CMS_VAR[64]", "default" => "sphere", "type" => "select", "info" => mi18n("MSG_SHAPE")],
    'tc_lock' => ["var" => "CMS_VAR[65]", "default" => "null", "type" => "text", "info" => mi18n("MSG_LOCK")],
    'tc_tooltip' => ["var" => "CMS_VAR[66]", "default" => "null", "type" => "select", "info" => mi18n("MSG_TOOLTIP")],
    'tc_tooltipClass' => ["var" => "CMS_VAR[67]", "default" => "tctooltip", "type" => "text", "info" => mi18n("MSG_TOOLTIPCLASS")],
    'tc_tooltipDelay' => ["var" => "CMS_VAR[68]", "default" => "300", "type" => "text", "info" => mi18n("MSG_TOOLTIPDELAY")],
    'tc_radiusX' => ["var" => "CMS_VAR[69]", "default" => "1", "type" => "text", "info" => mi18n("MSG_RADIUSX")],
    'tc_radiusY' => ["var" => "CMS_VAR[70]", "default" => "1", "type" => "text", "info" => mi18n("MSG_RADIUSY")],
    'tc_radiusZ' => ["var" => "CMS_VAR[71]", "default" => "1", "type" => "text", "info" => mi18n("MSG_RADIUSZ")],
    'tc_stretchX' => ["var" => "CMS_VAR[72]", "default" => "1", "type" => "text", "info" => mi18n("MSG_STRETCHX")],
    'tc_stretchY' => ["var" => "CMS_VAR[73]", "default" => "1", "type" => "text", "info" => mi18n("MSG_STRETCHY")],
    'tc_offsetX' => ["var" => "CMS_VAR[74]", "default" => "0", "type" => "text", "info" => mi18n("MSG_OFFSETX")],
    'tc_offsetY' => ["var" => "CMS_VAR[75]", "default" => "0", "type" => "text", "info" => mi18n("MSG_OFFSETY")],
    'tc_shuffleTags' => ["var" => "CMS_VAR[76]", "default" => "false", "type" => "bool", "info" => mi18n("MSG_SHUFFLETAGS")],
    'tc_noSelect' => ["var" => "CMS_VAR[77]", "default" => "false", "type" => "bool", "info" => mi18n("MSG_NOSELECT")],
    'tc_noMouse' => ["var" => "CMS_VAR[78]", "default" => "false", "type" => "bool", "info" => mi18n("MSG_NOMOUSE")],
    'tc_imageScale' => ["var" => "CMS_VAR[79]", "default" => "1", "type" => "text", "info" => mi18n("MSG_IMAGESCALE")],
    'tc_centreFunc' => ["var" => "CMS_VAR[80]", "default" => "null", "type" => "text", "info" => mi18n("MSG_CENTREFUNC")],
    'tc_animTiming' => ["var" => "CMS_VAR[81]", "default" => "Smooth", "type" => "select", "info" => mi18n("MSG_ANIMTIMING")],
    'tc_splitWidth' => ["var" => "CMS_VAR[82]", "default" => "0", "type" => "text", "info" => mi18n("MSG_SPLITWIDTH")],
];

################################################################################
########## Output

?>

<style>
.mpTagCanvasInput textarea {width:95%;font-family:courier, "courier new", sans-serif;}
.mpTagCanvasInput .code {font-family:courier, "courier new", sans-serif;}
.mpTagCanvasInput .catItem {padding:3px;}
.mpTagCanvasInput .addCategory {cursor:pointer;vertical-align:middle;}
.mpTagCanvasInput .removeCategory {cursor:pointer;vertical-align:middle;margin:left:5px;}
</style>
<div class="mpTagCanvasInput">

<div id="tabs-<?php echo $oModule->getUid() ?>">
    <ul>
        <li><a href="#tabs-<?php echo $oModule->getUid() ?>-1"><?php echo mi18n("MSG_TAG_ENTRIES") ?></a></li>
        <li><a href="#tabs-<?php echo $oModule->getUid() ?>-2"><?php echo mi18n("MSG_EXTENDED_OPTIONS") ?></a></li>
    </ul>

    <!-- Tag entries -->
    <div id="tabs-<?php echo $oModule->getUid() ?>-1">

        <p><?php echo mi18n("MSG_TAG_ENTRIES_TITLE") ?></p>

        <div id="tabssub-<?php echo $oModule->getUid() ?>">
            <ul>
                <li><a href="#tabssub-<?php echo $oModule->getUid() ?>-1"><?php echo mi18n("MSG_MANUAL") ?></a></li>
                <li><a href="#tabssub-<?php echo $oModule->getUid() ?>-2"><?php echo mi18n("MSG_ARTICLES") ?></a></li>
            </ul>

            <!-- Manual -->
            <div id="tabssub-<?php echo $oModule->getUid() ?>-1">
                <table>
                <tr>
                    <td class="text_medium">
                        <p><?php echo $aModuleInputs['manualInput']['info']; ?></p>
                        <?php echo $oModule->renderInputLabel('manualInput', $aModuleInputs['manualInput']); ?><br>
                        <?php echo $oModule->renderInputItem('manualInput', $aModuleInputs['manualInput']); ?>
                    </td>
                </tr>
                </table>
                <?php unset($aModuleInputs['manualInput']); ?>
            </div>

            <!-- Categories/Articles -->
            <div id="tabssub-<?php echo $oModule->getUid() ?>-2">
                <table>
                <tr>
                    <td class="text_medium">
                        <div id="mpTagCanvasArticlesCategory-<?php echo $oModule->getUid() ?>">
                            <p><strong><?php echo $aModuleInputs['categories']['info']; ?></strong></p>
                            <?php echo $oModule->renderInputItem('categories', $aModuleInputs['categories']); ?>
                            <img class="addCategory" src="images/but_art_new.gif" title="<?php echo mi18n("MSG_ADD_CATEGORY"); ?>" alt="<?php echo mi18n("MSG_ADD_CATEGORY"); ?>">
                            <br>
                        </div>
                        <br>
                        <div id="mpTagCanvasArticlesCategorySel-<?php echo $oModule->getUid() ?>">
                            <p><strong><?php echo $aModuleInputs['categoriesSel']['info']; ?></strong></p>
                            <?php echo $oModule->renderInputItem('categoriesSel', $aModuleInputs['categoriesSel']); ?><br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="text_medium"><hr></td>
                </tr>
                <tr>
                    <td class="text_medium">
                        <?php echo $oModule->renderInputItem('categoriesStartArticle', $aModuleInputs['categoriesStartArticle']); ?>
                        <?php echo $oModule->renderInputLabel('categoriesStartArticle', $aModuleInputs['categoriesStartArticle'], $aModuleInputs['categoriesStartArticle']['info']); ?>
                    </td>
                </tr>
                <tr>
                    <td class="text_medium">
                        <?php echo $oModule->renderInputItem('categoriesOfflineArticle', $aModuleInputs['categoriesOfflineArticle']); ?>
                        <?php echo $oModule->renderInputLabel('categoriesOfflineArticle', $aModuleInputs['categoriesOfflineArticle'], $aModuleInputs['categoriesOfflineArticle']['info']); ?>
                    </td>
                </tr>
                <tr>
                    <td class="text_medium">
                        <?php echo $oModule->renderInputItem('categoriesMaxArticle', $aModuleInputs['categoriesMaxArticle']); ?>
                        <?php echo $oModule->renderInputLabel('categoriesMaxArticle', $aModuleInputs['categoriesMaxArticle'], $aModuleInputs['categoriesMaxArticle']['info']); ?>
                    </td>
                </tr>
                </table>
                <?php
                unset(
                    $aModuleInputs['categories'],
                    $aModuleInputs['categoriesSel'],
                    $aModuleInputs['categoriesStartArticle'],
                    $aModuleInputs['categoriesOfflineArticle'],
                    $aModuleInputs['categoriesMaxArticle']
                );
                ?>
            </div>

        </div>

    </div>

    <!-- TagCanvas options -->
    <div id="tabs-<?php echo $oModule->getUid() ?>-2">
        <table>
        <tr>
            <th colspan="2" class="text_medium" style="text-align:left">
                <?php echo mi18n("MSG_OPTION") ?>
            </th>
            <th class="text_medium" style="text-align:left">
                <?php echo mi18n("MSG_DEFAULT_VALUE") ?>
            </th>
            <th class="text_medium" style="text-align:left">
                <?php echo mi18n("MSG_DESCRIPTION") ?>
            </th>
        </tr>
        <?php foreach ($aModuleInputs as $name => $item) : ?>
            <?php if (isset($item['delemiter'])) : ?>
            <tr>
                <td colspan="4" class="text_medium">
                    <hr>
                    <strong><?php echo $item['delemiter']; ?></strong>
                </td>
            </tr>
            <?php elseif ('_' !== $name[0]) : ?>
            <tr>
                <td class="text_medium">
                    <?php echo $oModule->renderInputLabel($name, $item); ?>
                </td>
                <td class="text_medium">
                    <?php echo $oModule->renderInputItem($name, $item); ?>
                </td>
                <td class="text_medium">
                    <?php echo $item['default']; ?>
                </td>
                <td class="text_medium">
                    <?php echo $item['info']; ?>
                </td>
            </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        </table>
    </div>
</div>
</div> <!-- /mpTagCanvasInput -->
<script>
$(function() {
    $("#tabs-<?php echo $oModule->getUid() ?>").tabs();
    $("#tabssub-<?php echo $oModule->getUid() ?>").tabs();

    var $catsSection = $("#mpTagCanvasArticlesCategory-<?php echo $oModule->getUid() ?>"),
        $catsSelect = $catsSection.find('select'),
        $catsAddBtn = $catsSection.find('img.addCategory'),
        $catsSelSection = $("#mpTagCanvasArticlesCategorySel-<?php echo $oModule->getUid() ?>"),
        $catsSel = $catsSelSection.find('input[type="hidden"]');

    var _isSelected = function(value) {
        var cats = $catsSel.val();
        return (-1 !== cats.search(',' + value + ','));
    };

    var _addCategory = function(value, text) {
        _renderCategoyItem(value, text);
        var cats = $catsSel.val();
        if (cats == '') {
            cats = ',';
        }
        cats += value + ',';
        //##console.log('_addCategory cats', cats);
        $catsSel.val(cats);
    };

    var _renderCategoyItem = function(value, text) {
        var img = '<img class="removeCategory" src="images/but_delete.gif" title="<?php echo mi18n("MSG_REMOVE_CATEGORY"); ?>">';
        $catsSelSection.append('<div class="catItem" data-idcat="' + value + '">' + text + ' ' + img + '</div>');
    };

    var _getTextByValue = function(value) {
        var text = $catsSelect.find('option[value="' + value + '"]').text();
        return text.replace('&nbsp;', '-').replace('>', '&gt;');
    };

    var _removeCategory = function(value) {
        $catsSelSection.find('[data-idcat="' + value + '"]').remove();
        var cats = $catsSel.val();
        cats = cats.replace(',' + value + ',', ',');
        $catsSel.val(cats);
    };

    // Add category click handler
    $catsAddBtn.click(function() {
        var value = $catsSelect.val(),
            text;
        if (false === _isSelected(value)) {
            text = _getTextByValue(value);
            _addCategory(value, text);
        }
    });

    // Remove category click handler
    $catsSelSection.delegate('img.removeCategory', 'click', function() {
        var idcat = $(this).parent().data('idcat');
        if (idcat) {
            _removeCategory(idcat);
        }
    });

    // set initial selected categories
    var cats = $catsSel.val(),
        text;
    //##console.log('initial cats', cats);
    cats = cats.split(',');
    $.each(cats, function(index, value) {
        if (!value) {
            return;
        }
        text = _getTextByValue(value);
        if (!text) {
            text = '<?php echo mi18n("MSG_UNKNOWN_CATEGORY"); ?>';
        }
        _renderCategoyItem(value, text);
    });
});
</script>

<?php

################################################################################
########## Cleanup

unset($oModule);
