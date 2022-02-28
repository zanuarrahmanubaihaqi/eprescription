<?php

class Pusher {

  private $pusher_key;
  private $app_secret;
  private $app_key;
  private $option;

  public function __construct() {
    $this->pusher_key = '1fcddf85bc59ebc811bb';
    $this->app_secret = '260a96ea117250675f53';
    $this->app_key = '854137';
  }
  $this->options = array(
      'cluster' => 'ap1',
      'useTLS' => true
  );
  $this->pusher = new Pusher(
      '', //ganti dengan App_key pusher Anda
      '', //ganti dengan App_secret pusher Anda
      '', //ganti dengan App_key pusher Anda
      $this->options
  );
}
 ?>
