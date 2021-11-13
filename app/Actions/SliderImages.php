<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class SliderImages extends AbstractAction
{
    public function getTitle()
    {
        return 'التفاصيل';
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
        return route('voyager.slider-images.index') . '?slider_id=' . $this->data->id;
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'sliders';
    }

    public function massAction($ids, $comingFrom)
    {
        // Do something with the IDs
        return ($ids);
    }
}
