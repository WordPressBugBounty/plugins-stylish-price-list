'use strict';

const { createElement, Fragment } = wp.element;
const { registerBlockType } = wp.blocks;
const { useBlockProps } = wp.blockEditor || wp.editor;
const { SelectControl, ToggleControl, PanelBody, Placeholder } = wp.components;

const splIcon = createElement( 'svg', { width: 20, height: 20, viewBox: '0 0 612 612', className: 'dashicon' },
	createElement( 'path', {
		fill: 'currentColor',
		d: 'M405.333 85.333h-128v-64C277.333 9.551 267.782 0 256 0c-11.782 0-21.333 9.551-21.333 21.333v64h-128c-11.782 0-21.333 9.551-21.333 21.333v384c0 11.782 9.551 21.333 21.333 21.333h298.667c11.782 0 21.333-9.551 21.333-21.333v-384c0-11.781-9.552-21.333-21.334-21.333zm-21.333 384H128V128h106.667v21.333c0 11.782 9.551 21.333 21.333 21.333 11.782 0 21.333-9.551 21.333-21.333V128H384v341.333z',
	} ),
	createElement( 'path', {
		fill: 'currentColor',
		d: 'M256 213.333c-35.355 0-64 28.645-64 64s28.645 64 64 64c11.791 0 21.333 9.542 21.333 21.333S267.791 384 256 384h-42.667C201.551 384 192 393.551 192 405.333c0 11.782 9.551 21.333 21.333 21.333H256c35.355 0 64-28.645 64-64s-28.645-64-64-64c-11.791 0-21.333-9.542-21.333-21.333S244.209 256 256 256h42.667c11.782 0 21.333-9.551 21.333-21.333 0-11.782-9.551-21.333-21.333-21.333H256z',
	} ),
);

registerBlockType( 'stylish-price-list/list-picker', {
	title: 'Stylish Price List',
	description: 'Add a Stylish Price List to your page.',
	icon: splIcon,
	keywords: [ 'stylish price list', 'pricelist', 'price', 'list' ],
	category: 'widgets',
	attributes: {
		listId: {
			type: 'string',
		},
	},
	example: {
		attributes: {
			listId: '1',
		},
	},
	edit( props ) {
		console.log( stylish_price_list_data );
		const { attributes: { listId = '' }, setAttributes } = props;
		const jsx = [ <Placeholder
			key="df-spl-gutenberg--wrap"
			className="df-spl-gutenberg--wrap">
			<img src={ stylish_price_list_data.logo }/>
			<SelectControl
				key="df-spl-gutenberg--select-control"
				value={ listId }
				options={ [ { value: null, label: 'Select A Price List' }, ...stylish_price_list_data.lists ] }
				onChange={ selectPriceList }
			/>
		</Placeholder> ];

		function selectPriceList( value ) {
			setAttributes( { listId: value } );
		}
		return jsx;
	},
	save() {
		return null;
	},
} );
