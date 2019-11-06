<?php 
function showBodySection($data) {
    echo '    <body>';
    showHeader($data['page']);
    showMenu();
    showContent($data);
    showFooter();
    echo '    </body>';
}

function showHeader($page){
    echo '
    <header>
        <h1>'.$page.'</h1>
    </header>';
}

function showMenu() {
    echo '
    <nav>
        <ul>
            <li class=\'menu-item\'><a href=\'index.php?page=home\'>HOME</a></li>
            <li class=\'menu-item\'><a href=\'index.php?page=about\'>ABOUT</a></li>
            <li class=\'menu-item\'><a href=\'index.php?page=contact\'>CONTACT</a></li>
        <ul>
    </nav>
    <br>
    <br>
    <br>
    <br>';
}

function showContent($data) {
    switch ($data['page']) {
        case 'home':
            showHomeContent();
            break;
        case 'about':
            showAboutContent();
            break;
        case 'contact':
            showContactContent($data);
            break;
        default:
            showError('Page ['.$data['page'].' not found.');
            break;
    }
}

function showFooter() {
    echo '    <footer>&copy;2019 dvg</footer>';
}

function showHomeContent() {
    echo '    <p>Hello hello home page</p>';
}

function showAboutContent() {
    echo '
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In eu neque consequat elit consectetur ultrices non tincidunt dui. Duis lobortis massa eu odio fermentum maximus. Cras nec congue massa. Quisque feugiat maximus justo eu scelerisque. Phasellus pellentesque cursus velit quis tempus. Proin nec neque non turpis gravida blandit in non leo. Ut pulvinar pellentesque orci eu tempus. Quisque consequat facilisis felis id vulputate. Aliquam lobortis non enim sed mattis. Sed fermentum odio eget finibus sodales. </p.
    <p>Nunc ultrices orci facilisis libero luctus, eu molestie urna vulputate. Quisque commodo sapien sem, sit amet varius ipsum maximus a. Praesent ac sem vitae quam tincidunt molestie sed in lectus. Mauris nec scelerisque nunc. Cras et odio condimentum, consectetur velit vel, scelerisque metus. Phasellus consequat aliquam nunc. Duis sit amet nibh elit. Duis accumsan nunc eu sem tincidunt sollicitudin. Sed dapibus orci sed urna laoreet, vel egestas orci sodales. </p>
    <p>Proin metus erat, semper posuere massa vitae, hendrerit vulputate arcu. In ac turpis nibh. Nam malesuada lacus rhoncus, pellentesque turpis id, ultrices justo. Curabitur odio purus, tempus nec odio at, tempus finibus quam. Duis ut nibh enim. Quisque laoreet mattis massa, quis auctor nibh viverra vel. 
	    <ul>
            <li>Hobby</li>
            <li>Hobby</li>
            <li>Hobby</li>
        </ul>
        Mauris in rhoncus lectus, in volutpat nulla. Ut finibus, nisi sed ultrices condimentum, eros quam ultrices sem, id dignissim ante ex ut tellus. Morbi pellentesque, lacus at condimentum ultricies, erat augue ullamcorper magna, a lobortis risus risus vitae enim. Morbi ultricies orci at volutpat egestas. Fusce blandit dolor sit amet pharetra blandit. Sed interdum aliquam eros a sollicitudin. Phasellus feugiat ipsum ex, vitae viverra arcu molestie et. </p> 
    <p>Nunc in fermentum sem. Sed non neque et est pretium cursus. Morbi luctus venenatis semper. Aliquam vel mi leo. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Quisque in aliquam quam. Praesent sit amet velit in ipsum aliquam rhoncus a at quam. </p>
    <p>Sed vel malesuada dui. Cras neque augue, condimentum in massa at, eleifend rhoncus tellus. Aliquam ornare dapibus augue a pretium. Curabitur scelerisque nulla quis mi tempus, ac malesuada turpis sollicitudin. Nam fermentum elementum diam, in tincidunt erat aliquam non. Sed semper erat imperdiet pellentesque aliquet. Phasellus a malesuada arcu, in pulvinar elit. Curabitur mattis erat ipsum, in fermentum nunc interdum non. Nam eget sem a odio finibus dignissim. Donec et ipsum interdum dolor porta blandit. Suspendisse libero turpis, fermentum a dolor non, pellentesque semper augue. Maecenas vitae consectetur tortor. </p>
    ';
}

function showContactContent($data) {
    if ($data['type'] == 'GET') {
        $name = isset($_GET['name']) ? $_GET['name'] : '';
        $email = isset($_GET['email']) ? $_GET['email'] : '';
        $message = isset($_GET['message']) ? $_GET['message'] : '';
    } else {
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $message = isset($_POST['message']) ? $_POST['message'] : '';
    }
    
    testInput($name);
    testInput($email);
    testInput($message);
    
    if ($name != '' && $email != '' && $message != '') {
        echo '<br>
        Information received! <br>
        Name: '.$name.'<br>
        Email: '.$email.'<br>
        Message: '.$message;
    } else {
        echo '<br>
    <form method=\'post\'>
        <input style=\'display:none\' name=\'page\' value=\''.$data["page"].'\'>
        
        <label for=\'name\'>Name </label><input id=\'name\' name=\'name\' type=\'text\' value=\''.$name.'\' autofocus><br>
        <label for=\'email\'>Email </label><input id=\'email\' name=\'email\' type=\'email\' value=\''.$email.'\'><br>
        <label for=\'message\'>Message </label><textarea id=\'message\' name=\'message\' pattern=\'[A-Za-z]\'>'.$message.'</textarea><br>
        <input type=\'submit\'><br>
    </form>';
    }
}

function showError($error) {
    echo $error;
}

function testInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
