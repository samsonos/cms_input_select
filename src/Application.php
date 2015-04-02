<?php
/**
 * Created by Maxim Omelchenko <omelchenko@samsonos.com>
 * on 31.03.2015 at 19:19
 */

namespace samsoncms\input\select;

/**
 * SamsonCMS select input module
 * @author Maxim Omelchenko <omelchenko@samsonos.com>
 */
class Application extends \samsoncms\input\Application
{
    /** @var int Field type number */
    public static $type = 4;

    /** @var string SamsonCMS field class */
    protected $fieldClass = '\samsoncms\input\select\Select';

    public function build($string = '', $groupSeparator = ',', $viewSeparator = ':')
    {
        $this->field->build($string, $groupSeparator, $viewSeparator);
        return $this;
    }
}
