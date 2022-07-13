<?php

return [
    'name' => 'Documents',
    'menus' => [
        [
            'name' => 'Components',
            'text' => 'documents.components',
            'children' => [
                [
                    'name' => 'Alerts',
                    'route' => 'components.alerts.index',
                    'component' => \Laka\Core\Components\Common\Alert::class
                ],
                [
                    'name' => 'Badge',
                    'route' => 'components.badge.index',
                    'component' => \Laka\Core\Components\Common\Badge::class
                ],
                [
                    'name' => 'Breadcrumb',
                    'route' => 'components.breadcrumb.index',
                    'component' => \Laka\Core\Components\Common\Breadcrumb::class
                ],
                [
                    'name' => 'Button',
                    'route' => 'components.button.index',
                    'component' => \Laka\Core\Components\Common\Button::class
                ],
                [
                    'name' => 'Card',
                    'route' => 'components.card.index',
                    'component' => [
                        \Laka\Core\Components\Common\Card::class,
                        \Laka\Core\Components\Common\CardHeader::class,
                        \Laka\Core\Components\Common\CardTitle::class,
                        \Laka\Core\Components\Common\CardBody::class,
                        \Laka\Core\Components\Common\CardText::class,
                        \Laka\Core\Components\Common\CardGroup::class,
                        \Laka\Core\Components\Common\CardFooter::class
                    ]
                ],
                [
                    'name' => 'Carousel',
                    'route' => 'components.carousel.index',
                    'component' => \Laka\Core\Components\Common\Carousel::class
                ],
                [
                    'name' => 'Embed',
                    'route' => 'components.embed.index',
                    'component' => \Laka\Core\Components\Common\Embed::class
                ],
                [
                    'name' => 'Headline',
                    'route' => 'components.headline.index',
                    'component' => \Laka\Core\Components\Common\Headline::class
                ],
                [
                    'name' => 'Form',
                    'route' => 'components.form.index',
                    'component' => \Laka\Core\Forms\Form::class
                ],
                [
                    'name' => 'Form checkbox',
                    'route' => 'components.form-checkbox.index',
                    'component' => \Laka\Core\Components\Forms\Checkbox::class
                ],
                [
                    'name' => 'Form Datepicker',
                    'route' => 'components.form-datepicker.index',
                    'component' => \Laka\Core\Components\Forms\Datepicker::class
                ],
                [
                    'name' => 'Form File',
                    'route' => 'components.form-file.index',
                ],
                [
                    'name' => 'Form Group',
                    'route' => 'components.form-group.index',
                    'component' => \Laka\Core\Components\Forms\Group::class
                ],
                [
                    'name' => 'Form Input',
                    'route' => 'components.form-input.index',
                    'component' => \Laka\Core\Components\Forms\Input::class
                ],
                [
                    'name' => 'Form Radio',
                    'route' => 'components.form-radio.index',
                    'component' => \Laka\Core\Components\Forms\Radio::class
                ],
                [
                    'name' => 'Form Select',
                    'route' => 'components.form-select.index',
                    'component' => \Laka\Core\Components\Forms\Select::class
                ],
                [
                    'name' => 'Form Textarea',
                    'route' => 'components.form-textarea.index',
                    'component' => \Laka\Core\Components\Forms\Textarea::class
                ],
                [
                    'name' => 'Image',
                    'route' => 'components.image.index',
                    'component' => \Laka\Core\Components\Common\Image::class
                ],
                [
                    'name' => 'Link',
                    'route' => 'components.link.index',
                    'component' => \Laka\Core\Components\Common\Link::class
                ],
                [
                    'name' => 'Media',
                    'route' => 'components.media.index',
                    'component' => \Laka\Core\Components\Common\Media::class
                ],
                [
                    'name' => 'Modal',
                    'route' => 'components.modal.index',
                    'component' => \Laka\Core\Components\Common\Modal::class
                ],
                [
                    'name' => 'Progress',
                    'route' => 'components.progress.index',
                    'component' => [
                        \Laka\Core\Components\Common\Progress::class,
                        \Laka\Core\Components\Common\ProgressBar::class
                    ]
                ],
                [
                    'name' => 'Stripe Nav',
                    'route' => 'components.stripe-nav.index',
                    'component' => \Laka\Core\Components\Common\StripeNav::class
                ],
                [
                    'name' => 'Svg',
                    'route' => 'components.svg.index',
                    'component' => \Laka\Core\Components\Common\Svg::class
                ],
                [
                    'name' => 'Toasts',
                    'route' => 'components.toasts.index',
                    'component' => \Laka\Core\Components\Common\Toasts::class
                ],
            ]
        ],
        [
            'name' => 'Layouts',
            'text' => 'documents.layouts',
            'children' => [
                [
                    'name' => 'Row',
                    'route' => 'layout.row.index',
                    'component' => \Laka\Core\Components\Common\Row::class
                ],
                [
                    'name' => 'Col',
                    'route' => 'layout.col.index',
                    'component' => \Laka\Core\Components\Common\Col::class
                ],
            ]
        ]
    ]
];
