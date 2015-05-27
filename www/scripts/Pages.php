<?php
class Pages extends Singleton
{
    private $items = null;
    private $redirect = "";

    protected function __construct()
    {
        if ($this->items === null) {
            $this->redirect = new Page("Home", "index.php",UserLevel::Anon);
            // ORDER DOES MATTER AS IT DEFINES THE ORDER IN WHICH THEY APPEAR
            $items = [
                "index.php" => $this->redirect,
                "about.php" => new Page("About", "about.php",UserLevel::Anon, "only"),
                "contact.php" => new Page("Contact", "contact.php",UserLevel::Anon, "only"),
                "faq.php" => new Page("FAQ", "faq.php",UserLevel::Anon, "only"),
				"register.php" => new Page("Register", "register.php", UserLevel::Anon, "only"),
                "memberHome.php" => new Page("Forms", "memberHome.php",UserLevel::Member, "only"),
                "assessments.php" => new Page("Assessments", "assessments.php",UserLevel::Member, "only"),
                "users.php" => new Page("Users", "users.php", UserLevel::Admin),
                "profile.php" => new Page("Profile", "profile.php", UserLevel::Member),
                "logout.php" => new Page("Logout", "logout.php", UserLevel::Member)
            ];
            
            $this->items = $items;
        }
    }

    public function BuildMenu($user)
    {
        $plevel = $user ? $user->AccessLevel : 0;
        
        $items = "";
        foreach ($this->items as $item)
        {
            if ($item->HasAccess($plevel))
                $items .= PartialParser::Parse("menuitem",["url"=>$item->page, "name"=>$item->name]);
        }

        return PartialParser::Parse("menu",["items"=>$items]);
    }
    
    public function ConfirmAccess($user, $page)
    {
        $page = substr($page, 1, strlen($page)-1);
        if(!$this->items[$page]->HasAccess($user->accesslevel))
            header("Location: " . $this->redirect->page);
    }
}