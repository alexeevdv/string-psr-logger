<?php

namespace alexeevdv\psr;

use Psr\Log\AbstractLogger;

/**
 * Class StringLogger
 * @package alexeevdv\psr
 */
class StringLogger extends AbstractLogger
{
    /**
     * @var string
     */
    private $_log;

    /**
     * @inheritdoc
     */
    public function log($level, $message, array $context = [])
    {
        if ($this->_log !== null) {
            $this->_log .= PHP_EOL;
        }
        $this->_log .= $this->formatMessage($message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     * @return string
     */
    protected function formatMessage($message, array $context = [])
    {
        // build a replacement array with braces around the context keys
        $replacements = [];
        foreach ($context as $key => $value) {
            // check that the value can be casted to string
            if (!is_array($value) && (!is_object($value) || method_exists($value, '__toString'))) {
                $replacements['{' . $key . '}'] = $value;
            }
        }

        // interpolate replacement values into the message and return
        return strtr($message, $replacements);
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->_log;
    }
}
