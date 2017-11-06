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
    'ID','CodeID','Code','ShortCode','HTML.Summary'
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

  public function getShortCode() {
    return '{$HTMLBlock('."'$this->ID'".')}';
  }
    
  public static function getBlockByID($id){
    $cache = SS_Cache::factory('HTMLBlocks');
    //$cachekey = preg_replace("/[^a-z0-9]/", "", $id);
    $cachekey = md5($id);
    if (!($result = $cache->load($cachekey))) {
      $do = DataObject::get_one('HTMLBlock', "CodeID = '$id'");
      if ($do) {
        $result = $do->forTemplate();
        if ($result && is_string($result)) {
          $cache->save($result, $cachekey);
        } else {
          return '<pre>No HTMLBlock in database for code <u>'.$id.'</u></pre>';
        }
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
  public static function doesExists($id) {
    $block = DataObject::get_one('HTMLBlock', "CodeID = '$id'") ;
    return $block !== false;
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

  /**
     * Parse the shortcode and render as a string, probably with a template
     * @param array $attributes the list of attributes of the shortcode
     * @param string $content the shortcode content
     * @param ShortcodeParser $parser the ShortcodeParser instance
     * @param string $shortcode the raw shortcode being parsed
     * @return String
     **/
    public static function parse_shortcode($attributes, $content, $parser, $shortcode)
    {
      
        // check the gallery exists
        if (isset($attributes['id']) && $gallery = HTMLBlock::get()->byID($attributes['id'])) {
           return HTMLBlock::get()->byID($attributes['id'])->forTemplate();
        }

    }

    public function getShortcodableRecords() {
	    return HTMLBlock::get()->map()->toArray();
    }

    public function onAfterWrite() {
      $cache = SS_Cache::factory('HTMLBlocks');
      $cache->clean();
      $cachekey = md5($this->CodeID);
      parent::onAfterWrite();
    }

}
