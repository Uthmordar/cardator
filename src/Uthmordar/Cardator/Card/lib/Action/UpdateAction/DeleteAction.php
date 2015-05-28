<?php

namespace Uthmordar\Cardator\Card\lib;

class DeleteAction extends UpdateAction{
    protected $parents="Thing\Action\UpdateAction";
    protected $type="http://schema.org/DeleteAction";
}