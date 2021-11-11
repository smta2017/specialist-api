<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class orderShowComments extends AbstractAction
{
    public function getTitle()
    {
        return 'العروض';
    }

    public function getIcon()
    {
        return 'voyager-eye';
    }

    public function getPolicy()
    {
        return 'read';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-primary pull-right',
        ];
    }

    public function getDefaultRoute()
    {
        return route('voyager.order-comments.index') . '?order_id=' . $this->data->id;
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'customers';
    }
}
