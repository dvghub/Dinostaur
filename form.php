<?php 
function showFormStart($page) {
    echo "
    <form method='post'>
        <input type='hidden' name='page' value='".$page."'>";
}

function showFormInput($id, $label, $element, $type, $value, $pattern, $autofocus, $error) {
    if ($type == 'password') $value = '';
    if ($element == 'textarea') {
        echo "<label for='".$id."'>".$label."</label><textarea id='".$id."' name='".$id."' type='".$type."' pattern='".$pattern."' autofocus=".$autofocus.">".$value."</textarea>";
    } else {
        echo "<label for='".$id."'>".$label."</label><".$element." id='".$id."' name='".$id."' type='".$type."' value='".$value."' pattern='".$pattern."' autofocus=".$autofocus."/>";
    }
    if (!empty($error)) echo "<span id='warning'>".$error."</span>";
}

function showFormEnd($class, $value) {
    echo "
              <input type='submit' class='".$class."' value='".$value."'>
    </form>";
}