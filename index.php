<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Test</title>
    <link href="css/bootstrap.css" rel="stylesheet" />

<link href="css/bootstrap-theme.css" rel="stylesheet" />
<script src="js/bootstrap.min.js"></script>
  </head>
  <body  style="width:600px; height:300px; ">
    <div class="panel panel-info" style="width:600px; height:300px; ">

    <div class="panel-head" style="background-color:#583283;color:white;" >
      <h3><b>Kriptografi Menggunakan Vigenere</b></h3>

    </div>
    <div class="panel-body" style="background-color:#6920bc; color:white;">


      <form class="" action="index.php" method="post">
    Teks :<input name="huruf" type="Text">
    Kunci :<input name="kunci" type="Text">
    <input name="submit" value="Enkripsi" type="submit">

  </form>

  <form class="" action="index.php" method="post">
    Teks :<input name="huruf1" type="Text">
    Kunci :<input name="kunci1" type="Text">
    <input name="submit" value="Dekripsi" type="submit">

  </form>

    <?php
     if (isset($_POST['huruf']))
       {
       $p=$_POST['huruf'];
       $k=$_POST['kunci'];

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


       // plaintext.
       // $p = "Attack at dawn.";

       // vigenere keyword.
       // $k = "LEMON";

       // caesar shift.
       $i = 3;

       $m = new Map();



       $v = new Vigenere($m);
       $e2 = $v->encrypt($p, $k);
       $d2 = $v->decrypt($e2, $k);



       echo "<h3>Hasilnya</h3>";
       echo "<p>Kunci:   " . $k . "</p>";
       echo "<p>Plain Text: " . $p . "</p>";
       echo "<p> <b>Hasil Enkripsi: " . $e2 . "</b></p>";


       }
     else if(isset($_POST['huruf1'])) {


       $p=$_POST['huruf1'];
       $k=$_POST['kunci1'];

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


       // plaintext.
       // $p = "Attack at dawn.";

       // vigenere keyword.
       // $k = "LEMON";

       // caesar shift.
       $i = 3;

       $m = new Map();



       $v = new Vigenere($m);
       $e2 = $v->encrypt($p, $k);
       $d2 = $v->decrypt($p, $k);



       echo "<h3>vigenere</h3>";
       echo "<p>Kunci:   " . $k . "</p>";
       echo "<p>Teks Terenkripsi: " . $p . "</p>";
       echo "<p><b>Hasil Dekripsi: " . $d2 . "</b></p>";




     }


      ?>


    </div>

    <div class="panel-footer" style="background-color:#583283;color:white;">

      Tugas Kelompok 10
      Created By: Kami/Kita
      <div class="test" style="width:500px; height:100px;">

        <img style="width:100px; height:100px;" class="img-responsive" src="gambar.png" alt="Jesi Namora">

      </div>

    </div>
     </div>
  </body>
</html>
