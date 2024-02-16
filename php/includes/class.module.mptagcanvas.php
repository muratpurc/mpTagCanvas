<?php
/**
 * CONTENIDO module class for mpTagCanvas
 *
 * @package     CONTENIDO_Modules
 * @subpackage  mpTagCanvas
 * @author      Murat Purc <murat@purc.de>
 * @copyright   Murat Purc (https://www.purc.de)
 * @license     http://www.gnu.org/licenses/gpl-2.0.html - GNU General Public License, version 2
 */

if (!defined('CON_FRAMEWORK')) {
    die('Illegal call');
}

/**
 * CONTENIDO module class for mpTagCanvas
 * @property int $idmod
 * @property int $container
 * @property string $_code
 * @property bool $debug
 * @property string $name
 * @property int $client
 * @property int $lang
 * @property mixed|null $categoriesSel
 * @property mixed|null $categoriesStartArticle
 * @property mixed|null $categoriesOfflineArticle
 * @property mixed|null $categoriesMaxArticle
 * @property mixed|null $categoriesArticleTpl
 * @property mixed|null $noCanvasStyles
 * @property mixed|null $canvasStyles
 * @property mixed|null $defaultCanvasStyles
 */
#[AllowDynamicProperties]
class ModuleMpTagCanvas
{

    /**
     * Unique module id (module id + container)
     * @var  string
     */
    protected $_uid = '';

    /**
     * Module properties structure.
     * Not all properties are covered here, some will be added via constructor!
     * @var  array
     */
    protected $_properties = [
        'debug' => false,
        'name' => 'mpTagCanvas',
        'idmod' => 0,
        'container' => 0,
        'db' => null,
        'cfg' => null,
        'client' => 0,
        'lang' => 0,
    ];

    /**
     * Module translations
     * @var  array
     */
    protected $_i18n = [];
    /**
     * @var mixed|null
     */
    private $manualInput;

    /**
     * Constructor, sets some properties
     * @param array $options Options array
     * @param array $translations Associative translations list
     */
    public function __construct(array $options, array $translations = [])
    {
        foreach ($options as $k => $v) {
            $this->$k = $v;
        }

        $this->validate();

        $this->_i18n = $translations;
        $this->_uid = $this->idmod . '_' . $this->container;
        $this->_code = '';
    }

    /**
     * Magic getter, see PHP doc...
     */
    public function __get($name)
    {
        return $this->_properties[$name] ?? null;
    }

    /**
     * Magic setter, see PHP doc...
     */
    public function __set($name, $value)
    {
        $this->_properties[$name] = $value;
    }

    /**
     * Magic method, see PHP doc...
     */
    public function __isset($name)
    {
        return isset($this->_properties[$name]);
    }

    /**
     * Magic method, see PHP doc...
     */
    public function __unset($name)
    {
        if (isset($this->_properties[$name])) {
            unset($this->_properties[$name]);
        }
    }

    /**
     * Validates module configuration/data
     */
    protected function validate()
    {
        $this->debug = (bool)$this->debug;
        $this->name = (string)$this->name;
        $this->idmod = (int)$this->idmod;
        $this->container = (int)$this->container;
        $this->client = (int)$this->client;
        $this->lang = (int)$this->lang;
    }

    /**
     * Returns the checked attribute sub string usable for checkboxes.
     *
     * @param string $name Configuration item name
     * @return string
     */
    public function getCheckedAttribute(string $name): string
    {
        if (isset($this->$name) && '' !== $this->$name) {
            return ' checked="checked"';
        } else {
            return '';
        }
    }

    /**
     * Returns the id attribute value by concatenating passed name with the module uid.
     *
     * @param string $name
     * @return string
     */
    public function getIdValue(string $name): string
    {
        return $name . '_' . $this->getUid();
    }

    /**
     * Returns the module uid (module id + container).
     *
     * @return string
     */
    public function getUid(): string
    {
        return $this->_uid;
    }

    /**
     * Renders label for an input field, used in module input.
     *
     * @param string $name
     * @param array $item
     * @param string $text
     */
    public function renderInputLabel(string $name, array $item, string $text = ''): string
    {
        $id = $this->getIdValue($name);
        if (empty($text)) {
            $text = $name;
        }
        if (strpos($text, 'tc_') === 0) {
            $text = substr($text, 3);
        }
        return "<label for='{$id}'>{$text}</label>";
    }

    /**
     * Renders an input field, used in module input.
     *
     * @param string $name
     * @param array $item
     */
    public function renderInputItem(string $name, array $item): string
    {
        $html = '';
#        $value = conHtmlSpecialChars($this->$name);
        $value = $this->$name;
        $id = $this->getIdValue($name);
        if ('text' == $item['type']) {
            $html = "<input type='text' class='text_medium' name='{$item['var']}' value='{$value}' id='{$id}'>";
        } elseif ('bool' == $item['type']) {
            $chk = $this->getCheckedAttribute($name);
            $html = "<input type='checkbox' name='{$item['var']}' value='1' id='{$id}'{$chk}>";
        } elseif ('hidden' == $item['type']) {
            $html = "<input type='hidden' name='{$item['var']}' value='{$value}' id='{$id}'>";
        } elseif ('select' == $item['type']) {
            $data = [];
            if ('categories' == $name) {
                $output = buildCategorySelect($item['var'], '', 0, 'text_medium');
                return $output;
            } elseif ('tc_outlineMethod' == $name) {
                $data = [
                    '' => $this->_i18n['MSG_SELECT_NONE'],
                    'outline' => 'outline',
                    'classic' => 'classic',
                    'block' => 'block',
                    'colour' => 'colour',
                    'none' => 'none',
                ];
            } elseif ('tc_weightMode' == $name) {
                $data = [
                    '' => $this->_i18n['MSG_SELECT_NONE'],
                    'size' => 'size',
                    'colour' => 'colour',
                    'both' => 'both',
                ];
            } elseif ('tc_shape' == $name) {
                $data = [
                    '' => $this->_i18n['MSG_SELECT_NONE'],
                    'sphere' => 'sphere',
                    'hcylinder' => 'hcylinder',
                    'vcylinder' => 'vcylinder',
                    'hring' => 'hring',
                    'vring' => 'vring',
                ];
            } elseif ('tc_tooltip' == $name) {
                $data = [
                    '' => $this->_i18n['MSG_SELECT_NONE'],
                    'native' => 'native',
                    'div' => 'div',
                ];
            } elseif ('tc_animTiming' == $name) {
                $data = [
                    '' => $this->_i18n['MSG_SELECT_NONE'],
                    'Smooth' => 'Smooth',
                    'Linear' => 'Linear',
                ];
            }
            $html = "<select name='{$item['var']}' id='{$id}' class='text_medium'>";
            foreach ($data as $v => $t) {
                $sel = ($v == $value) ? ' selected="selected"' : '';
                $html .= "<option value='{$v}'{$sel}>{$t}</option>";
            }
            $html .= "</select>";
        } elseif ('textarea' == $item['type']) {
            $html = "<textarea class='text_medium' name='{$item['var']}' id='{$id}' cols='80' rows='10'>{$value}</textarea>";
        }

        return $html;
    }

    /**
     * Returns Tag Canvas options as a JSON string used to initialize JavaScript component.
     *
     * @return string
     */
    public function getOptions(): string
    {
        $data = [];

        foreach ($this->_properties as $name => $value) {
            if (strpos($name, 'tc_') === 0 && is_string($value) && !empty($value)) {
                $name = substr($name, 3);
                $data[$name] = $value;
            }
        }

        return json_encode($data);
    }

    /**
     * Returns defined entries for the Tag Canvas cloud.
     *
     * @return array List of HTML entries
     */
    public function getEntries(): array
    {
        if (!empty($this->manualInput)) {
            return $this->getManualTagsEntries();
        } elseif (!empty($this->categoriesSel)) {
            return $this->getCategoriesEntries();
        } else {
            return [];
        }
    }

    /**
     * Returns manual set tags.
     *
     * @return array
     */
    protected function getManualTagsEntries(): array
    {
        $entries = [];

        $tags = trim($this->manualInput);
        if (empty($tags)) {
            return $entries;
        }

        return explode("\n", str_replace("\r\n", "\n", conHtmlEntityDecode($tags)));
    }

    /**
     * Returns configured categories and articles tags.
     * @TODO: Add support for protected categories.
     *
     * @return array
     */
    protected function getCategoriesEntries(): array
    {
        $entries = [];

        $uri = cUri::getInstance();

        $categories = $this->categoriesSel;
        $startArticle = $this->categoriesStartArticle;
        $offlineArticle = $this->categoriesOfflineArticle;
        $limit = $this->categoriesMaxArticle;
        $categories = trim($categories, ',');
        $tpl = $this->categoriesArticleTpl;
        if (empty($tpl)) {
            $tpl = '<a href="{href}" title="{title}">{text}</a>';
        }

        $sql = 'SELECT cl.idcat, al.idart, al.title, al.urlname FROM
                    ' . $this->cfg['tab']['cat_art'] . ' AS ca,
                    ' . $this->cfg['tab']['art_lang'] . ' AS al,
                    ' . $this->cfg['tab']['cat_lang'] . ' AS cl
                WHERE
                    ca.idcat IN (' . $categories . ') AND
                    cl.idlang = ' . $this->lang . ' AND
                    cl.idlang = al.idlang AND
                    cl.idcat = ca.idcat AND
                    al.idart = ca.idart';

        if (!$startArticle) {
            // Skip start article
            $sql .= " AND al.idartlang != cl.startidartlang";
        }
        if (!$offlineArticle) {
            // Get only online article
            $sql .= " AND al.online = 1";
        }
        if (is_numeric($limit) && $limit > 0) {
            $sql .= " LIMIT $limit";
        }

        $this->db->query($sql);
        while ($this->db->nextRecord()) {
            $rs = $this->db->toArray();
            $url = $uri->build(['idart' => $rs['idart'], 'lang' => $this->lang]);
            $title = conHtmlSpecialChars($rs['title']);
            $entry = str_replace(['{href}', '{title}', '{text}'], [$url, $title, $rs['title']], $tpl);
            $entries[] = $entry;
        }

        return $entries;
    }

    /**
     * Simple debugger, print preformatted text, if debugging is enabled.
     *
     * @param  $msg
     */
    protected function debugInfo($msg)
    {
        if ($this->debug) {
            echo "<pre>{$msg}</pre>";
        }
    }

}
