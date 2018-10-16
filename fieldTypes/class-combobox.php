<?php

class combobox extends field_type
{

    public function __construct($name, $args = array())
    {
        parent::__construct($name, $args);
        $this->ver = 1.0;
        $this->basic = true;
        $this->ftype = 'combobox';
        $this->flabel = __('Combo Box', XYDAC_CMS_NAME);
        $this->compaitable = array('pagetype', 'posttype', 'taxonomy', 'forms');
    }
    public static function get_combobox_input($args = array(), $value = false, $pre_arr = false, $create_old = false)
    {

        extract($args);
        $r = '';
        if (isset($tabular) && $tabular) {
            $r .= '<tr class="form-field"><th scope="row" valign="top">';
        }
        $r .= '<label for="' . $name . '">' . $label . '</label>';
        if (isset($tabular) && $tabular) {
            $r .= '</th><td>';
        }
        $r .= '<div class="xydac-custom-meta">';
        if ($pre_arr) {
            $r .= '<select name="' . $pre_arr . '[' . $name . ']' . '" id="' . $name . '" >';
            foreach ($options as $key => $option) {
                if (htmlentities($value, ENT_QUOTES) == $key) {
                    $r .= '<option selected="selected" value="' . $key . '">' . $option . '</option>';
                } else {
                    $r .= '<option value="' . $key . '">' . $option . '</option>';
                }
            }

            $r .= '</select>';
        } else {
            $r .= '<select name="' . $name . '" id="' . $name . '" >';
            foreach ($options as $key => $option) {
                if (htmlentities($value, ENT_QUOTES) == $key) {
                    $r .= '<option selected="selected" value="' . $key . '">' . $option . '</option>';
                } else {
                    $r .= '<option value="' . $key . '">' . $option . '</option>';
                }
            }

            $r .= '</select>';
        }
        if ($create_old) {
            $r .= '<input type="hidden" name="' . $name . '-old" value="' . esc_html($value, 1) . '" />';
        }

        if (isset($desc) && strlen($desc) > 0) {
            $r .= '<a class="xydactooltip" href="#" ><span style="width: 180px;" class="info ' . $name . '">' . $desc . '</span></a>';
        }

        $r .= '</div>';
        $r .= '<div rel="' . $name . '" class="clear"></div>';
        if (isset($tabular) && $tabular) {
            $r .= '</td></tr>';
        }
        return $r;
    }
    public function get_input($no = 'false', $val = false, $tabular = false)
    {
        if (is_string($no)) {
            $no = substr(uniqid(), 0, 8);
        }

        return self::get_combobox_input(array('name' => $this->name . "-" . $no, 'tabular' => $tabular, 'label' => $this->label, 'desc' => $this->desc, 'options' => $this->get_options()), $val, "xydac_custom", true);
    }

}
