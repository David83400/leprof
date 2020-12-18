<?php

namespace LeProf\Core;

class Form
{
    private $formCode = '';

    /**
     * Generate the html form
     *
     * @return string
     */
    public function create()
    {
        return $this->formCode;
    }

    /**
     * Validate if all ranges are filled
     * @param array $form
     * @param array $ranges
     * @return bool
     */
    public static function validate(array $form, array $ranges)
    {
        foreach($ranges as $range){
            if(!isset($form[$range]) || empty($form[$range])){
                return false;
            }
        }
        return true;
    }

    /**
     * adds the attributes sent to the tag
     *
     * @param array
     * @return string
     */
    private function addAttributes(array $attributes): string
    {
        // We initialize a string
        $str = '';

        // We list the shorts attributes
        $shorts = ['checked', 'disabled', 'readonly', 'multiple', 'required', 'autofocus', 'novalidate', 'formnovalidate', 'selected'];
        
        foreach($attributes as $attribute => $value){
            // If the attribute is in the shorts attributes list
            if(in_array($attribute, $shorts) && $value == true){
                // we add a space in the string 
                $str .= " $attribute";
            }else{
                // We add attribute='value'
                $str .= " $attribute=\"$value\"";
            }
        }
        return $str;
    }

    /**
     * Form open tag
     * @param string $action
     * @param string $method
     * @param array $attributes
     * @return self
     */
    public function initForm(string $action = '#', string $method = 'post', array $attributes = []): self
    {
        // We create the form tag
        $this->formCode .= "<form action='$action' method='$method'";

        // Add any attributes
        $this->formCode .= $attributes ? $this->addAttributes($attributes).'>' : '>';

        return $this;
    }

    /**
     * Form close tag
     *
     * @return Form
     */
    public function endForm(): self
    {
        $this->formCode .= '</form>';
        return $this;
    }

    /**
     * Add a label
     * @param string $for
     * @param string $text
     * @param array $attributes
     * @return self
     */
    public function addLabelFor(string $for, string $text, array $attributes = []): self
    {
        // We open label tag
        $this->formCode .= "<label for='$for'";

        // We add any attributes
        $this->formCode .= $attributes ? $this->addAttributes($attributes) : '';

        // We add text
        $this->formCode .= ">$text</label>";

        return $this;
    }

    /**
     * Add an input
     *
     * @param string $type
     * @param string $name
     * @param array $attributes
     * @return self
     */
    public function addInput(string $type, string $name, array $attributes = []): self
    {
        // We open input tag
        $this->formCode .= "<input type='$type' name='$name'";

        // We add any attributes
        $this->formCode .= $attributes ? $this->addAttributes($attributes).'>' : '>';

        return $this;
    }

    /**
     * Add a textarea
     *
     * @param string $name
     * @param string $value
     * @param array $attributes
     * @return self
     */
    public function addTextarea(string $name, string $value = '', array $attributes = []): self
    {
        $this->formCode .= "<textarea name='$name'";

        $this->formCode .= $attributes ? $this->addAttributes($attributes) : '';

        $this->formCode .= ">$value</textarea>";

        return $this;
    }

    /**
     * Add a select
     *
     * @param string $name
     * @param array $options
     * @param array $attributes
     * @return self
     */
    public function addSelect(string $name, array $options, array $attributes = []): self
    {
        $this->formCode .= "<select name='$name'";

        $this->formCode .= $attributes ? $this->addAttributes($attributes).'>' : '>';

        // We add options
        foreach($options as $value => $text){
            $this->formCode .= "<option value=\"$value\">$text</option>";
        }

        $this->formCode .= "</select>";

        return $this;
    }

    /**
     * Add a button
     *
     * @param string $text
     * @param array $attributes
     * @return self
     */
    public function addButton(string $text, array $attributes = []): self
    {
        $this->formCode .= '<button';

        $this->formCode .= $attributes ? $this->addAttributes($attributes) : '';

        $this->formCode .= ">$text</button>";

        return $this;
    }
}