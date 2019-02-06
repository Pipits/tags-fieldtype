<?php
/**
 * A field type for adding tags.
 * 
 * @author Hussein Al Hammad
 * 
 */
class PerchFieldType_tags extends PerchAPI_FieldType {
    public function render_inputs($details=array()) {
        $id  = $this->Tag->input_id();
        $val = '';
        
        if (isset($details[$id]) && $details[$id]!='') {
            $val = $details[$id];
        }        
        
        
        $classes= 'text m input-simple';
        $attributes = ' data-pipit-tagify="true"';
        
        if ($this->Tag->max()) {
			$attributes .= ' data-max="'.(int)$this->Tag->max().'"';
        }

        if ($this->Tag->blacklist()) {
            $attributes .= ' data-blacklist="'.$this->Tag->blacklist().'"';
        }

        if ($this->Tag->placeholder()) {
            $attributes .= ' placeholder="'.$this->Tag->placeholder().'"';
        }
        
        
        $attributes = trim($attributes);
        $s = $this->Form->text($id, $val, $classes, true, 'text', $attributes);
        
        return $s;
    }
       




    public function get_raw($post=false, $Item=false) {
        $tag_values = array();
        $store = '';

        $id = $this->Tag->id();

        if ($post===false) {
            $post = $_POST;
        }
        
        if (isset($post[$id])) {
            $json_tags = $post[$id];
            $tags = json_decode($json_tags, true);
            $this->raw_item = $tags;
            
            if(is_array($tags)) {
                foreach($tags as $tag) {
                    $tag_values[] = $tag['value'];
                }
                $store = implode(',', $tag_values);
            }
        }

        return $store;
    }


    


    public function get_processed($raw=false) {    
        if ($raw===false) {
            $raw = $this->get_raw();
        }
        
        $value = $raw;

        if (is_array($value)) {
            return implode(',', $value);
        }
        
        return $value;
    }
    




    public function get_search_text($raw=false) {
        if ($raw===false) {
            $raw = $this->get_raw();
        }
        
        $value = $raw;

        if (is_array($value)) {
            return implode(', ', $value);
        }

		return $value;
    }

    



    public function render_admin_listing($raw=false)
    {
        if ($raw===false) {
            $raw = $this->get_raw();
        }
        
        $value = $raw;

        if (is_array($value)) {
            return implode(', ', $value);
        } else {
            return str_replace(',', ', ', $value);
        }

		return $value;
    }





    public function get_content_summary($details=array(), $Template)
    {
        if (!PerchUtil::count($details)) return '';

        $id  = $this->Tag->input_id();
        $val = '';
        
        if (isset($details[$id]) && $details[$id]!='') {
            $val = $details[$id];
        }        

        return PerchUtil::html($val, true);
    }





    public function add_page_resources()
    {
        $Perch = Perch::fetch();
        $Perch->add_css(PERCH_LOGINPATH . "/addons/fieldtypes/tags/assets/vendor/tagify/tagify.css");
        $Perch->add_javascript(PERCH_LOGINPATH . "/addons/fieldtypes/tags/assets/vendor/tagify/tagify.min.js");
        $Perch->add_javascript(PERCH_LOGINPATH . "/addons/fieldtypes/tags/assets/js/app.js");
    }

}