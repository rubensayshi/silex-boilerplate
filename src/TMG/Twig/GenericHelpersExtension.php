<?php

namespace TMG\Twig;

class GenericHelpersExtension extends \Twig_Extension {
    public function getFilters() {
        return array(
            'ceil' => new \Twig_Filter_Method($this, 'ceil'),
            'floor' => new \Twig_Filter_Method($this, 'floor'),
            'slugify' => new \Twig_Filter_Method($this, 'slugify'),
        );
    }

    public function slugify($str) {
        $str = preg_replace('/^\s+|\s+$/', '', $str);
        $str = strtolower($str);

        $str = str_replace(str_split('ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;'), str_split('aaaaaeeeeeiiiiooooouuuunc------'), $str);

        $str = preg_replace('/[^a-z0-9 -]/', '', $str);
        $str = preg_replace('/\s+/', '-', $str);
        $str = preg_replace('/-+/', '-', $str);
        $str = preg_replace('/-+$/', '', $str);

        return $str;
    }

    public function floor($num) {
        return floor($num);
    }

    public function ceil($num) {
        return ceil($num);
    }

    public function getName() {
        return 'generic_helpers';
    }
}
