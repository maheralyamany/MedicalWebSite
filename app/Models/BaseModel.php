<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasFactory;

    public $timestamps = false;
    public function fill(array $attributes)
    {
        $totallyGuarded = $this->totallyGuarded();

        foreach ($this->fillableFromArray($attributes) as $key => $value) {
            // The developers may choose to place some attributes in the "fillable" array
            // which means only those attributes may be set through mass assignment to
            // the model, and all others will just get ignored for security reasons.
            if (!$this->isFillable($key))
            $this->fillable[]=$key;
            if ($this->isFillable($key)) {
                $this->setAttribute($key, $value);
            } elseif ($totallyGuarded) {
                throw new MassAssignmentException(sprintf(
                    'Add [%s] to fillable property to allow mass assignment on [%s].',
                    $key, get_class($this)
                ));
            }
        }

        return $this;
    }
    public function getTransName()
    {
        return $this->{'name_' . app()->getLocale()};
    }
    public function setAttribute($key, $value)
    {
        if (is_array($this->forcedNullStrings)&&in_array($key, $this->forcedNullStrings) && $value === null)
            $value = "";
        else if (is_array($this->forcedNullNumbers)&&in_array($key, $this->forcedNullNumbers) && $value === null)
            $value = 0;

        return parent::setAttribute($key, $value);
    }
}
