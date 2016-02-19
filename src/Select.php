<?php
namespace samsoncms\input\select;

use samsoncms\input\Field;

/**
 * Select SamsonCMS input field
 * @author Vitaly Iegorov<egorov@samsonos.com>
 * @author Max Omelchenko <omelchenko@samsonos.com>
 */
class Select extends Field
{
    /** Special CSS classname for nested field objects to bind JS and CSS */
    protected $cssClass = '__select';

    /** @var array Select options */
    protected $options = array();

    /** @var string Select options HTML */
    protected $optionsHTML = '';

    /**
     * Parse string into select options
     *
     * @param string $string 			Input string
     * @param string $groupSeparator 	Separator string for groups
     * @param string $viewSeparator	Separator string for view/value
     * @return Select Chaining
     */
    public function build($string = '', $groupSeparator = ',', $viewSeparator = ':')
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

        // Generate options html
        $optionsHTML = '';
        foreach ($this->options as $k => $v) {
            $optionsHTML .= '<option value="' . $k . '"' .
                ($v == $this->value() ? ' selected' : '') . '>' . $v . '</option>';
        }
        // Save select HTML
        $this->optionsHTML = $optionsHTML;

//        // Chaining
//        return $this;
    }

    /** {@inheritdoc} */
    public function value()
    {
        // Transform field value to normal view
        return isset($this->options[$this->value]) ? $this->options[$this->value] : $this->value;
    }

    /** {@inheritdoc} */
    public function viewField($renderer)
    {
        return $renderer->view($this->fieldView)
            ->set($this->value(), 'value')
            ->set('field_' . $this->dbObject->id, 'fieldId')
            ->set($this->optionsHTML, 'options')
            ->output();
    }
}
