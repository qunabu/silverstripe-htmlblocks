<?php
/**
 * Created by PhpStorm.
 * User: qunabu
 * Date: 25.01.16
 * Time: 10:49
 */

class HTMLBlock extends DataObject {
  static $singular_name = 'HTMLBlock';
  static $plural_name = 'HTMLBlocks';
  static $summary_fields = array(
    'ID','CodeID','Code','HTML.Summary'
  );
  static $db = array(
    'CodeID'=>'Varchar',
    'HTML'=>'HTMLText'
  );
  public function getCode() {
    return '{$HTMLBlock('."'$this->CodeID'".')}';
  }
  public static function getBlockByID($id){
    /** TODO add caching  */
    return DataObject::get_one('HTMLBlock', "CodeID = '$id'");
  }
  public function forTemplate() {
    return $this->HTML;
  }
}