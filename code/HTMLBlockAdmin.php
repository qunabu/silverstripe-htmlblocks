<?php
/**
 * Created by PhpStorm.
 * User: qunabu
 * Date: 25.01.16
 * Time: 10:49
 */

class HTMLBlockAdmin extends ModelAdmin {
  static $managed_models = array(
    'HTMLBlock'
  );
  static $url_segment = 'htmlblock';
  static $menu_title = 'HTML Blocks';
}