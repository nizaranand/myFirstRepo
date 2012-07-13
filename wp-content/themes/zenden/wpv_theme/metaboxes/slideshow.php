<?php

if(!isset($htmlslide))
	$htmlslide = false;

return array(
array(
	'name' => __('Captions', 'wpv'),
	'type' => 'separator',
),

array(
	'name' => $htmlslide ? __('Slide content', 'wpv') : __('First caption', 'wpv'),
	'id' => 'first-caption',
	'type' => 'textarea',
	'class' => 'no-desc',
	'rows' => $htmlslide ? 15 : 3,
),

array(
	'name' => __('Second caption', 'wpv'),
	'id' => 'second-caption',
	'type' => 'textarea',
	'rows' => 3,
	'class' => $htmlslide ? 'hidden':'no-desc',
),
array(
	'name' => __('Third caption', 'wpv'),
	'id' => 'third-caption',
	'type' => 'textarea',
	'rows' => 3,
	'class' => $htmlslide ? 'hidden':'no-desc',
),

array(
	'name' => __('Style', 'wpv'),
	'type' => 'separator',
),

array(
	'name' => __('Background', 'wpv'),
	'id' => 'background',
	'type' => 'color',
	'default' => '',
),

);