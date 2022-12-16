<?php
declare(strict_types=1);

/**
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE file
 * Redistributions of files must retain the above copyright notice.
 * You may obtain a copy of the License at
 *     https://opensource.org/licenses/mit-license.php
 *
 * @copyright Copyright (c) Mikaël Capelle (https://typename.fr)
 * @license https://opensource.org/licenses/mit-license.php MIT License
 */
namespace Bootstrap\View\Helper;

use Cake\Utility\Hash;
use Cake\View\View;

/**
 * Html Helper class for easy use of HTML widgets.
 * HtmlHelper encloses all methods needed while working with HTML pages.
 *
 * @property \Cake\View\Helper\UrlHelper $Url
 * @link http://book.cakephp.org/3.0/en/views/helpers/html.html
 */
class HtmlHelper extends \Cake\View\Helper\HtmlHelper
{
    use ClassTrait;
    use EasyIconTrait;

    /**
     * Default configuration for this helper.
     * Don't override parent::$_defaultConfig for robustness
     *
     * @var array
     */
    protected $_helperConfig = [
        // phpcs:disable Generic.Files.LineLength.TooLong
        'templates' => [
            // New templates for Bootstrap
            //'icon' => '<i aria-hidden="true" class="glyphicon glyphicon-{{type}}{{attrs.class}}"{{attrs}}></i>',
            'icon' => '<{{tag}} aria-hidden="true" class="{{font}}{{type}}{{attrs.class}}"{{attrs}}></{{tag}}>',
            'label' => '<span class="label label-{{type}}{{attrs.class}}"{{attrs}}>{{content}}</span>',
            'badge' => '<span class="badge{{attrs.class}}"{{attrs}}>{{content}}</span>',
            'alert' => '<div class="alert alert-{{type}}{{attrs.class}}" role="alert"{{attrs}}>{{close}}{{content}}</div>',
            'alertCloseButton' =>
                '<button type="button" class="close{{attrs.class}}" data-dismiss="alert" aria-label="{{label}}"{{attrs}}>{{content}}</button>',
            'alertCloseContent' => '<span aria-hidden="true">&times;</span>',
            'tooltip' => '<{{tag}} data-toggle="{{toggle}}" data-placement="{{placement}}" title="{{tooltip}}"{{attrs}}>{{content}}</{{tag}}>',
            'progressBar' =>
                '<div class="progress-bar progress-bar-{{type}}{{attrs.class}}" role="progressbar"
aria-valuenow="{{width}}" aria-valuemin="{{min}}" aria-valuemax="{{max}}" style="width: {{width}}%;"{{attrs}}>{{inner}}</div>',
            'progressBarInner' => '<span class="sr-only">{{width}}%</span>',
            'progressBarContainer' => '<div class="progress{{attrs.class}}"{{attrs}}>{{content}}</div>',

            'dropdownMenu' => '<ul class="dropdown-menu{{attrs.class}}"{{attrs}}>{{content}}</ul>',
            'dropdownMenuItem' => '<li{{attrs}}>{{content}}</li>',
            'dropdownMenuHeader' => '<li role="presentation" class="dropdown-header{{attrs.class}}"{{attrs}}>{{content}}</li>',
            'dropdownMenuDivider' => '<li role="separator" class="divider{{attrs.class}}"{{attrs}}></li>',
        ],
        // phpcs:enable
        'templateClass' => 'Bootstrap\View\EnhancedStringTemplate',
        'tooltip' => [
            'tag' => 'span',
            'placement' => 'right',
            'toggle' => 'tooltip',
        ],
        'label' => [
            'type' => 'default',
        ],
        'alert' => [
            'type' => 'warning',
            'close' => true,
        ],
        'progress' => [
            'type' => 'primary',
        ],
    ];

    public const FONT_GLYPHICON = 'glyphicon';
    public const FONT_AWESOME = 'fa';
    public const FONT_AWESOME5_SOLID = 'fas';
    public const FONT_AWESOME5_REGULAR = 'far';
    public const FONT_AWESOME5_LIGHT = 'fal';
    public const FONT_AWESOME5_DUOTONE = 'fad';
    public const FONT_AWESOME5_BRAND = 'fab';
    public const FONT_AWESOME6_SOLID = 'fa-solid';
    public const FONT_AWESOME6_REGULAR = 'fa-regular';
    public const FONT_AWESOME6_LIGHT = 'fa-light';
    public const FONT_AWESOME6_DUOTONE = 'fa-duotone';
    public const FONT_AWESOME6_THIN = 'fa-thin';
    public const FONT_AWESOME6_BRAND = 'fa-brands';

    protected const ICON_FONTS = [
        self::FONT_GLYPHICON => 'glyphicon glyphicon-',
        self::FONT_AWESOME => 'fa fa-',
        self::FONT_AWESOME5_SOLID => 'fas fa-',
        self::FONT_AWESOME5_REGULAR => 'far fa-',
        self::FONT_AWESOME5_LIGHT => 'fal fa-',
        self::FONT_AWESOME5_DUOTONE => 'fad fa-',
        self::FONT_AWESOME5_BRAND => 'fab fa-',
        self::FONT_AWESOME6_SOLID => 'fa-solid fa-',
        self::FONT_AWESOME6_REGULAR => 'fa-regular fa-',
        self::FONT_AWESOME6_LIGHT => 'fa-light fa-',
        self::FONT_AWESOME6_DUOTONE => 'fa-duotone fa-',
        self::FONT_AWESOME6_THIN => 'fa-thin fa-',
        self::FONT_AWESOME6_BRAND => 'fa-brands fa-',
    ];

    /**
     * @inheritDoc
     */
    public function __construct(View $View, array $config = [])
    {
        // Default config. Use Hash::merge() to keep default values
        $this->_defaultConfig = Hash::merge($this->_defaultConfig, $this->_helperConfig);

        parent::__construct($View, $config);
    }

    /**
     * Create an icon using the template `icon`.
     * ### Options
     * - `templateVars` Provide template variables for the `icon` template.
     * - Other attributes will be assigned to the wrapper element.
     *
     * @param string $icon Name of the icon.
     * @param array $options Array of options. See above.
     * - HtmlHelper::FONT_GLYPHICON        for default Twitter Bootstrap icon.
     * - HtmlHelper::FONT_AWESOME          for Font Awesome icon.
     * - HtmlHelper::FONT_AWESOME5_SOLID   for Font Awesome 5 Solid icon.
     * - HtmlHelper::FONT_AWESOME5_REGULAR for Font Awesome 5 Regular icon.
     * - HtmlHelper::FONT_AWESOME5_LIGHT   for Font Awesome 5 Light icon.
     * - HtmlHelper::FONT_AWESOME5_DUOTONE for Font Awesome 5 Duotone icon.
     * - HtmlHelper::FONT_AWESOME5_BRAND   for Font Awesome 5 Brand icon.
     * - HtmlHelper::FONT_AWESOME6_SOLID   for Font Awesome 6 Solid icon.
     * - HtmlHelper::FONT_AWESOME6_REGULAR for Font Awesome 6 Regular icon.
     * - HtmlHelper::FONT_AWESOME6_LIGHT   for Font Awesome 6 Light icon.
     * - HtmlHelper::FONT_AWESOME6_DUOTONE for Font Awesome 6 Duotone icon.
     * - HtmlHelper::FONT_AWESOME6_THIN    for Font Awesome 6 Thin icon.
     * - HtmlHelper::FONT_AWESOME6_BRAND   for Font Awesome 6 Brand icon.
     * @return string The HTML icon.
     */
    public function icon(string $icon, array $options = [])
    {
        $options += [
            'font' => self::FONT_GLYPHICON,
            'templateVars' => [],
        ];

        $options['templateVars']['tag'] = $options['tag'] ?? 'i';
        $options['templateVars']['font'] = self::ICON_FONTS[$options['font']] ?? self::ICON_FONTS[self::FONT_GLYPHICON];

        unset($options['tag']);
        unset($options['font']);

        return $this->formatTemplate('icon', [
            'type' => $icon,
            'attrs' => $this->templater()->formatAttributes($options),
            'templateVars' => $options['templateVars'],
        ]);
    }

    /**
     * @inheritDoc
     */
    public function link($title, $url = null, array $options = []): string
    {
        [$options, $easyIcon] = $this->_easyIconOption($options);

        return $this->_injectIcon(parent::link($title, $url, $options), $easyIcon);
    }

    /**
     * Create a Twitter Bootstrap span label.
     * The second parameter may either be `$type` or `$options` (in which case
     * the third parameter is not used, and the label type can be specified in the
     * `$options` array).
     * ### Options
     * - `tag` The HTML tag to use.
     * - `type` The type of the label.
     * - `templateVars` Provide template variables for the `label` template.
     * - Other attributes will be assigned to the wrapper element.
     *
     * @param string $text The label text
     * @param string|array $type The label type (default, primary, success, warning,
     * info, danger) or the array of options (see `$options`).
     * @param array $options Array of options. See above. Default values are retrieved
     * from the configuration.
     * @return string The HTML label element.
     */
    public function label($text, $type = null, $options = [])
    {
        if (is_string($type)) {
            $options['type'] = $type;
        } elseif (is_array($type)) {
            $options = $type;
        }
        $options += $this->getConfig('label') + [
                'templateVars' => [],
            ];
        $type = $options['type'];

        return $this->formatTemplate('label', [
            'type' => $options['type'],
            'content' => $text,
            'attrs' => $this->templater()->formatAttributes($options, ['type']),
            'templateVars' => $options['templateVars'],
        ]);
    }

    /**
     * Create a Twitter Bootstrap badge.
     * ### Options
     * - `templateVars` Provide template variables for the `badge` template.
     * - Other attributes will be assigned to the wrapper element.
     *
     * @param string $text The badge text.
     * @param array $options Array of attributes for the span element.
     * @return string
     */
    public function badge(string $text, array $options = []): string
    {
        $options += [
            'templateVars' => [],
        ];

        return $this->formatTemplate('badge', [
            'content' => $text,
            'attrs' => $this->templater()->formatAttributes($options),
            'templateVars' => $options['templateVars'],
        ]);
    }

    /**
     * Create a Twitter Bootstrap style alert block, containing text.
     * The second parameter may either be `$type` or `$options` (in this case,
     * the third parameter is not used, and the alert type can be specified in the
     * `$options` array).
     * ### Options
     * - `close` Dismissible alert. See configuration for default.
     * - `type` The type of the alert. See configuration for default.
     * - `templateVars` Provide template variables for the `alert` template.
     * - Other attributes will be assigned to the wrapper element.
     *
     * @param string $text The alert text.
     * @param string|array $type The type of the alert.
     * @param array $options Array of options. See above.
     * @return string A HTML bootstrap alert element.
     */
    public function alert(string $text, $type = null, array $options = []): string
    {
        if (is_string($type)) {
            $options['type'] = $type;
        } elseif (is_array($type)) {
            $options = $type;
        }
        $options += $this->getConfig('alert') + [
                'templateVars' => [],
            ];
        $close = null;
        if ($options['close']) {
            $closeContent = $this->formatTemplate('alertCloseContent', [
                'templateVars' => $options['templateVars'],
            ]);
            $close = $this->formatTemplate('alertCloseButton', [
                'label' => __('Close'),
                'content' => $closeContent,
                'attrs' => $this->templater()->formatAttributes([]),
                'templateVars' => $options['templateVars'],
            ]);
            $options = $this->addClass($options, 'alert-dismissible');
        }

        return $this->formatTemplate('alert', [
            'type' => $options['type'],
            'close' => $close,
            'content' => $text,
            'attrs' => $this->templater()->formatAttributes($options, ['close', 'type']),
            'templateVars' => $options['templateVars'],
        ]);
    }

    /**
     * Create a Twitter Bootstrap style tooltip.
     * ### Options
     * - `toggle` The 'data-toggle' HTML attribute.
     * - `placement` The `data-placement` HTML attribute.
     * - `tag` The tag to use.
     * - `templateVars` Provide template variables for the `tooltip` template.
     * - Other attributes will be assigned to the wrapper element.
     *
     * @param string $text The HTML tag inner text.
     * @param string $tooltip The tooltip text.
     * @param array $options An array of options. See above. Default values are retrieved
     * from the configuration.
     * @return string The text wrapped in the specified HTML tag with a tooltip.
     */
    public function tooltip($text, $tooltip, $options = [])
    {
        $options += $this->getConfig('tooltip') + [
                'tooltip' => $tooltip,
                'templateVars' => [],
            ];

        return $this->formatTemplate('tooltip', [
            'content' => $text,
            'attrs' => $this->templater()->formatAttributes($options, ['tag', 'toggle', 'placement', 'tooltip']),
            'templateVars' => array_merge($options, $options['templateVars']),
        ]);
    }

    /**
     * Create a Twitter Bootstrap style progress bar.
     * ### Bar options:
     * - `active` If `true` the progress bar will be active. Default is `false`.
     * - `max` Maximum value for the progress bar. Default is `100`.
     * - `min` Minimum value for the progress bar. Default is `0`.
     * - `striped` If `true` the progress bar will be striped. Default is `false`.
     * - `type` A string containing the `type` of the progress bar (primary, info, danger,
     * success, warning). Default to `'primary'`.
     * - `templateVars` Provide template variables for the `progressBar` template.
     * - Other attributes will be assigned to the progress bar element.
     *
     * @param int|array $widths Progress bar widths.
     *   - `int` The width (in %) of the bar.
     *   - `array` An array of bars, with, for each bar, the following fields:
     *      - `width` **required** The width of the bar.
     *      - Other options possible (see above).
     * @param array $options Array of options. See above.
     * @return string The HTML bootstrap progress bar.
     */
    public function progress($widths, array $options = [])
    {
        $options += $this->getConfig('progress') + [
                'striped' => false,
                'active' => false,
                'min' => 0,
                'max' => 100,
                'templateVars' => [],
            ];
        if (!is_array($widths)) {
            $widths = [
                ['width' => $widths],
            ];
        }
        $bars = '';
        foreach ($widths as $width) {
            $width += $options;
            if ($width['striped']) {
                $width = $this->addClass($width, 'progress-bar-striped');
            }
            if ($width['active']) {
                $width = $this->addClass($width, 'active');
            }
            $inner = $this->formatTemplate('progressBarInner', [
                'width' => $width['width'],
            ]);

            $bars .= $this->formatTemplate('progressBar', [
                'inner' => $inner,
                'type' => $width['type'],
                'min' => $width['min'],
                'max' => $width['max'],
                'width' => $width['width'],
                'attrs' => $this->templater()
                    ->formatAttributes($width, ['striped', 'active', 'min', 'max', 'type', 'width']),
                'templateVars' => $width['templateVars'],
            ]);
        }

        return $this->formatTemplate('progressBarContainer', [
            'content' => $bars,
            'attrs' => $this->templater()->formatAttributes([]),
            'templateVars' => $options['templateVars'],
        ]);
    }

    /**
     * Create & return a twitter bootstrap dropdown menu.
     * ```php
     * [
     *   // Divider
     *   'divider',
     *   ['divider'],
     *   ['divider' => true]
     *   // Header
     *   ['header', $title],
     *   ['header' => $title],
     *   ['header' => ['title' => $title, ...]] // Remaining options
     *   // Link item
     *   [$name, $url, ...] // Remaining options
     *   ['link', $name, $url, ...] // Remaining options
     *   ['item' => ['title' => $title, 'url' => $url, ...]] // Remaining options
     *   // Non-link item
     *   ['item' => ['title' => $title, ...]] // Remaining options
     *   'My Item'
     * ]
     * ```
     *
     * @param array $menu HTML tags corresponding to menu options (which will be wrapped
     *              into `<li>` tag). To add separator, pass `'divider'`.
     * @param array $options Attributes for the wrapper (change it with tag).
     * @return string
     */
    public function dropdown(array $menu = [], array $options = [])
    {
        $normalized = [];
        foreach ($menu as $key => $value) {
            if (!is_numeric($key)) {
                $value = [$key => $value];
            }
            // Normalized item...
            if (!is_array($value)) {
                if ($value === 'divider') {
                    $value = ['divider' => []];
                } else {
                    $value = ['item' => ['title' => $value]];
                }
            }
            if (isset($value[0])) {
                if ($value[0] == 'header') {
                    $value = ['header' => ['title' => $value[1]]];
                } elseif ($value[0] == 'divider') {
                    $value = ['divider' => []];
                } else {
                    if ($value[0] == 'link') {
                        array_shift($value);
                    }
                    $title = array_shift($value);
                    $url = array_shift($value);
                    $value = [
                        'item' => array_merge([
                            'title' => $title, 'url' => $url,
                        ], $value),
                    ];
                }
            }
            if (isset($value['header']) && is_string($value['header'])) {
                $value = ['header' => ['title' => $value['header']]];
            }
            if (isset($value['divider']) && !is_array($value['divider'])) {
                $value['divider'] = [];
            }
            $normalized[] = $value;
        }
        $content = '';
        foreach ($normalized as $item) {
            foreach ($item as $key => $value) {
                $value += [
                    'templateVars' => [],
                ];
                if ($key == 'divider') {
                    $content .= $this->formatTemplate('dropdownMenuDivider', [
                        'attrs' => $this->templater()->formatAttributes($value),
                        'templateVars' => $value['templateVars'],
                    ]);
                }
                if ($key == 'header') {
                    $content .= $this->formatTemplate('dropdownMenuHeader', [
                        'content' => $value['title'],
                        'attrs' => $this->templater()->formatAttributes($value, ['title']),
                        'templateVars' => $value['templateVars'],
                    ]);
                }
                if ($key == 'item') {
                    if (isset($value['url'])) {
                        $value['title'] = $this->link($value['title'], $value['url']);
                    }
                    $content .= $this->formatTemplate('dropdownMenuItem', [
                        'content' => $value['title'],
                        'attrs' => $this->templater()->formatAttributes($value, ['title', 'url']),
                        'templateVars' => $value['templateVars'],
                    ]);
                }
            }
        }
        $options += [
            'align' => 'left',
            'templateVars' => [],
        ];
        $options = $this->addClass($options, 'dropdown-menu-' . $options['align']);

        return $this->formatTemplate('dropdownMenu', [
            'content' => $content,
            'attrs' => $this->templater()->formatAttributes($options, ['align']),
            'templateVars' => $options['templateVars'],
        ]);
    }

    /**
     * Create a formatted collection of elements while
     * maintaining proper bootstrappy markup. Useful when
     * displaying, for example, a list of products that would require
     * more than the maximum number of columns per row.
     *
     * @param int|string $breakIndex Divisible index that will trigger a new row
     * @param array $data Collection of data used to render each column
     * @param callable $determineContent A callback that will be called with the
     * data required to render an individual column
     * @return string
     * @deprecated 3.1.0
     */
    public function splicedRows($breakIndex, array $data, callable $determineContent)
    {
        $rowsHtml = '<div class="row">';

        $count = 1;
        foreach ($data as $index => $colData) {
            $rowsHtml .= $determineContent($colData);

            if ($count % $breakIndex === 0) {
                $rowsHtml .= '<div class="clearfix hidden-xs hidden-sm"></div>';
            }

            $count++;
        }

        $rowsHtml .= '</div>';

        return $rowsHtml;
    }
}
