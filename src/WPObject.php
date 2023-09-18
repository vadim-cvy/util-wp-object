<?php
namespace Cvy\Wp\Object;

abstract class WPObject
{
  protected $id;

  public function __construct( int $id )
  {
    $this->id = $id;
  }

  public function get_id() : int
  {
    return $this->id;
  }

  abstract public function get_original() : object;

  abstract public function get_label() : string;

  abstract public function get_meta( string $selector );

  abstract public function update_meta( string $selector, $value ) : void;

  abstract public function delete_meta( string $selector ) : void;

  abstract protected function get_acf_id() : string;

  public function get_acf( string $selector )
  {
    return get_field( $selector, $this->get_acf_id() );
  }

  public function update_acf( string $selector, $value ) : void
  {
    update_field( $selector, $value, $this->get_acf_id() );
  }
}