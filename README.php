<?php

 $md = file('README.md');
 $hx = false;
 $hy = false;
 $h1 = false;
 $h2 = false;
 $h3 = false;
 $h4 = false;
 $h5 = false;
 $h6 = false;
 $ol = false;
 $ul = false;
 $lx = false;
 $inline_codeBlock = false;
 foreach($md as $i => $l) {
   if(substr($l, 0, 2) == "# ") {
     echo '<h1>';
     $h1 = true;
     $hx = true;
     $hy = true;
   }
   else if($h1) {
     echo '</h1>';
     $h1 = false;
     $hy = false;
   };
   if(substr($l, 0, 3) == "## ") {
     echo "<h2>";
     $h2 = true;
     $hx = true;
     $hy = true;
   }
   else if($h2) {
     echo "</h1>";
     $h2 = false;
     $hy = false;
   };
   if(substr($l, 0, 4) == "### ") {
     echo "<h3>";
     $h3 = true;
     $hx = true;
     $hy = true;
   }
   else if($h3) {
     echo "</h3>";
     $h3 = false;
     $hy = false;
   };
   if(substr($l, 0, 5) == "#### ") {
     echo "<h4>";
     $h4 = true;
     $hx = true;
     $hy = true;
   }
   else if($h4) {
     echo "</h4>";
     $h4 = false;
     $hy = false;
   };
   if(substr($l, 0, 6) == "##### ") {
     echo "<h5>";
     $h5 = true;
     $hx = true;
     $hy = true;
   }
   else if($h3) {
     echo "</h5>";
     $h5 = false;
     $hy = false;
   };
   if(substr($l, 0, 7) == "###### ") {
     echo "<h6>";
     $h6 = true;
     $hx = true;
     $hy = true;
   }
   else if($h6) {
     echo "</h6>";
     $h6 = false;
     $hy = false;
   };
   if($l == "\n") {
     continue;
   }
   if(substr($l, 0, 3) == " - ") {
     if(!$ul) {
       echo '<ul><li>';
       $ul = true;
     }
     else {
       echo '</li><li>';
     }
     $lx = true;
   }
   else if($ul) {
     echo '</li></ul>';
     $ul = false;
   };
   foreach(str_split($l) as $I => $c) {
     if($c == "`" and !$inline_codeBlock) {
       echo '<span class="inline_codeBlock">';
       $inline_codeBlock = true;
     }
     else if($c == "`" and $inline_codeBlock) {
       echo '</span>';
       $inline_codeBlock = false;
     }
     else if($hx) {
       if($c != "#") {
         $hx = false;
       }
     }
     else if($c == "\n" and !($hy or $ol or $ul)) echo '<br>';
     else if($c == "-" and $lx) $lx = false;
     else if($c == "<" and $inline_codeBlock) echo '&#x3C;';
     else if($c == ">" and $inline_codeBlock) echo '&#x3E;';
     else echo $c;
   }
 }

?>

<style>

  li {
    margin-bottom: 10px;
  }

  span.inline_codeBlock {
    display: inline-block;
    background-color: #c8c8c8;
    padding: 2px;
    border-radius: 2px;
    margin: 0;
  }
  
  h1 * {
    font-size: 2em;
  }
  h2 * {
    font-size: 1.5em;
  }
  h3 * {
    font-size: 1.17em;
  }
  h4 * {
    font-size: 1em;
  }
  h5 * {
    font-size: 0.83em;
  }
  h6 * {
    font-size: 0.67em;
  }

</style>
