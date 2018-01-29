<?php

class Map {
  /* $table = [
   *   'encrypt' =>
   *     ['A' => 'A', 'B' => 'B', ...],
   *     ['A' => 'B', 'B' => 'C', ...],
   *     ...
   *   'decrypt' =>
   *     ['A' => 'A', 'B' => 'B', ...],
   *     ['B' => 'A', 'C' => 'B', ...],
   *     ...
   */
  protected $table;

  /* index of each character:
   * $index = ['A' => 0, 'B' => 1, ...]
   */
  protected $index;

  public function __construct() {
    $row = $keys = range('A', 'Z');
    $this->index = array_flip($keys);

    for ($i = 0; $i < count($keys); $i++) {
      $table = array_combine($keys, $row);

      $this->table['encrypt'][$i] = $table;
      $this->table['decrypt'][$i] = array_flip($table);

      array_push($row, array_shift($row));
    }
  }

  // remove non-alpha characters and convert to uppercase.
  public function clean($string) {
    return preg_replace('/[^A-Z]/', '', strtoupper($string));
  }

  // retrieve the index of a character.
  public function index($symbol) {
    return $this->index[$symbol];
  }

  // encode a character using the mapping table.
  public function encrypt($symbol, $shift) {
    return $this->table['encrypt'][$shift][$symbol];
  }

  // decode a character using the mapping table.
  public function decrypt($symbol, $shift) {
    return $this->table['decrypt'][$shift][$symbol];
  }
}

class Cipher {
  protected $map;

  public function __construct(Map $map) {
    $this->map = $map;
  }

  public function encrypt($string, $shift) {
    return $this->convert($string, $shift);
  }

  public function decrypt($string, $shift) {
    return $this->convert($string, $shift, $action = 'decrypt');
  }
}



class Vigenere extends Cipher {
  protected function convert($string, $keyword, $action = 'encrypt') {
    // prepare the input and the cipher key.
    $stream = $this->map->clean($string);
    $secret = $this->map->clean($keyword);
    $length = count($secret);

    // prepare the output.
    $output = '';

    for ($i = 0, $j = 0; $i < strlen($stream); $i++, $j++) {
      // calculate the shift by rotating the keyword.
      $shift = $this->map->index($secret[$j % $length]);

      // translate each character of the input stream.
      $output .= $this->map->$action($stream[$i], $shift);
    }

    return $output;
  }
}

// example:
echo "<style>body {font-family: monospace; word-break: break-all; white-space: pre;}</style>";

// plaintext.
$p = "Attack at dawn.";

// vigenere keyword.
$k = "LEMON";

// caesar shift.
$i = 3;

$m = new Map();



$v = new Vigenere($m);
$e2 = $v->encrypt($p, $k);
$d2 = $v->decrypt($e2, $k);



echo "<h3>vigenere</h3>";
echo "<p>keyword:   " . $k . "</p>";
echo "<p>plaintext: " . $p . "</p>";
echo "<p>encrypted: " . $e2 . "</p>";
echo "<p>decrypted: " . $d2 . "</p>";
