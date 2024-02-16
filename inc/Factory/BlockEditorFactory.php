<?php
namespace Bettingpro\Factory;

abstract class BlockEditorFactory {

    public function getBlockData(): array
    {
        return [
            'name'            => strtolower( str_replace(' ', '_', $this->name )),
            'title'           => __( $this->name, 'bettingpro' ),
            'description'     => __( $this->description, 'bettingpro' ),
            'render_template' =>  get_template_directory() . '/template-parts/'. $this->path .'/'.class_basename($this::class).'.php',
            'category'        => 'Betting',
            'icon'            => __($this->icon, 'media-default'),
            'mode'            => 'auto',
        ];
    }
}