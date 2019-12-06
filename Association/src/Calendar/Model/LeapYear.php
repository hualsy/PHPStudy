<?php
// Association/src/Calendar/Model/LeapYear.php
/**
 * Created by PhpStorm
 * User : liubin
 * Date : 2019/12/6 0006
 * Time : 14:11
 */
namespace Calendar\Model;

class LeapYear{
    public function isLeapYear($year = null)
    {
        if (null === $year) {
            $year = date('Y');
        }

        return 0 == $year % 400 || (0 == $year % 4 && 0 != $year % 100);
    }
}