<?php

namespace Akuren\Validator;

/**
 * Class Validator
 * @package Framework
 */
class Validator
{
    
    /**
     * @var array
     */
    private $params;
    /**
     * @var string[]
     */
    private $errors;
    
    /**
     * Validator constructor.
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->params = $params;
    }
    
    /**
     * @param string[] $keys
     * @return Validator
     */
    public function required(string ...$keys): self
    {
        foreach ($keys as $key) {
            if (!array_key_exists($key, $this->params)) {
                $this->addError($key, 'required');
            }
        }
        return $this;
    }
    
    /**
     * @param string $key
     * @return Validator
     */
    public function slug(string $key): self
    {
        $pattern = '/^[a-z0-9\-]+$/';
        $value = $this->getValue($key);
        if (is_null($value) || !preg_match($pattern, $value)) {
            $this->addError($key, 'slug');
        }
        return $this;
    }
    
    public function username(string $key): self
    {
        $pattern = '/^[a-zA-Z0-9_]+$/';
        $value = $this->getValue($key);
        if (is_null($value) || !preg_match($pattern, $value)) {
            $this->addError($key, 'username');
        }
        return $this;
    }
    
    public function isNumber(string $key, int $length): self
    {
        $pattern = '/^[0-9-]+$/';
        $value = $this->getValue($key);
        if (is_null($value) || !preg_match($pattern, $value) || $length < 8) {
            $this->addError($key, 'number');
        }
        return $this;
    }
    
    /**
     * @param string ...$keys
     * @return Validator
     */
    public function notEmpty(string  ...$keys): self
    {
        foreach ($keys as $key) {
            $value = $this->getValue($key);
            if (is_null($value) || empty($value)) {
                $this->addError($key, 'empty');
            }
        }
        return $this;
    }
    
    /**
     * @param string $key
     * @param int|null $min
     * @param int|null $max
     * @return Validator
     */
    public function length(string $key, ?int $min, ?int $max = null): self
    {
        $value = $this->getValue($key);
        $length = mb_strlen($value);
        if (!is_null($min) && !is_null($max) && ($length < $min || $length > $max)) {
            $this->addError($key, 'betweenLength', [$min, $max]);
            return $this;
        }
        if (!is_null($min) && $length < $min) {
            $this->addError($key, 'minLength', [$min]);
            return $this;
        }
        if (!is_null($max) && $length > $max) {
            $this->addError($key, 'maxLength', [$max]);
        }
        return $this;
    }
    
    /**
     * @param string $key
     * @param string $format
     * @return Validator
     */
    public function dateTime(string $key, string $format = "Y-m-d H:i:s"): self
    {
        $value = $this->getValue($key);
        $date = \DateTime::createFromFormat($format, $value);
        $errors = \DateTime::getLastErrors();
        if ($errors['error_count'] > 0 || $errors['warning_count'] || $date === false) {
            $this->addError($key, 'datetime', [$format]);
        }
        return $this;
    }
    
    public function password(string $key, ?int $length): self
    {
        $value = $this->getValue($key);
        if (strlen($value) < $length) {
            $this->addError($key, 'paawordLength', [$length]);
            return $this;
        }
        return $this;
        
    }
    
    public function isEmail(string $key): self
    {
        $value = $this->getValue($key);
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError($key, 'email');
        }
        return $this;
    }
    
    /**
     * @param string $key
     * @param string $rule
     * @param array $attributes
     */
    private function addError(string $key, string $rule, array $attributes = []): void
    {
        $this->errors[$key] = new ValidationErrors($key, $rule, $attributes);
    }
    
    /**
     * @return array | null
     */
    public function getErrors()
    {
        return $this->errors;
    }
    
    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return empty($this->getErrors());
    }
    
    /**
     * @param string $key
     * @return mixed|null
     */
    private function getValue(string $key)
    {
        if (array_key_exists($key, $this->params)) {
            return $this->params[$key];
        }
        return null;
    }
}
