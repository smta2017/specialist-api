@extends(backpack_view('blank'))
<?php

use App\Models\Order;
use App\Models\User;


$users = User::count();
$orders = Order::count();
$completed_orders = Order::where('order_state_id',4)->count();
$canceled_orders = Order::onlyTrashed()->count();
?>
@php
// notice we use Widget::add() to add widgets to a certain group
Widget::add()->to('before_content')->type('div')->class('row')->content([
// notice we use Widget::make() to add widgets as content (not in a group)
Widget::make()
->type('progress')
->class('card border-0 text-white bg-info')
->description('Registered users.')
->hint('Great! Don\'t stop.')
->progressClass('progress-bar')
->value($users),

 

Widget::make()
->type('progress')
->class('card border-0 text-white bg-success')
->description('Completed orders')
->hint('Great! Don\'t stop.')
->progressClass('progress-bar')
->value($completed_orders),



Widget::make()
->type('progress')
->class('card border-0 text-white bg-danger')
->description('Canceled orders')
->hint('Great! Don\'t stop.')
->progressClass('progress-bar')
->value($canceled_orders),


// alternatively, to use widgets as content, we can use the same add() method,
// but we need to use onlyHere() or remove() at the end
]);
@endphp


@section('content')
@endsection