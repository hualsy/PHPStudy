<?php
// Association/src/Calendar/Controller/LeapYearController.php
/**
 * Created by PhpStorm
 * User : liubin
 * Date : 2019/12/6 0006
 * Time : 14:09
 */

namespace Calendar\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Calendar\Model\LeapYear;

class LeapYearController
{
    public function indexAction (Request $request, $year)
    {
        $leapyear = new LeapYear();
        if ($leapyear -> isLeapYear($year))
        {
            return new Response('Yep, this is a leap year!');
        }

        return new Response('Nope, this is not a leap year.');
    }
}