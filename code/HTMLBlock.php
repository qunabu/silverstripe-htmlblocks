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
    'HTML'=>'HTMLText',
    'disableEditor'=>'Boolean'
  );
  static $defaults = array(
    'disableEditor' => true
  );
  public function getCode() {
    return '{$HTMLBlock('."'$this->CodeID'".')}';
  }
  public static function getBlockByID($id){
    $cache = SS_Cache::factory('HTMLBlocks');
    $cachekey = preg_replace("/[^a-z]/", "", $id);
    if (!($result = $cache->load($cachekey))) {
      $do = DataObject::get_one('HTMLBlock', "CodeID = '$id'");
      if ($do) {
        $result = $do->forTemplate();
        $cache->save($result, $cachekey);
      } else {
        return '<pre>No HTMLBlock in database for code <u>'.$id.'</u></pre>';
      }
    }
    if ($result) {
      return $result;
    } else {
      return '<pre>No HTMLBlock in database for code <u>'.$id.'</u></pre>';
    }
  }
  public function exists($id) {
    $block = DataObject::get_one('HTMLBlock', "CodeID = '$id'") ;
    return isset( $block );
  }
  public function forTemplate() {
    return DBField::create_field('HTMLText', $this->HTML)->forTemplate();
  }
  public function getCMSFields() {
    $fields = parent::getCMSFields();
    if ($this->disableEditor) {
      $tfa = new TextareaField('HTML');
      $tfa->setRows(30);
      $tfa->setColumns(150);
      $fields->addFieldToTab('Root.Main', $tfa);
    }
    return $fields;
  }
}