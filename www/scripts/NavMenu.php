<?php
class NavMenu extends Singleton
{
    private static $items = null;

    protected function __construct()
    {
        if (self::$items === null) {
            self::$items = [
                new MenuItem("Home", "index.php",UserLevel::Anon, "only"),
                new MenuItem("About", "about.php",UserLevel::Anon, "only"),
                new MenuItem("Contact", "contact.php",UserLevel::Anon, "only"),
                new MenuItem("FAQ", "faq.php",UserLevel::Anon, "only"),
                 new MenuItem("MemberHome", "memberHome.php", UserLevel::Member),
                new MenuItem("Assessments", "assessments.php",UserLevel::Member),
                new MenuItem("Register", "register.php", UserLevel::Anon, "only"),
                new MenuItem("Profile", "profile.php", UserLevel::Member),
                new MenuItem("Logout", "logout.php", UserLevel::Member)
            ];
        }
    }

    public static function Build($user)
    {
        //printr($user);
        $plevel = $user ? $user->AccessLevel : 0;
        //echo "blah: " .$plevel;
        self::instance()->buildMenu($plevel);
    }

    private function buildMenu($plevel = 0)
    {
        //$q = QueryFactory::Build("select")->Select("name","page")->From("menu")->Where(["pLevel","<=",$plevel]);
        //$items = DatabaseManager::Query($q);


        $output = "<ul>";
        foreach (self::$items as $item) {
            if ($item->priv == $plevel || ($item->priv < $plevel && $item->mode == "all"))
                $output .= $this->buildItem($item);
        }
        $output .= "</ul>";

        echo $output;
    }

    private function buildItem($item)
    {
        return '<li><a href="' . $item->page . '">' . $item->name . '</a></li>';
    }
}

/*
      <ul>
        <li><a href="index.php">Home</a></li>
        <?php if($user){?>
		<li><a href="profile.php">Profile</a></li>
		<li><a href="parQ.php">ParQ Form</a></li>
        <li><a href="logout.php">Logout</a></li>
		<?php if($user->HasPrivilege(10)) echo '<li><a href="admin.php">Admin</a>\n';?>
        <?php }else{ ?>
		<li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
		<li><a href="faq.php">FAQ</a></li>
        <li><a href="assessments.php">Assessments</a></li>
        <li><a href="register.php">Register</a></li>
        <?php } ?>
      </ul>
 */