<?php

Breadcrumbs::for('list', function ($trail) {
    $trail->push('お客様情報一覧', route('form.list'));
});
