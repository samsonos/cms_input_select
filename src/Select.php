<?php
namespace samsoncms\input\select;

use samsoncms\input\Field;

/**
 * Select SamsonCMS input field
 * @author Vitaly Iegorov<egorov@samsonos.com>
 */
class Select extends Field
{
    /** @var  int Field type identifier */
    protected static $type = 4;

    /** @var string Module identifier */
    protected $id = 'samson_cms_input_select';

    /** Special CSS classname for nested field objects to bind JS and CSS */
    protected $cssClass = '__select';

    /** Select options */
    protected $options = '';

    /**
     * {@inheritdoc}
     */
    public static function create($dbObject, $type, $param = null, $className = __CLASS__)
    {
        /** @var self $selectField */
        $selectField = parent::create($dbObject, $type, $param, $className);
        return $selectField->optionsFromString();
    }

    /**
     * Parse string into select options
     *
     * @param string $string 			Input string
     * @param string $groupSeparator 	Separator string for groups
     * @param string $viewSeparator	Separator string for view/value
     * @return \samson\cms\input\Select Chaining
     */
    public function optionsFromString($string = '', $groupSeparator = ',', $viewSeparator = ':')
    {
        // Clear options data
        $this->options = array();

        // Split string into groups and iterate them
        foreach (explode($groupSeparator, $string) as $group) {
            // Split group into view -> value
            $group = explode($viewSeparator, $group);

            // Get value
            $value = $group[0];

            // Get view or set value
            $view = isset($group[1]) ? $group[1] : $group[0];

            // Add option
            $this->options[$value] = $view;
        }

        // Transform field value to normal view
        $this->value = isset($this->options[$this->value]) ? $this->options[$this->value] : $this->value;

        // Generate options html
        $htmlOptions = '';
        foreach ($this->options as $k => $v) {
            $htmlOptions .= '<option value="' . $k . '"' .
                ($v == $this->value ? ' selected' : '') . '>' . $v . '</option>';
        }
        $this->options = $htmlOptions;

        return $this;
    }
}
