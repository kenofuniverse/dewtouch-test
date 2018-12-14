<?php

class Member extends AppModel {
    public $hasOne = array('Transaction');
}