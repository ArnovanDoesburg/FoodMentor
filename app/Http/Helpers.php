<?php

namespace App;

use Carbon\Carbon;
use App\User;

class Helpers
{
    public static function getUserNameById($userid)
    {
        foreach (User::all() as $user) {
            if ($user->id === $userid) {
                return $user->name;
            }
        }
    }

    // Gebruiken Carbon omdat dat al in het framework zit
    public static function formatDate($timestamp)
    {
        $date = new Carbon($timestamp);
        return $date->format("d/m/Y");
    }

    public static function toDutchString($timestamp)
    {
        $dutchMonths = array("januari", "februari", "maart", "april", "mei", "juni", "juli", "augustus", "september", "oktober", "november", "december");
        $date = new Carbon($timestamp);
        return $date->day . " " . $dutchMonths[$date->month - 1];
    }

    public static function checkRole($user, $roles)
    {
        // Als je geen array meegeeft voor maar 1 gebruiker wordt er een array van gemaakt
        if (!is_array($roles)) {
            $roles = array($roles);
        }
        $role = $user->roles()->first()->name;
        return in_array($role, $roles);
    }

    public static function limitString($string, $limit)
    {
        return substr($string, 0, $limit) . '...';
    }

    public static function isCurrentCategory($categoryId)
    {
        if (isset($_GET["category"])) {
            $category = $_GET["category"];
            return $category == $categoryId;
        }
    }

    public static function isAuthorsFoodlist($foodlist, $user) {
        return $foodlist->user_id == $user->id;
    }

}