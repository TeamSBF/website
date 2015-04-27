<?php
abstract class UserLevel extends BasicEnum
{
    const Anon = 0;
    const Member = 1;
    const Admin = 2;
    const Super = 3;
}