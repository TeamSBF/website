<?php
/*
 * Kind of useless but provides an easy check for the database manager
 */
interface IQuery
{
    public function Query($values = null);
}