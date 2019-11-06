<?php 
function showFormStart($page, $classes = '', $width = 12) {
    echo "<form method='post' class='container-fluid col-12 col-md-".$width." float-left ".$classes."'>
              <input type='hidden' name='page' value='".$page."'><br>";
}

function showFormInput($id, $label, $element, $type, $value, $pattern, $autofocus, $error, $has_label = true) {
    if ($type == 'password') $value = '';
    if ($element == 'textarea') {
        echo $has_label ? "<label class='d-block float-left my-1 col-6 col-md-4 clear-left' for='".$id."'>".$label."</label>" : "";
        echo "<textarea class='float-left my-1 col-6 col-md-4' id='".$id."' name='".$id."' type='".$type."' autofocus=".$autofocus.">".$value."</textarea>";
    } else {
        echo $has_label ? "<label class='d-block float-left my-1 col-6 col-md-4 clear-left' for='".$id."'>".$label."</label>": "";
        echo "<input class='float-left my-1 col-6 col-md-4' id='".$id."' name='".$id."' type='".$type."' value='".$value."' pattern='".$pattern."' autofocus=".$autofocus."/>";
    }
    if (!empty($error)) echo "<span class='float-left text-danger col-4 clear-left clear-md-none my-1'>".$error."</span>";
}

function showFormEnd($class, $value) {
    echo "<div class='col-12 col-md-8 float-left clear-left px-0'><input type='submit' class='".$class."' value='".$value."'></div></form>";
}