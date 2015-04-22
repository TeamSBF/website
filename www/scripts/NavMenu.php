<?php
class NavMenu extends Singleton
{
    public static function Build($user)
    {
        printr($user);
        $plevel = $user ? $user->PrivilegeLevel : 0;
        echo "blah: " .$plevel;
        self::instance()->buildMenu($plevel);
    }

    private function buildMenu($plevel = 0)
    {
        $q = QueryFactory::Build("select")->Select("name","page")->From("menu")->Where(["pLevel","<=",$plevel]);
        $items = DatabaseManager::Query($q);


        if($items->RowCount() > 0) {
            $output = "<ul>";
            foreach ($items->Result() as $item)
                $output .= $this->buildItem($item);
            $output .= "</ul>";
        }else {
            $output = 'no menu items for this permission level';
        }

        echo $output;
    }

    private function buildItem($item)
    {
        return '<li><a href="'.$item['page'].'">'.$item['name'].'</a></li>';
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