<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\HasReferencesToOtherSheets;

class FirstSheetImport implements ToArray, HasReferencesToOtherSheets
{
    public function array(array $row)
    {
    
    }
}
