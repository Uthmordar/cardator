<?php

namespace Uthmordar\Cardator\Card\lib;

class DownloadAction extends TransferAction{
    protected $parents="Thing\Action\TransferAction";
    protected $fromLocation;
    protected $toLocation;
    protected $type="http://schema.org/DownloadAction";
}