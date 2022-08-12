<?php
function DateConverter($date) {
   $time = strtotime($date);
   return date("h:iA, M d, Y", $time);
}

function DefaultImg($p1, $p2, $p3, $p4, $d, $id, $size){
   if(file_exists("images/product/{$id}-1-{$size}.{$p1}") && $d == 1){
      return "images/product/{$id}-1-{$size}.{$p1}";
   }
   else if(file_exists("images/product/{$id}-2-{$size}.{$p2}") && $d == 2){
      return "images/product/{$id}-2-{$size}.{$p2}";
   }
   else if(file_exists("images/product/{$id}-3-{$size}.{$p3}") && $d == 3){
      return "images/product/{$id}-3-{$size}.{$p3}";
   }
   else if(file_exists("images/product/{$id}-4-{$size}.{$p4}") && $d == 4){
      return "images/product/{$id}-4-{$size}.{$p4}";
   }
   else if(file_exists("images/product/{$id}-1-{$size}.{$p1}")){
      return "images/product/{$id}-1-{$size}.{$p1}";
   }
   else if(file_exists("images/product/{$id}-2-{$size}.{$p2}")){
      return "images/product/{$id}-2-{$size}.{$p2}";
   }
   else if(file_exists("images/product/{$id}-3-{$size}.{$p3}")){
      return "images/product/{$id}-3-{$size}.{$p3}";
   }
   else if(file_exists("images/product/{$id}-4-{$size}.{$p4}")){
      return "images/product/{$id}-4-{$size}.{$p4}";
   }
   else{
      return "images/product/no-image.jpg";
   }
}

function Extension($field) {
   if ($_FILES[$field]['name'] != "") {
      $ext = pathinfo($_FILES[$field]['name']);
      $ext = strtolower($ext['extension']);
      if ($ext != "jpg" && $ext != "png" && $ext != "gif" && $ext != "jpeg") {
         return "";
      }
      else{
         return $ext;
      }
   }
   return "";
}

function Author($data) {
   if (strlen($data) > 100) {
      return $data;
   } else {
      return "Details coming soon...";
   }
}

function Status($data) {
   if ($data == 1) {
      return "Processing";
   } else if ($data == 2) {
      return "Complete";
   } else {
      return "Pending";
   }
}

function Data_Replace($data) {
   $engDATE = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
   $bangDATE = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০');
   return str_replace($engDATE, $bangDATE, $data);
}

function convert_number_to_words($number) {

   $hyphen = ' ';
   $conjunction = ' and ';
   $separator = ', ';
   $negative = 'negative ';
   $decimal = ' point ';
   $dictionary = array(
       0 => 'zero',
       1 => 'one',
       2 => 'two',
       3 => 'three',
       4 => 'four',
       5 => 'five',
       6 => 'six',
       7 => 'seven',
       8 => 'eight',
       9 => 'nine',
       10 => 'ten',
       11 => 'eleven',
       12 => 'twelve',
       13 => 'thirteen',
       14 => 'fourteen',
       15 => 'fifteen',
       16 => 'sixteen',
       17 => 'seventeen',
       18 => 'eighteen',
       19 => 'nineteen',
       20 => 'twenty',
       30 => 'thirty',
       40 => 'fourty',
       50 => 'fifty',
       60 => 'sixty',
       70 => 'seventy',
       80 => 'eighty',
       90 => 'ninety',
       100 => 'hundred',
       1000 => 'thousand',
       1000000 => 'million',
       1000000000 => 'billion',
       1000000000000 => 'trillion',
       1000000000000000 => 'quadrillion',
       1000000000000000000 => 'quintillion'
   );
   if (!is_numeric($number)) {
      return false;
   }

   if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
      // overflow
      trigger_error(
              'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING
      );
      return false;
   }

   if ($number < 0) {
      return $negative . convert_number_to_words(abs($number));
   }

   $string = $fraction = null;

   if (strpos($number, '.') !== false) {
      list($number, $fraction) = explode('.', $number);
   }


   return $string;
}


function TitleCut($data) {
   $dt = $data;
   $i = strpos($data, "(");
   if ($data !== FALSE) {
      $data = substr($data, $i + 1);
      $i = strripos($data, ")");
      $data = trim(substr($data, 0, $i));
   }
   if ($data == "") {
      return $dt;
   }
   return $data;
}

function Discount($dis, $dis1, $dis2, $dis3, $dis4) {
   if ($dis1 > 0) {
      echo "<div class='label_offer percentage details_discount'><div>" . round($dis1) . "%</div>OFF</div>";
   } else if ($dis2 > 0) {
      echo "<div class='label_offer percentage details_discount'><div>" . round($dis2) . "%</div>OFF</div>";
   } else if ($dis3 > 0) {
      echo "<div class='label_offer percentage details_discount'><div>" . round($dis3) . "%</div>OFF</div>";
   } else if ($dis4 > 0) {
      echo "<div class='label_offer percentage details_discount'><div>" . round($dis4) . "%</div>OFF</div>";
   } else if ($dis > 0) {
      echo "<div class='label_offer percentage details_discount'><div>" . round($dis) . "%</div>OFF</div>";
   }
}

function Discount1($dis, $dis1, $dis2, $dis3, $dis4, $conversion) {
   if ($conversion > 0) {
      return "";
   } else if ($dis1 > 0) {
      return "<div class='label_offer percentage'><div>" . round($dis1) . "%</div>OFF</div>";
   } else if ($dis2 > 0) {
      return "<div class='label_offer percentage'><div>" . round($dis2) . "%</div>OFF</div>";
   } else if ($dis3 > 0) {
      return "<div class='label_offer percentage'><div>" . round($dis3) . "%</div>OFF</div>";
   } else if ($dis4 > 0) {
      return "<div class='label_offer percentage'><div>" . round($dis4) . "%</div>OFF</div>";
   } else if ($dis > 0) {
      return "<div class='label_offer percentage'><div>" . round($dis) . "%</div>OFF</div>";
   }
}

function Discount2($dis, $dis1, $dis2, $dis3, $dis4, $price, $conversion) {
   if ($conversion > 0) {
      return "";
   } else if ($dis1 > 0) {
      return "<s>৳ " . Calc($price, 0) . "</s>&nbsp;&nbsp;&nbsp;&nbsp;";
   } else if ($dis2 > 0) {
      return "<s>৳ " . Calc($price, 0) . "</s>&nbsp;&nbsp;&nbsp;&nbsp;";
   } else if ($dis3 > 0) {
      return "<s>৳ " . Calc($price, 0) . "</s>&nbsp;&nbsp;&nbsp;&nbsp;";
   } else if ($dis4 > 0) {
      return "<s>৳ " . Calc($price, 0) . "</s>&nbsp;&nbsp;&nbsp;&nbsp;";
   } else if ($dis > 0) {
      return "<s>৳ " . Calc($price, 0) . "</s>&nbsp;&nbsp;&nbsp;&nbsp;";
   }
}

function Discount3($dis, $dis1, $dis2, $dis3, $dis4, $price, $conversion) {
   if ($conversion > 0) {
      return "<b>৳ " . round($price * $conversion) . "</b>";
   } else if ($dis1 > 0) {
      return "<b>৳ " . Calc($price, $dis1) . "</b>";
   } else if ($dis2 > 0) {
      return "<b>৳ " . Calc($price, $dis2) . "</b>";
   } else if ($dis3 > 0) {
      return "<b>৳ " . Calc($price, $dis3) . "</b>";
   } else if ($dis4 > 0) {
      return "<b>৳ " . Calc($price, $dis4) . "</b>";
   } else {
      return "<b>৳ " . Calc($price, $dis) . "</b>";
   }
}

function RandStr($num) {
   $arr = array_merge(range("A", "Z"), range("a", "z"), range("0", "9"));
   $str = "";
   for ($i = 1; $i <= $num; $i++) {
      $str .= $arr[rand(0, count($arr) - 1)];
   }
   return $str;
}

function Calc($price, $dis) {
   $price = $price - ($price * $dis) / 100;
   return round($price);
}

function Picture_Extension($data) {
   if ($data['name'] != "") {
      $ext = pathinfo($data['name']);
      $ext = strtolower($ext['extension']);
      if ($ext != "jpg" && $ext != "jpeg" && $ext != "png" && $ext != "gif") {
         return "";
      }
      return $ext;
   }
   return "";
}

function Replace($data) {
   $data = trim($data);
   $data = str_replace("'", "", $data);
   $data = str_replace("!", "", $data);
   $data = str_replace("@", "", $data);
   $data = str_replace("#", "", $data);
   $data = str_replace("$", "", $data);
   $data = str_replace("%", "", $data);
   $data = str_replace("^", "", $data);
   $data = str_replace("&", "", $data);
   $data = str_replace("*", "", $data);
   $data = str_replace("(", "", $data);
   $data = str_replace(")", "", $data);
   $data = str_replace("+", "", $data);
   $data = str_replace("=", "", $data);
   $data = str_replace(",", "", $data);
   $data = str_replace(":", "", $data);
   $data = str_replace(";", "", $data);
   $data = str_replace("|", "", $data);
   $data = str_replace("'", "", $data);
   $data = str_replace('"', "", $data);
   $data = str_replace("?", "", $data);
   $data = str_replace("'", "", $data);
   $data = str_replace(".", "-", $data);
   $data = str_replace("অ", "�", $data); //Only Onubad
   $data = strtolower(str_replace("  ", "-", $data));
   $data = strtolower(str_replace(" ", "-", $data));
   $data = strtolower(str_replace("__", "-", $data));
   $data = strtolower(str_replace("_", "-", $data));
   $data = strtolower(str_replace("--", "-", $data));

   return $data;
}

function filter($data) {
   return xss_clean(trim(strip_tags($data)));
}



function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>
