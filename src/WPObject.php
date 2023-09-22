<?php
namespace Cvy\Wp\Object;

/**
 * A base class for post/term/user wrapper classes.
 */
abstract class WPObject
{
  /**
   * ID of the wrapped object.
   *
   * @var int
   */
  protected $id;

  /**
   * @param int $id ID of the wrapped object.
   */
  public function __construct( int $id )
  {
    $this->id = $id;
  }

  /**
   * @return int ID of the wrapped object.
   */
  public function get_id() : int
  {
    return $this->id;
  }

  /**
   * @return object Wrapped original wordpress instance.
   */
  abstract public function get_original() : object;

  /**
   * @return string Post title / term name / user name.
   */
  abstract public function get_label() : string;

  /**
   * @param string $selector Meta key.
   * @return mixed|null Meta value (if found), null otherwise.
   */
  abstract public function get_meta( string $selector );

  /**
   * Updates meta.
   *
   * @param string $selector Meta key.
   * @param mixed $value New value.
   * @return void
   */
  abstract public function update_meta( string $selector, $value ) : void;

  /**
   * Delets meta.
   *
   * @param string $selector Meta key.
   * @return void
   */
  abstract public function delete_meta( string $selector ) : void;

  /**
   * @return string Value that must be passed to get_field() as an ID.
   */
  abstract protected function get_acf_id() : string;

  /**
   * @param string $selector ACF field selector.
   * @return mixed Value of the field.
   */
  public function get_acf( string $selector )
  {
    return get_field( $selector, $this->get_acf_id() );
  }

  /**
   * Updates ACF field.
   *
   * @param string $selector ACF field selector.
   * @param mixed $value New value.
   * @return void
   */
  public function update_acf( string $selector, $value ) : void
  {
    update_field( $selector, $value, $this->get_acf_id() );
  }
}