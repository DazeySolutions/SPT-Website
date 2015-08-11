<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php View::getInstance()->requireAsset('javascript', 'jquery');

$navItems = $controller->getNavItems();

foreach ($navItems as $ni) {
    $classes = array();

    if ($ni->isCurrent) {
        //class for the page currently being viewed
        $classes[] = 'active';
    }

    if ($ni->inPath) {
        //class for parent items of the page currently being viewed
        $classes[] = 'active';
    }

    $ni->classes = implode(" ", $classes);
}


//*** Step 2 of 2: Output menu HTML ***/

echo '<ul class="nav navbar-nav">'; //opens the top-level menu

foreach ($navItems as $ni) {
    if ($ni->level === 1){
        echo '<li class="' . $ni->classes . '">'; //opens a nav item
        $name = (isset($translate) && $translate == true) ? t($ni->name) : $ni->name;
        echo '<a class="menu" href="' . $ni->url . '" target="' . $ni->target . '"><p>' . $name . '</p></a>';
        echo '</li>'; //closes a nav item
    }
}

echo '</ul>'; //closes the top-level menu
