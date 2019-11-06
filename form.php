<?php 
function showFormStart($page) {
    echo "
    <form method='post'>
        <input type='hidden' name='page' value='".$page."'>
        <div id='form'>";
}

function showFormInput($id, $label, $element, $type, $value, $pattern, $autofocus = false, $error) {
    if ($element == 'textarea') {
        echo "<label for='".$id."'>".$label."</label><".$element." id='".$id."' name='".$id."' type='".$type."' pattern='".$pattern."' autofocus=".$autofocus.">".$value."</textarea>";
    } else {
        echo "<label for='".$id."'>".$label."</label><".$element." id='".$id."' name='".$id."' type='".$type."' value='".$value."' pattern='".$pattern."' autofocus=".$autofocus."/>";
    }
    if ($error != '') echo "<strong id='warning'>".$error."</strong>";
}

function showFormEnd() {
    echo "
              <input type='submit' id='submit'>
        </div>
    </from>";
}