<?php
/**
 * Created by PhpStorm.
 * User: qunabu
 * Date: 25.01.16
 * Time: 10:49
 */

class HTMLBlockPageExtension extends DataExtension {

  public function HTMLBlock($id) {
    return HTMLBlock::getBlockByID($id);
  }

  public function HTMLBlockExist($id) {
    return HTMLBlock::doesExists($id);
  }
}