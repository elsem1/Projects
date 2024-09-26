<?php 


Class Validator {
    protected $data;
    protected $rules = [];
    protected $errors = [];
    protected $currentField;

    public function __construct($data) {
        $this->data = $data;
    }

    public function field($field) {
        $this->currentField = $field;
        if (!isset($this->rules[$field])) {
            $this->rules[$field] = [];
        }
        return $this;
    }

    public function required() {
        $this->rules[$this->currentField]['required'] = true;
        return $this; 
    }

    public function alpha($allowedChars = []) {
        $this->rules[$this->currentField]['alpha'] = $allowedChars;
        return $this;
    }

    public function numeric() {
        $this->rules[$this->currentField]['numeric'] = true;
        return $this;
    }

    public function min_val($value) {
        $this->rules[$this->currentField]['min_val'] = $value;
        return $this;
    }

    public function max_val($value) {
        $this->rules[$this->currentField]['max_val'] = $value;
        return $this;
    }

    public function min_len($length) {
        $this->rules[$this->currentField]['min_len'] = $length;
        return $this;
    }

    public function max_len($length) {
        $this->rules[$this->currentField]['max_len'] = $length;
        return $this;
    }

    public function preg_match($pattern) {
        $this->rules[$this->currentField]['preg_match'] = $pattern;
        return $this;
    }

    public function validate() {
        foreach ($this->rules as $field => $rules) {
            $value = $this->data[$field] ?? null;


            if (isset($rules['required']) && (empty($value) && $value !== '0')) {
                $this->errors[$field][] = 'Vul dit veld in';
                continue;
            }

            if (isset($rules['alpha'])) {
                $pattern = $rules['alpha'];
                if (!preg_match($pattern, $value)) {
                    $this->errors[$field][] = 'Gebruik alleen letters';
                }
            }

            
            if (isset($rules['numeric']) && !is_numeric($value)) {
                $this->errors[$field][] = 'Vul een cijfer';
            }

            
            if (isset($rules['min_val']) && $value < $rules['min_val']) {
                $this->errors[$field][] = 'Het aantal moet minimaal ' . $rules['min_val'] . ' zijn';
            }

            
            if (isset($rules['max_val']) && $value > $rules['max_val']) {
                $this->errors[$field][] = 'Het aantal mag maximaal ' . $rules['max_val'] . ' zijn';
            }

            
            if (isset($rules['min_len']) && strlen($value) < $rules['min_len']) {
                $this->errors[$field][] = 'Voer minimaal ' . $rules['min_len'] . ' cijfers in';
            }

            
            if (isset($rules['max_len']) && strlen($value) > $rules['max_len']) {
                $this->errors[$field][] = 'Voer maximaal ' . $rules['max_len'] . ' cijfers in';
            }

            
            if (isset($rules['preg_match']) && !preg_match($rules['preg_match'], $value)) {
                $this->errors[$field][] = 'Voer een geldige prijs in';
            }
        }

        return empty($this->errors);
    }

    public function errors() {
        return $this->errors;
    }
}




?>